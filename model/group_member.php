<?php
require_once __DIR__ ."/../core/model.php";

class GroupMemberModel extends Model {
    private $create_group_member_table = "
        CREATE TABLE IF NOT EXISTS `group_member` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            group INT REFERENCES `group` (id) ON DELETE CASCADE,
            user INT REFERENCES `user` (id) ON DELETE CASCADE
        );
    ";

    public function __construct() {
        parent::__construct();
    }

    public function Init() {
        $this->create($this->create_group_member_table);
    }
}