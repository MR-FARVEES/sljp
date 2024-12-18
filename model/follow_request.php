<?php
require_once __DIR__ . "/../core/model.php";

class FollowRequestModel extends Model {
    private $create_follow_request_table = "
        CREATE TABLE IF NOT EXISTS `follow_request` (
            id INT PRIMARY KEY  AUTO_INCREMENT,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            request_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            UNIQUE(user_id, request_id)
        );
    ";
    private $insert_request = "INSERT INTO `follow_request` (user_id, request_id) VALUES (?, ?);";
    private $get_request = "SELECT * FROM `follow_request` WHERE id = ?";
    private $delete_request = "DELETE FROM `follow_request` WHERE id = ?";

    public function __construct() {
        parent::__construct();
        $this->createFollowRequest();
    }

    public function createFollowRequest() {
        $this->create($this->create_follow_request_table);
    }

    public function createNewFollowRequest($user_id, $request_id) {
        $this->insert($this->insert_request, [$user_id, $request_id], "ii");
    }

    public function getFollowRequest($id) {
        return $this->fetch($this->get_request, [$id],"i");
    }

    public function deleteFollowRequest($id) {
        $this->delete($this->delete_request, [$id],"i");
    }
}