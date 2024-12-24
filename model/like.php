<?php 
require_once __DIR__ . "/../core/model.php";

class LikeModel extends Model {
    private $create_like_table = "
        CREATE TABLE IF NOT EXISTS `like` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            post_id INT REFERENCES `post` (id) ON DELETE CASCADE,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            UNIQUE(post_id, user_id),
            created_at DATETIME DEFAULT (CURRENT_TIMESTAMP)
        );
    ";
    private $insert_like = "INSERT INTO `like` (post_id, user_id) VALUES (?,?);";
    private $delete_like = "DELETE FROM `like` WHERE post_id = ? AND user_id = ?";
    private $get_like = "SELECT * FROM `like` WHERE post_id = ? AND user_id = ?";
    private $get_all_like = "SELECT * FROM `like` WHERE post_id = ?";
    private $get_like_count = "SELECT COUNT(*) as count FROM `like` WHERE post_id = ?";

    public function __construct() {
        parent::__construct();
        $this->createLike();
    }

    public function createLike() {
        $this->create($this->create_like_table);
    }

    public function createNewLike($post_id, $user_id) {
        try {
            $this->insert($this->insert_like, [$post_id, $user_id], "ii");
        } catch (mysqli_sql_exception $e) {
            $this->deleteLike($post_id, $user_id);
        }
    }

    public function deleteLike($post_id, $user_id) {
        $this->delete($this->delete_like, [$post_id, $user_id], "ii");
    }

    public function getLike($post_id, $user_id) {
        return $this->fetch($this->get_like, [$post_id, $user_id], "ii");
    }

    public function getAllLike($post_id) {
        return $this->fetch($this->get_all_like, [$post_id], "i");
    }

    public function getLikeCount($post_id) {
        return $this->fetch($this->get_like_count, [$post_id], "i");
    }
}