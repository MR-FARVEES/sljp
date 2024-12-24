<?php
require_once __DIR__ . "/../core/request.php";
require_once __DIR__ . "/../model/follow_request.php";
require_once __DIR__ . "/../model/notification.php";
require_once __DIR__ . "/../model/user.php";

ob_start();
class Controller
{
    private $path;
    private $userModel;
    private $followRequestModel;
    private $notificationModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $request = new Request();
        $this->path = $request->getPath();
    }

    public function getCurrentPath()
    {
        return $this->path;
    }

    public function initNav()
    {
        $path = new Request();
        if (isset($_SESSION["logged"])) {
            if ($_SESSION["role"] == "admin") {
                include_once __DIR__ . "/../view/nav/admin_nav.php";
            } else
                if ($_SESSION["role"] == "seeker") {
                    include_once __DIR__ . "/../view/nav/seeker_nav.php";
                } else
                    if ($_SESSION["role"] == "provider") {
                        include_once __DIR__ . "/../view/nav/provider_nav.php";
                    }
        } else {
            include_once __DIR__ . "/../view/nav/public_nav.php";
        }
    }

    public function middleware()
    {
        if (!(isset($_SESSION['logged']) && $_SESSION['logged'] == true)) {
            $this->redirect('/login');
        }
    }

    public function isLogged()
    {
        return isset($_SESSION['logged']) && $_SESSION['logged'] == true;
    }

    public function loginUser($id, $fname, $lname, $email, $gender, $role, $contact, $nic, $profile, $cover, $status)
    {
        $_SESSION['logged'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['email'] = $email;
        $_SESSION['gender'] = $gender;
        $_SESSION['role'] = $role;
        $_SESSION['contact'] = $contact;
        $_SESSION['nic'] = $nic;
        $_SESSION['profile'] = $profile;
        $_SESSION['cover'] = $cover;
        $_SESSION['status'] = $status;

        if ($role == 'admin') {
            $this->redirect("/admin");
        } else if ($role == "seeker") {
            $this->redirect("/seeker");
        } else if ($role == "provider") {
            $this->redirect("/provider");
        }
    }

    public function logoutUser()
    {
        unset($_SESSION['logged']);
        unset($_SESSION['id']);
        unset($_SESSION['fname']);
        unset($_SESSION['lname']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['gender']);
        unset($_SESSION['contact']);
        unset($_SESSION['nic']);
        unset($_SESSION['cover']);
        unset($_SESSION['status']);

        $this->redirect("/login");
    }

    public function redirect($path)
    {
        header("Location: " . $path);
        exit;
    }

    public function findAgo($date)
    {
        $now = new DateTime();
        $interval = $now->diff($date);
        $years = $interval->y;
        $months = $interval->m;
        $days = $interval->d;
        $hours = $interval->h;
        $minutes = $interval->i;

        $timeAgo = '';

        if ($years > 0) {
            $timeAgo .= $years . ' year' . ($years > 1 ? 's' : '') . ' ';
        }
        if ($months > 0) {
            $timeAgo .= $months . ' month' . ($months > 1 ? 's' : '') . ' ';
        }
        if ($days > 0) {
            $timeAgo .= $days . ' day' . ($days > 1 ? 's' : '') . ' ';
        }
        if ($hours > 0) {
            $timeAgo .= $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ';
        }
        if ($minutes > 0) {
            $timeAgo .= $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ';
        }

        if (!empty($timeAgo)) {
            $timeAgo .= 'ago';
        }

        return $timeAgo;
    }
}