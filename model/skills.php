<?php
require_once __DIR__ . "/../core/model.php";

class SkillModel extends Model
{
    private $create_skill_table = "
        CREATE TABLE IF NOT EXISTS `skill` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(50) NOT NULL
        );
    ";
    private $insert_skill = "INSERT INTO `skill` (title) VALUES (?);";
    private $get_all = "SELECT * FROM `skill`";
    private $get_skill = "SELECT * FROM `skill` WHERE id = ?";
    private $delete_skill = "DELETE FROM `skill` WHERE id = ?";

    public function __construct()
    {
        parent::__construct();
        $this->Init();
    }

    public function Init()
    {
        $this->create($this->create_skill_table);
    }

    public function createNewSkill($title)
    {
        $this->insert($this->insert_skill, [$title], "s");
    }

    public function getAllSkills()
    {
        return $this->fetch($this->get_all);
    }

    public function getSkill($id)
    {
        return $this->fetch($this->get_skill, [$id], "i");
    }

    public function removeSkill($id)
    {
        $this->delete($this->delete_skill, [$id], "i");
    }
}