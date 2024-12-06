<?php
require_once __DIR__ ."/../core/model.php";

class SkillModel extends Model {
    private $create_skill_table = "
        CREATE TABLE IF NOT EXISTS `skill` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(50) NOT NULL
        );
    ";
    private $insert_skill = "INSERT INTO `skill` (title) VALUES (?);";
    private $get_all = "SELECT * FROM `skill`";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_skill_table);
    }

    public function createNewSkill($title) {
        $this->create($this->create_skill_table);
    }

    public function getAllSkills() {
        return $this->fetch($this->get_all);
    }
}