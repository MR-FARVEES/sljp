<?php
require_once __DIR__ . '/../core/model.php';

class PostModel extends Model
{
    private $create_post_table = "
        CREATE TABLE IF NOT EXISTS `post` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            post_text TEXT NOT NULL,
            post_source VARCHAR(255) DEFAULT 'N/A',
            posted_at DATETIME DEFAULT (CURRENT_TIMESTAMP)
        );
    ";
    private $insert_post = "INSERT INTO `post` (user_id, post_text) VALUES (?,?);";
    private $update_post = "UPDATE `post` SET post_source = ? WHERE id = ?";
    private $get_all_posts = "SELECT * FROM `post` WHERE ";
    private $delete_post = "DELETE FROM `post` WHERE id = ?";

    public function __construct()
    {
        parent::__construct();
        $this->createPost();
    }

    public function createPost()
    {
        $this->create($this->create_post_table);
    }

    public function createNewPost($user_id, $post_text)
    {
        $this->insert($this->insert_post, [$user_id, $post_text], "is");
    }

    public function updatePost($source, $id)
    {
        $this->update($this->update_post, [$source, $id], "si");
    }

    public function getAllPosts($ids)
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $mask = "user_id IN ($placeholders) ORDER BY posted_at ASC";
        return $this->fetch(
            $this->get_all_posts . $mask,
            $ids,
            str_repeat('i', count($ids))
        );
    }

    public function deletePost($id)
    {
        $this->delete($this->delete_post, [$id], 'i');
    }
}