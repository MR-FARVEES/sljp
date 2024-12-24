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
require_once __DIR__ . "/../model/post.php";
require_once __DIR__ . "/../model/comment.php";
require_once __DIR__ . "/../model/like.php";

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
    private $postModel;
    private $commentModel;
    private $likeModel;

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
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
        $this->likeModel = new LikeModel();
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

            try {
                $this->userModel->createNewUser($first, $last, $username, $password, $email, $contact, $gender, $year . "-" . $month . "-" . $day, $address, $nic, $role);
                $insert_id = $this->userModel->insert_id();
                $filename = "profile-" . $insert_id . ".jpg";
                $upload_path = __DIR__ . "/../assets/images/user/" . $filename;
                move_uploaded_file($_FILES["image"]["tmp_name"], $upload_path);
                $this->userModel->updateProfile($filename, $insert_id);
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
                foreach ($message as $key => $value) {
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

    public function createPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post_text = $_POST['post_text'];
            $file = $_FILES['file'];
            $this->postModel->createNewPost($_SESSION['id'], $post_text);
            $inser_id = $this->postModel->insert_id();
            $source = "post-" . $inser_id . ".jpg";
            $upload = __DIR__ . "/../assets/images/post/" . $source;
            $this->postModel->updatePost($source, $inser_id);
            move_uploaded_file($file['tmp_name'], $upload);
        }
    }

    public function getAllPosts()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ids = [$_SESSION['id']];
            $followers = $this->followerModel->getAllFollowers($_SESSION['id']);
            while ($follower = $followers->fetch_assoc()) {
                $ids[] = $follower['follow_id'];
            }
            $posts = $this->postModel->getAllPosts($ids);
            echo '[';
            while ($post = $posts->fetch_assoc()) {
                $users = $this->userModel->getUserInfo($post['user_id']);
                while ($user = $users->fetch_assoc()) {
                    echo $user['profile'] . "<>" . ucfirst($user['first']) . " " . ucfirst($user['last']) . "<>" . $post['post_text'] . "<>" . $post['post_source'] . "<>" . $post['id'] . '<>' . $user['id'] . '<>' . $post['type'];
                }
                echo '<#>';
            }
            echo ']';
        }
    }

    public function getPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post_id = $_POST['post_id'];
            $posts = $this->postModel->getPost($post_id);
            echo '[';
            while ($post = $posts->fetch_assoc()) {
                $users = $this->userModel->getUserInfo($post['user_id']);
                while ($user = $users->fetch_assoc()) {
                    echo $user['profile'] . "<>" . ucfirst($user['first']) . " " . ucfirst($user['last']) . "<>" . $post['post_text'] . "<>" . $post['post_source'] . "<>" . $post['id'] . '<>' . $user['id'] . '<>' . $post['type'];
                }
                echo '<#>';
            }
            echo ']';
        }
    }

    public function likePost() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $post_id = $_POST['post_id'];
            $this->likeModel->createNewLike($post_id, $_SESSION['id']);
        }
    }

    public function getLikes() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $post_id = $_POST['post_id'];
            $likes = $this->likeModel->getAllLikes($post_id);
            echo '[';
            while ($like = $likes->fetch_assoc()) {
                $users = $this->userModel->getUserInfo($like['user_id']);
                while ($user = $users->fetch_assoc()) {
                    echo $user['profile'] . "<>" . ucfirst($user['first']) . " " . ucfirst($user['last']);
                }
                echo '<#>';
            }
            echo ']';
        }
    }

    public function commentPost() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $post_id = $_POST['post_id'];
            $comment = $_POST['comment'];
            $this->commentModel->createNewComment($post_id, $_SESSION['id'], $comment);
        }
    }

    public function getAllComments() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $posts = $_POST['posts'];
            $post_ids = json_decode($posts);
            print_r($post_ids);
            $comments = $this->commentModel->getAllComments($post_ids);
            echo '[';
            while ($comment = $comments->fetch_assoc()) {
                $users = $this->userModel->getUserInfo($comment['user_id']);
                while ($user = $users->fetch_assoc()) {
                    echo $user['profile'] . "<>" . ucfirst($user['first']) . " " . ucfirst($user['last']) . "<>" . $comment['content'] . "<>" .$comment['id'] . "<>" . $comment['post_id'];
                }
                echo '<#>';
            }
            echo ']';
        }
    }

    public function rePost() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $post_id = $_POST['post_id'];
            $post_text = $_POST['post_text'];
            $this->postModel->createRePost($_SESSION['id'], $post_text, 'copy');
            $insert_id = $this->postModel->insert_id();
            $this->postModel->updatePost($post_id, $insert_id);
        }
    }

    public function sendPost() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $post_id = $_POST['post-send'];
            $message = $_POST['repost-msg'];
            $numbers = [];
            foreach($_POST as $key => $value) {
                if (preg_match('/user-(\d+)/', $key, $matches) && $value === 'on') {
                    $numbers[] = $matches[1];
                }
            }
            foreach($numbers as $key => $value) {
                $this->messageModel->createNewMessage($_SESSION['id'], $value, $post_id, 'post');
            }
        }
        $this->redirect('/seeker');
    }

    public function changeProfile() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $_POST['user_id'];
            $file = $_FILES['profile'];
            $path = $_POST["path"];
            $upload_file = __DIR__ . "/../assets/images/user/" . $file['name'];
            $this->userModel->updateProfile($file['name'], $user_id);
            move_uploaded_file($file['tmp_name'], $upload_file);
            $this->redirect($path);
        }
    }

    public function changeCover() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id = $_POST["userid"];
            $file = $_FILES['cover'];
            $path = $_POST['path'];
            $upload_file = __DIR__ . "/../assets/images/cover/" . $file["name"];
            $this->userModel->updateCover($file['name'], $user_id);
            move_uploaded_file($file['tmp_name'], $upload_file);
            $this->redirect($path);
        }
    }
}