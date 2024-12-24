<?php 
require_once __DIR__ . "/../core/model.php";

class CommentModel extends Model {
    private $create_comment_table = "
        CREATE TABLE IF NOT EXISTS `comment` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            post_id INT REFERENCES `post` (id) ON DELETE CASCADE,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            content TEXT NOT NULL,
            created_at DATETIME DEFAULT (CURRENT_TIMESTAMP)
        );
    ";
    private $insert_comment = "INSERT INTO `comment` (post_id, user_id, content) VALUES (?,?,?);";
    private $get_all_comments = "SELECT * FROM `comment` WHERE ";

    public function __construct() {
        parent::__construct();
        $this->createComment();
    }

    public function createComment() {
        $this->create($this->create_comment_table);
    }

    public function createNewComment($post_id, $user_id, $content) {
        $this->insert($this->insert_comment, [$post_id, $user_id, $content], "iis");
    }

    public function getAllComments($ids) {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $mask = "post_id IN ($placeholders) ORDER BY created_at ASC";
        echo $mask;
        return $this->fetch(
            $this->get_all_comments . $mask,
            $ids,
            str_repeat('i', count($ids))
        );
    }
}