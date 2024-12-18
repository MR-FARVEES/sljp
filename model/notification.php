<?php
require_once __DIR__ ."/../core/model.php";

class NotificationModel extends Model {
    private $create_notification_table = "
        CREATE TABLE IF NOT EXISTS `notification` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            evt_data INT,
            evt_type ENUM('follow', 'post', 'event')
        );
    ";
    private $insert_notification = "INSERT INTO `notification` (user_id, evt_data, evt_type) VALUES (?, ?, ?);";
    private $get_all_notification = "SELECT * FROM `notification` WHERE user_id = ?";
    private $delete_notification = "DELETE FROM `notification` WHERE id = ?";
    private $get_notification_count = "SELECT COUNT(*) as count FROM `notification` WHERE user_id = ?";

    public function __construct() {
        parent::__construct();
        $this->createNotification();
    }

    public function createNotification() {
        $this->create($this->create_notification_table);
    }

    public function createNewNotification($user_id, $evt_data, $evt_type) {
        $this->insert($this->insert_notification, [$user_id, $evt_data, $evt_type], 'iis');
    }

    public function getAllNotifications($user_id) {
        return $this->fetch($this->get_all_notification, [$user_id], "i");
    }

    public function deleteNotification($id) {
        $this->delete($this->delete_notification, [$id], 'i');
    }

    public function getNotificationCount($user_id) {
        return $this->fetch($this->get_notification_count, [$user_id], 'i');
    }
}