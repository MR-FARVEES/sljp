<?php
require_once __DIR__ . "/user.php";
require_once __DIR__ ."/../model/user.php";
require_once __DIR__ ."/../model/follow_request.php";
require_once __DIR__ ."/../model/notification.php";

class SeekerController extends UserController {
    private $userModel;
    private $followRequestModel;
    private $notificationModel;

    public function __construct() {
        parent::__construct();
        $this->initNav();
    }

    public function index() {
        include_once __DIR__ ."/../view/seekers/index.php";
    }

    public function network() {
        
        include_once __DIR__ ."/../view/seekers/network.php";
    }

    public function job() {
        include_once __DIR__ ."/../view/seekers/job.php";
    }

    public function chat() {
        include_once __DIR__ ."/../view/seekers/chat.php";
    }

    public function seekerProfile() {
        $this->profile();
    }

    public function connection() {
        include_once __DIR__ ."/../view/connection.php";
    }
}