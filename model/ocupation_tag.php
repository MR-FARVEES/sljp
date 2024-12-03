<?php
require_once __DIR__ ."/../core/model.php";

class OccupationTagModel extends Model {
    private $create_occupation_table = "
        CREATE TABLE IF NOT EXISTS `occupation_tag` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            name VARCHAR(100) NOT NULL
        );
    ";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_occupation_table);
    }
}