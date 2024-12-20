<?php
require_once __DIR__ . "/../core/model.php";

class UserSkillModel extends Model
{
    private $create_user_skill_table = "
        CREATE TABLE IF NOT EXISTS `user_skill` (
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            skill VARCHAR(50) NOT NULL,
            PRIMARY KEY (user_id, skill)
        );
    ";
    private $insert_skill = "INSERT INTO `user_skill` (user_id, skill) VALUES (?,?);";
    private $get_all = "SELECT skill FROM `user_skill` WHERE user_id = ?";

    public function __construct()
    {
        parent::__construct();
        $this->Init();
    }

    private function Init()
    {
        $this->create($this->create_user_skill_table);
    }

    public function createNewSkill($user_id, $skill)
    {
        $this->insert($this->insert_skill, [$user_id, $skill], "is");
    }

    public function getAllSkills($user_id)
    {
        return $this->fetch($this->get_all, [$user_id], "i");
    }
}