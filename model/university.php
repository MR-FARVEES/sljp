<?php
require_once __DIR__ ."/../core/model.php";

class UniversityModel extends Model {
    private $create_university_table = "
        CREATE TABLE IF NOT EXISTS `university` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            name VARCHAR(100) NOT NULL,
            status ENUM('verified', 'not') DEFAULT 'not'
        );
    ";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_university_table);
    }
}