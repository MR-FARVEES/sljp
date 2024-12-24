<?php
require_once __DIR__ ."/../core/model.php";

class JobApplicantModel extends Model {
    private $create_job_applicant_table = "
        CREATE TABLE IF NOT EXISTS `job_applicant` (
            job_id INT REFERENCES `job` (id) ON DELETE CASCADE,
            applicant INT REFERENCES `user` (id) ON DELETE CASCADE,
            PRIMARY KEY (job_id, applicant)
        );
    ";
    private $insert_applicant = "INSERT INTO `job_applicant` (job_id, applicant) VALUES (?, ?);";
    private $get_all_applicant = "SELECT * FROM `job_applicant` WHERE job_id = ?";
    private $get_count = "SELECT COUNT(*) as count FROM `job_applicant` WHERE job_id = ?";

    public function __construct() {
        parent::__construct();
        $this->createJobApplicant();
    }

    public function createJobApplicant() {
        $this->create($this->create_job_applicant_table);
    }

    public function createNewApplicant($job_title, $applicant) {
        $this->insert($this->insert_applicant, [$job_title, $applicant], "ii");
    }

    public function getAllApplicants($job_id) {
        return $this->fetch($this->get_all_applicant, [$job_id], "i");
    }

    public function getApplicantsCount($job_id) {
        return $this->fetch($this->get_count, [$job_id], "i");
    }
}