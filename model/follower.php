<?php
require_once __DIR__ . "/../core/model.php";

class FollowerModel extends Model
{
    private $create_follower_table = "
        CREATE TABLE IF NOT EXISTS `follower` (
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            follow_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            PRIMARY KEY (user_id, follow_id)
        );
    ";
    private $insert_follower = "INSERT INTO `follower` (user_id, follow_id) VALUES (?, ?);";
    private $get_follower = "SELECT * FROM `follower` WHERE user_id = ? AND follow_id = ?";
    private $get_all_followers = "SELECT * FROM `follower` WHERE user_id = ?";
    private $get_follower_count = "SELECT COUNT(*) as count FROM `follower` WHERE user_id = ?";
    private $delete_follower = "DELETE FROM `follower` WHERE user_id = ? AND follow_id = ?";

    public function __construct()
    {
        parent::__construct();
        $this->createFollower();
    }

    public function createFollower()
    {
        $this->create($this->create_follower_table);
    }

    public function createNewFollower($user_id, $follow_id)
    {
        $this->insert($this->insert_follower, [$user_id, $follow_id], "ii");
    }

    public function getFollower($user_id, $follow_id)
    {
        return $this->fetch($this->get_follower, [$user_id, $follow_id], "ii");
    }

    public function getAllFollowers($user_id)
    {
        return $this->fetch($this->get_all_followers, [$user_id], "i");
    }

    public function deleteFollower($user_id, $follow_id)
    {
        $this->delete($this->delete_follower, [$user_id, $follow_id], "ii");
    }

    public function isFollower($user_id, $follow_id)
    {
        $follower = $this->getFollower($user_id, $follow_id);
        while ($data = $follower->fetch_assoc()) {
            return true;
        }
        return false;
    }

    public function getFollowerCount($user_id)
    {
        return $this->fetch($this->get_follower_count, [$user_id], "i");
    }
}