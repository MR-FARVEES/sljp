<?php
require_once __DIR__ ."/../core/model.php";

class JobTitleModel extends Model { 
    private $create_job_title_table = "
        CRAEATE TABLE IF NOT EXISTS `job_title` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(100) UNIQUE
        );
    ";
    private $insert_title = "INSERT INTO `job_title` (title) VALUES (?);";
    private $get_all = "SELECT * FROM `job_title`";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_job_title_table);
    }

    public function createNewTitle($title) {
        $this->insert($this->insert_title, [$title], "s");
    }

    public function getAllTitles() {
        return $this->fetch($this->get_all);
    }
}

