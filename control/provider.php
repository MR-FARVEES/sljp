<?php
require_once __DIR__ . "/user.php";
require_once __DIR__ . "/../model/user.php";
require_once __DIR__ . "/../model/follower.php";
require_once __DIR__ . "/../model/education.php";
require_once __DIR__ . "/../model/university.php";
require_once __DIR__ . "/../model/company.php";
require_once __DIR__ . "/../model/employee.php";
require_once __DIR__ . "/../model/job.php";
require_once __DIR__ . "/../model/job_skill.php";
require_once __DIR__ . "/../model/job_applicant.php";

class ProviderController extends UserController
{
    private $userModel;
    private $followerModel;
    private $educationModel;
    private $universityModel;
    private $companyModel;
    private $employeeModel;
    private $jobModel;
    private $jobSkillModel;
    private $applicantModel;

    public function __construct()
    {
        parent::__construct();
        $this->initNav();
        $this->userModel = new UserModel();
        $this->followerModel = new FollowerModel();
        $this->educationModel = new EducationModel();
        $this->universityModel = new UniversityModel();
        $this->companyModel = new CompanyModel();
        $this->employeeModel = new EmployeeModel();
        $this->jobModel = new JobModel();
        $this->jobSkillModel = new JobSkillModel();
        $this->applicantModel = new JobApplicantModel();
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

    public function seeApplicants() {
        include_once __DIR__ . "/../view/provider/applicant.php";
    }

    public function providerProfile()
    {
        $this->profile();
    }

    public function createCompany() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $location = $_POST['location'];
            $industry = $_POST['industry'];
            $website = $_POST['website'];
            $cover = $_FILES['cover'];
            $logo = $_FILES['logo'];
            $dir = __DIR__ . "/../assets/images/company/";
            $upload_cover = $dir . "/cover/" . $cover['name'];
            $upload_logo = $dir . "/logo/" . $logo['name'];
            try {
                $this->companyModel->createNewCompany($_SESSION['id'], $name, $location, $industry, $website);
                $insert_id = $this->companyModel->insert_id();
                $this->companyModel->updateCompanyProfile($cover['name'], $logo['name'], $insert_id);
                move_uploaded_file($cover['tmp_name'], $upload_cover);
                move_uploaded_file($logo['tmp_name'], $upload_logo);
            } catch (mysqli_sql_exception $e) {
            }
        }
        $this->redirect('/provider/job');
    }

    public function createJob() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $location = $_POST['location'];
            $description = $_POST['description'];
            $salary = $_POST['salary'];
            $vacancy = $_POST['vacancy'];
            $company_id = $_POST['company_id'];
            $place = $_POST['place'];
            $type = $_POST['type'];
            $skills = $_POST['skills'];
            $skillList = json_decode($skills);
            try {
                $this->jobModel->ceateNewJob($company_id, $title, $description, $salary, $location, $vacancy, $place, $type);
                $insert_id = $this->jobModel->insert_id();
                for ($i = 0; $i < count($skillList); $i++) {
                    $this->jobSkillModel->createNewJobSkill($insert_id, $skillList[$i]);
                }
            } catch (mysqli_sql_exception $e) {
            }
        }
    }

    public function updateJobSkills() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $job_id = $_POST['job_id'];
            $skills = $_POST['skills'];
            $skillList = json_decode($skills);
            try {
                $this->jobSkillModel->deleteJobSkill($job_id);
                for ($i = 0; $i < count($skillList); $i++) {
                    $this->jobSkillModel->createNewJobSkill($job_id, $skillList[$i]);
                }
            } catch (mysqli_sql_exception $e) {
            }
        }
    }

    public function updateCompanyCover() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cover = $_FILES['cover'];
            $company_id = $_POST['company_id'];
            $path = $_POST['path'];	
            $dir = __DIR__ . "/../assets/images/company/";
            $upload_cover = $dir . "/cover/" . $cover['name'];
            $this->companyModel->updateCompanyCover($cover['name'], $company_id);
            move_uploaded_file($cover['tmp_name'], $upload_cover);     
            $this->redirect($path);   
        }
    }
}

