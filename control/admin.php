<?php
require_once __DIR__ ."/user.php";
require_once __DIR__ ."/../model/skills.php";
require_once __DIR__ ."/../model/university.php";
require_once __DIR__ ."/../model/degree.php";
require_once __DIR__ ."/../model/field.php";

class AdminController extends UserController {
    private $skillModel;
    private $universityModel;
    private $degreeModel;
    private $fieldModel;

    public function __construct() {
        parent::__construct();
        $this->initNav();   
        $this->skillModel = new SkillModel();
        $this->universityModel = new UniversityModel();
        $this->degreeModel = new DegreeModel();
        $this->fieldModel = new FieldModel();
    }

    public function dashboard() {
        include_once __DIR__ ."/../view/admin/dashboard.php";
    }

    public function createSkill() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $skill = $_POST['skill'];
            $this->skillModel->createNewSkill($skill);
        }
        $this->redirect('/admin?page=skill');
    }

    public function removeSkill() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->skillModel->removeSkill($id);
        }
        $this->redirect('/admin?page=skill');
    }

    public function createUniversity() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $university = $_POST['university'];
            $upload = __DIR__ . '/../assets/images/university/' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $upload);
            $this->universityModel->createNewUniversity($university, $_FILES['image']['name']);
        }
        $this->redirect('/admin?page=university');
    }

    public function removeUniversity() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $unis = $this->universityModel->getUniversity($id);
            while ($uni = $unis->fetch_assoc()) {
                $unlink = __DIR__ . "/../assets/images/university/" . $uni["logo"];
                if (file_exists($unlink)) {
                    unlink($unlink);
                }
            }
            $this->universityModel->removeUniversity($id);
        }
        $this->redirect('/admin?page=university');
    }

    public function createDegree() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $degree = $_POST['degree'];
            $this->degreeModel->createNewDegree($degree);
        }
        $this->redirect('/admin?page=degree');
    }

    public function removeDegree() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->degreeModel->deleteDegree($id);
        }
        $this->redirect('/admin?page=degree');
    }

    public function createField() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $field = $_POST['field'];
            $this->fieldModel->CreateNewField($field);
        }
        $this->redirect('/admin?page=field');
    }

    public function removeField() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->fieldModel->deleteField($id);
        }
        $this->redirect('/admin?page=field');
    }
}