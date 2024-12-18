<?php
require_once __DIR__ . "/../core/model.php";

class MessageModel extends Model {
    private $create_message_table = "
        CREATE TABLE IF NOT EXISTS `message` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            send INT REFERENCES `user` (id) ON DELETE CASCADE,
            recv INT REFERENCES `user` (id) ON DELETE CASCADE,
            msg_data VARCHAR(256),
            date_time DATETIME DEFAULT (CURRENT_TIMESTAMP),
            msg_type ENUM ('text', 'image', 'post'),
            reply INT REFERNCES `message` (id) ON DELETE CASCADE
        );
    ";
    private $insert_message = "INSERT INTO `message` (send, recv, msg_data, date_time, msg_type, reply) VALUES (?,?,?,?,?,?);";
    private $get_all_message = "SELECT * FROM `message` WHERE send = ? OR recv = ? ORDER BY date_time ASC";
    private $get_all_reply = "SELECT * FROM `message` WHERE reply = ?";


    public function __construct() {
        parent::__construct();
        $this->createMessage();
    }

    public function createMessage() {
        $this->create($this->create_message_table);
    }

    public function createNewMessage($send, $recv, $msg_data, $date_time, $msg_type, $reply) {
        $this->insert($this->insert_message, [$send, $recv, $msg_data, $date_time, $msg_type, $reply], "iisssi");
    }

    public function getAllMessages($id) {
        return $this->fetch($this->get_all_message, [$id, $id], "ii");
    }

    public function getAllReplies($id) {
        return $this->fetch($this->get_all_reply, [$id, $id], "ii");
    }
}