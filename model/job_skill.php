<?php
require_once __DIR__ . "/../core/model.php";
require_once __DIR__ . "/skills.php";

class JobSkillModel extends Model {
    private $skillModel;
    private $create_job_skill_table = "
        CREATE TABLE IF NOT EXISTS job_skill (
            id INT AUTO_INCREMENT PRIMARY KEY,
            job_id INT REFERENCES job (id) ON DELETE CASCADE,
            skill VARCHAR(100) NOT NULL
        );
    ";
    private $insert_job_skill = "INSERT INTO job_skill (job_id, skill) VALUES (?, ?);";
    private $delete_job_skill = "DELETE FROM job_skill WHERE job_id = ?;";
    private $select_job_skill = "SELECT * FROM job_skill WHERE job_id = ?;";
    private $count = "SELECT COUNT(*) as count FROM job_skill WHERE job_id = ?;";

    public function __construct() {
        parent::__construct();
        $this->createJobSkill();
        $this->skillModel = new SkillModel();
    }

    public function createJobSkill() {
        $this->create($this->create_job_skill_table);
    }

    public function createNewJobSkill($job_id, $skill) {
        $skills = $this->skillModel->checkSkill($skill);
        if (empty($skills)) {
            $this->skillModel->createNewSkill($skill);
        }
        $this->insert($this->insert_job_skill, [$job_id, $skill], "is");
    }

    public function deleteJobSkill($job_id) {
        $this->delete($this->delete_job_skill, [$job_id], "i");
    }

    public function getJobSkills($job_id) {
        return $this->fetch($this->select_job_skill, [$job_id], "i");
    }

    public function countJobSkill($job_id) {
        return $this->fetch($this->count, [$job_id], "i");
    }
}