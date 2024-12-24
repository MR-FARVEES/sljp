<?php
require_once __DIR__ . "/user.php";
require_once __DIR__ . "/../model/user.php";
require_once __DIR__ . "/../model/follower.php";
require_once __DIR__ . "/../model/education.php";
require_once __DIR__ . "/../model/university.php";
require_once __DIR__ . "/../model/company.php";
require_once __DIR__ . "/../model/job.php";
require_once __DIR__ . "/../model/skills.php";
require_once __DIR__ . "/../model/user_skill.php";
require_once __DIR__ . "/../model/job_skill.php";
require_once __DIR__ . "/../model/job_applicant.php";

class SeekerController extends UserController
{
    private $userModel;
    private $followerModel;
    private $educationModel;
    private $universityModel;
    private $jobModel;
    private $jobSkillModel;
    private $jobApplicantModel;
    private $skillModel;
    private $userSkillModel;
    private $companyModel;

    public function __construct()
    {
        parent::__construct();
        $this->initNav();
        $this->userModel = new UserModel();
        $this->followerModel = new FollowerModel();
        $this->educationModel = new EducationModel();
        $this->universityModel = new UniversityModel();
        $this->companyModel = new CompanyModel();
        $this->jobModel = new JobModel();
        $this->skillModel = new SkillModel();
        $this->userSkillModel = new UserSkillModel();
        $this->jobSkillModel = new JobSkillModel();
        $this->jobApplicantModel = new JobApplicantModel();
    }

    public function index()
    {
        include_once __DIR__ . "/../view/seekers/index.php";
        include_once __DIR__ . "/../view/messaging.php";
    }

    public function network()
    {

        include_once __DIR__ . "/../view/seekers/network.php";
    }

    public function job()
    {
        include_once __DIR__ . "/../view/seekers/job.php";
    }

    public function jobCollection()
    {
        include_once __DIR__ . "/../view/seekers/collection.php";
    }

    public function seekerProfile()
    {
        $this->profile();
    }

    public function connection()
    {
        include_once __DIR__ . "/../view/connection.php";
    }

    public function applyForJob() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $job_id = $_POST['job_id'];
            $this->jobApplicantModel->createNewApplicant($job_id, $_SESSION['id']);
        }
    }
}