<?php
require_once __DIR__ . "/user.php";
require_once __DIR__ . "/../model/user.php";
require_once __DIR__ . "/../model/follower.php";
require_once __DIR__ . "/../model/education.php";
require_once __DIR__ . "/../model/university.php";

class ProviderController extends UserController
{
    private $userModel;
    private $followerModel;
    private $educationModel;
    private $universityModel;

    public function __construct()
    {
        parent::__construct();
        $this->initNav();
        $this->userModel = new UserModel();
        $this->followerModel = new FollowerModel();
        $this->educationModel = new EducationModel();
        $this->universityModel = new UniversityModel();
    }

    public function index()
    {
        include_once __DIR__ . "/../view/provider/index.php";
    }

    public function network()
    {
        include_once __DIR__ . "/../view/provider/network.php";
    }

    public function job()
    {
        include_once __DIR__ . "/../view/provider/job.php";
    }

    public function providerProfile()
    {
        $this->profile();
    }
}