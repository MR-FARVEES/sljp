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
            msg_type ENUM ('text', 'image', 'post')
        );
    ";
    private $insert_message = "INSERT INTO `message` (send, recv, msg_data, msg_type) VALUES (?,?,?,?);";
    private $get_all_message = "SELECT * FROM `message` WHERE (send = ? AND recv = ?) OR (send = ? AND recv = ?) ORDER BY date_time ASC";


    public function __construct() {
        parent::__construct();
        $this->createMessage();
    }

    public function createMessage() {
        $this->create($this->create_message_table);
    }
    

    public function createNewMessage($send, $recv, $msg_data, $msg_type) {
        $this->insert($this->insert_message, [$send, $recv, $msg_data, $msg_type], "iiss");
    }

    public function getAllMessages($sid, $rid) {
        return $this->fetch($this->get_all_message, [$sid, $rid, $rid, $sid], "iiii");
    }
}