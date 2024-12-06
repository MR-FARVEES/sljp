<?php
require_once __DIR__ ."/../core/model.php";

class SkillModel extends Model {
    private $create_user_skill_table = "
        CREATE TABLE IF NOT EXISTS `user_skill` (
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            skill_id INT REFERENCES `skill` (id) ON DELETE CASCADE,
            PRIMARY KEY (user_id, skill_id)
        );
    ";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    private function Init() {

    }
}