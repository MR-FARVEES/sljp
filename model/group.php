<?php
require_once __DIR__ ."/../core/model.php";

class GroupModel extends Model {
    private $create_group_table = "
        CREATE TABLE IF NOT EXISTS `group` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            owner INT REFERENCES `user` (id) ON DELETE CASCADE,
            description TEXT,
            logo VARCHAR(256) NOT NULL,
            cover_image VARCHAR(256),
            created DATE DEFAULT (CURRENT_TIMESTAMP)
        );
    ";
    private $insert_group = "INSERT INTO `group` (name, owner, description, logo, cover_image) VALUES (?,?,?,?,?,?);";
    private $get_all_groups = "SELECT * FROM `group`";
    private $get_group_info = "SELECT * FROM `group` WHERE id = ?";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_group_table);
    }

    public function createNewGroup($name, $owner, $desc, $logo, $cover) {
        $this->insert($this->insert_group, [$name, $owner, $desc, $logo, $cover], "sisss");
    }

    public function getAllGroups() {
        return $this->fetch($this->get_all_groups);
    }

    public function getGroupById($id) {
        return $this->fetch($this->get_group_info, [$id], "i");
    }
}