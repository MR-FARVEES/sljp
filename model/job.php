<?php
require_once __DIR__ ."/../core/model.php";

class JobModel extends Model { 
    private $create_job_title_table = "
        CREATE TABLE IF NOT EXISTS `job` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            company_id INT REFERENCES `company` (id) ON DELETE CASCADE,
            title VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            salary DECIMAL(10,2) NOT NULL,
            location VARCHAR(100) NOT NULL,
            vacancy INT NOT NULL,
            place ENUM('On-Site', 'Remote', 'Hybrid') DEFAULT 'Hybrid',
            type ENUM('Full Time', 'Part Time', 'Freelance', 'Internship', 'Contract', 'Temporary', 'Volenteer') DEFAULT 'Full Time',
            posted_at DATETIME DEFAULT (CURRENT_TIMESTAMP),
            status ENUM('Active', 'Inactive') DEFAULT 'Active'
        );
    ";
    private $insert_job = "INSERT INTO `job` (company_id, title, description, salary, location, vacancy, place, type) VALUES (?,?,?,?,?,?,?,?);";
    private $update_status = "UPDATE `job` SET status = ? WHERE id = ?";
    private $delete_job = "DELETE FROM `job` WHERE id = ?";
    private $get_jobs = "SELECT * FROM `job` WHERE company_id = ?";
    private $get_job = "SELECT * FROM `job` WHERE id = ?";
    private $get_all_jobs = "SELECT * FROM `job`";
    private $get_all_jobs_by_title = "SELECT * FROM `job` WHERE ";

    public function __construct() {
        parent::__construct();
        $this->createJob();
    }

    public function createJob() {
        $this->create($this->create_job_title_table);
    }

    public function ceateNewJob($company_id, $title, $description, $salary, $location, $vacancy, $place, $type) {
        $this->insert($this->insert_job, [$company_id, $title, $description, $salary, $location, $vacancy, $place, $type], "issdsiss");
    }

    public function updateStatus($status, $id) {
        $this->update($this->update_status, [$status, $id], "si");
    }

    public function deleteJob($id) {
        $this->delete($this->delete_job, [$id], "i");
    }

    public function getAllJobs($company_id) {
        return $this->fetch($this->get_jobs, [$company_id], "i");
    }

    public function getJobs() {
        return $this->fetch($this->get_all_jobs);
    }

    public function getJobsByTitle($titles) {
        $params = [];
        $whereClause = [];
        foreach($titles as $key => $value) {
            $params[] = '%' . $value;
            $params[] = '%' . $value . '%';
            $whereClause[]= "title LIKE ?";
            $whereClause[]= "title LIKE ?";
        }
        $whereClauseString = implode(" OR ", $whereClause);
        return $this->fetch(
            $this->get_all_jobs_by_title . $whereClauseString,
            $params,
            str_repeat("s", count($params))
        );
    }

    public function getJob($jobId) {
        return $this->fetch($this->get_job, [$jobId], "i");
    }
}

