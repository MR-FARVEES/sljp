<?php
require_once __DIR__ . "/../core/control.php";
require_once __DIR__ . "/../model/user.php";
require_once __DIR__ . "/../model/education.php";
require_once __DIR__ . "/../model/university.php";
require_once __DIR__ . "/../model/skills.php";

class UserController extends Controller {
    private $userModel;
    private $educationModel;
    private $universityModel;
    private $skillModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->educationModel = new EducationModel();
        $this->universityModel = new UniversityModel();
        $this->skillModel = new SkillModel();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $username = $_POST["username"];
            $password = $_POST["password"];
            $result = $this->userModel->authenticate($username, $password);
            while ($row = $result->fetch_assoc()) { 
                $this->loginUser( $row["id"], $row["first"], $row["last"], $row["email"], $row["gender"], $row["role"], $row["contact"], $row["nic"], $row["profile"], $row["cover"], $row["status"]);
            }
        }
        include_once __DIR__ ."/../view/login.php";
    }

    public function register() {
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
            $filename = "profile-" . $count .".jpg";
            $upload_path = __DIR__ ."/../assets/images/user/" . $filename;
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

    public function logout() {
        $this->logoutUser();
    }

    public function profile() {
        $user_info = null;
        $result = $this->userModel->getUserInfo($_SESSION["id"]);
        while ($row = $result->fetch_assoc()) {
            $user_info = $row;
        }
        $educations = $this->educationModel->getEducation($_SESSION["id"]);
        $uniModle = $this->universityModel;
        include_once __DIR__ ."/../view/profile.php";
    }

    public function skills() {
        echo "[";
        $skills = $this->skillModel->getAllSkills();
        while ($row= $skills->fetch_assoc()) {
            echo $row['title'] . ",";
        }
        echo "]";
        exit;
    }
}