<?php
require_once __DIR__ . "/../core/control.php";
require_once __DIR__ . "/../model/user.php";
require_once __DIR__ . "/../model/education.php";
require_once __DIR__ . "/../model/university.php";
require_once __DIR__ . "/../model/skills.php";
require_once __DIR__ . "/../model/degree.php";
require_once __DIR__ . "/../model/field.php";
require_once __DIR__ . "/../model/user_skill.php";
require_once __DIR__ . "/../model/notification.php";
require_once __DIR__ . "/../model/follow_request.php";
require_once __DIR__ . "/../model/follower.php";
require_once __DIR__ . "/../model/message.php";

class UserController extends Controller
{
    private $userModel;
    private $educationModel;
    private $universityModel;
    private $skillModel;
    private $degreeModel;
    private $fieldModel;
    private $userSkillModel;
    private $notificationModel;
    private $followRequestModel;
    private $followerModel;
    private $messageModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->educationModel = new EducationModel();
        $this->universityModel = new UniversityModel();
        $this->skillModel = new SkillModel();
        $this->userSkillModel = new UserSkillModel();
        $this->degreeModel = new DegreeModel();
        $this->fieldModel = new FieldModel();
        $this->notificationModel = new NotificationModel();
        $this->followRequestModel = new FollowRequestModel();
        $this->followerModel = new FollowerModel();
        $this->messageModel = new MessageModel();
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $result = $this->userModel->authenticate($username, $password);
            while ($row = $result->fetch_assoc()) {
                $this->loginUser($row["id"], $row["first"], $row["last"], $row["email"], $row["gender"], $row["role"], $row["contact"], $row["nic"], $row["profile"], $row["cover"], $row["status"]);
            }
        }
        include_once __DIR__ . "/../view/login.php";
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first = $_POST["first"];
            $last = $_POST["last"];
            $day = $_POST["day"];
            $month = $_POST["month"];
            $year = $_POST["year"];
            $gender = $_POST["gender"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $file = $_FILES["image"];
            $contact = $_POST["contact"];
            $nic = $_POST["nic"];
            $address = $_POST["address"];
            $role = $_POST["role"];

            $count = $this->userModel->count();
            $filename = "profile-" . $count . ".jpg";
            $upload_path = __DIR__ . "/../assets/images/user/" . $filename;
            move_uploaded_file($_FILES["image"]["tmp_name"], $upload_path);

            try {
                $this->userModel->createNewUser($first, $last, $username, $password, $email, $contact, $gender, $year . "-" . $month . "-" . $day, $address, $filename, $nic, $role);
                $this->redirect("/login?create=true");
            } catch (mysqli_sql_exception $e) {
                $this->redirect("/register?exists=true");
            }
        }
        include_once __DIR__ . "/../view/register.php";
    }

    public function logout()
    {
        $this->logoutUser();
    }

    public function profile()
    {
        $user_info = null;
        $result = $this->userModel->getUserInfo($_SESSION["id"]);
        while ($row = $result->fetch_assoc()) {
            $user_info = $row;
        }
        $educations = $this->educationModel->getEducation($_SESSION["id"]);
        $uniModle = $this->universityModel;
        include_once __DIR__ . "/../view/profile.php";
    }

    public function searchResults()
    {
        $this->initNav();
        include_once __DIR__ . "/../view/result.php";
    }

    public function skills()
    {
        echo "[";
        $skills = $this->skillModel->getAllSkills();
        while ($row = $skills->fetch_assoc()) {
            echo $row['title'] . ",";
        }
        echo "]";
    }

    public function universities()
    {
        echo "[";
        $unis = $this->universityModel->getAllUniversities();
        while ($row = $unis->fetch_assoc()) {
            echo $row['name'] . ",";
        }
        echo "]";
    }

    public function degrees()
    {
        echo "[";
        $degrees = $this->degreeModel->getAllDegrees();
        while ($row = $degrees->fetch_assoc()) {
            echo $row['title'] . ",";
        }
        echo "]";
    }

    public function fields()
    {
        echo "[";
        $fields = $this->fieldModel->getAllFields();
        while ($row = $fields->fetch_assoc()) {
            echo $row['title'] . ",";
        }
        echo "]";
    }

    public function addEducation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $school = $_POST['school'];
            $degree = $_POST['degree'];
            $field = $_POST['field'];
            $start_month = $_POST['start-month'];
            $start_year = $_POST['start-year'];
            $end_month = $_POST['end-month'];
            $end_year = $_POST['end-year'];
            $grade = $_POST['grade'];
            $activites = $_POST['activities'];
            $description = $_POST['description'];
            $skills = $_POST['skills'];
            $skills = explode(',', $skills);
            $uni_id = 0;
            $unis = $this->universityModel->getUniId($school);
            while ($uni = $unis->fetch_assoc()) {
                $uni_id = $uni['id'];
            }
            foreach ($skills as $skill) {
                if ($skill) {
                    $this->userSkillModel->createNewSkill($_SESSION['id'], $skill);
                }
            }
            try {
                $this->educationModel->createNewEducation($_SESSION['id'], $uni_id, $degree, $field, $start_month, $start_year, $end_month, $end_year, $grade, $activites, $description);
                echo "[" . $this->educationModel->insert_id() . "]";
            } catch (mysqli_sql_exception $e) {
                echo $e;
            }
        }
    }

    public function updateSeeker()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first = $_POST['first'];
            $last = $_POST['last'];
            $headline = $_POST['headline'];
            $show = $_POST['show-school'];
            $address = $_POST['address'];

            $this->userModel->updateSeeker($first, $last, $headline, $address, $show, $_SESSION['id']);
        }
        $this->redirect('/seeker/profile');
    }

    public function findUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = $_POST['query'];
            $users = $this->userModel->searchUsersByQuery($query);
            echo '[';
            while ($user = $users->fetch_assoc()) {
                if ($user['id'] != $_SESSION['id']) {
                    foreach ($user as $key => $value) {
                        echo $value . '<#>';
                    }
                    echo '<@>';
                }
            }
            echo ']';
        }
    }

    public function notifications()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_POST['user_id'];
            $notifications = $this->notificationModel->getNotificationCount($user_id);
            $count = 0;
            while ($notification = $notifications->fetch_assoc()) {
                $count = $notification['count'];
            }
            echo "[" . json_encode(["notification" => ["count" => $count]]) . "]";
        }
    }

    public function followUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_POST["user_id"];
            $this->followRequestModel->createNewFollowRequest($user_id, $_SESSION['id']);
            $insert_id = $this->followRequestModel->insert_id();
            $this->notificationModel->createNewNotification($user_id, $insert_id, 'follow');
        }
    }

    public function showNotifications()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_POST['user_id'];
            $notifications = $this->notificationModel->getAllNotifications($user_id);
            echo '[';
            while ($notification = $notifications->fetch_assoc()) {
                if ($notification['evt_type'] == 'follow') {
                    $followRequests = $this->followRequestModel->getFollowRequest($notification['evt_data']);
                    while ($followRequest = $followRequests->fetch_assoc()) {
                        $users = $this->userModel->getUserInfo($followRequest['request_id']);
                        while ($user = $users->fetch_assoc()) {
                            echo "follow<>" . ucfirst($user['first']) . " " . ucfirst($user['last']) . "<>" . $user['profile'] . "<>" . $notification['evt_data'] . "<>" . $notification['evt_type'] . "<>" . $notification["id"];
                        }
                    }
                    echo '<#>';
                }
                echo '<@>';
            }
            echo ']';
        }
    }

    public function acceptFollow()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $evt_data = $_POST['evt_data'];
            $evt_type = $_POST['evt_type'];
            $nid = $_POST['nid'];
            if ($evt_type == 'follow') {
                $followRequests = $this->followRequestModel->getFollowRequest($evt_data);
                while ($followRequest = $followRequests->fetch_assoc()) {
                    $users = $this->userModel->getUserInfo($followRequest['request_id']);
                    while ($user = $users->fetch_assoc()) {
                        $this->followerModel->createNewFollower($_SESSION['id'], $user['id']);
                        $this->followerModel->createNewFollower($user['id'], $_SESSION['id']);
                        $this->followRequestModel->deleteFollowRequest($evt_data);
                        $this->notificationModel->deleteNotification($nid);
                    }
                }
            }
        }
    }

    public function ignoreFollow()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $evt_data = $_POST['evt_data'];
            $evt_type = $_POST['evt_type'];
            $nid = $_POST['nid'];

            if ($evt_type == 'follow') {
                $this->followRequestModel->deleteFollowRequest($evt_data);
                $this->notificationModel->deleteNotification($nid);
            }
        }
    }

    public function allMessages()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_POST['user_id'];
            $messages = $this->messageModel->getAllMessages($_SESSION['id'], $user_id);
            echo "[";
            while ($message = $messages->fetch_assoc()) {
                foreach($message as $key => $value) {
                    echo $value . "<>";
                }
                $users = $this->userModel->getUserInfo($message['send']);
                while ($user = $users->fetch_assoc()) {
                    echo $user['profile'] . '<>' . ucfirst($user['first']) . ' ' . ucfirst($user['last']);
                }
                echo "<#>";
            }
            echo "]";
        }
    }

    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_POST['user_id'];
            $message = $_POST['message'];
            $this->messageModel->createNewMessage($_SESSION['id'], $user_id, $message, 'text');
        }
    }
}