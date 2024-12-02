<?php
require_once __DIR__ ."/../core/model.php";

class UserModel extends Model {
    private $create_user_table = "
        CREATE TABLE IF NOT EXISTS `user` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            first VARCHAR(100) NOT NULL,
            last VARCHAR(100),
            username VARCHAR(100) UNIQUE,
            password VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE,
            contact VARCHAR(20) UNIQUE,
            gender ENUM('Male', 'Female') DEFAULT 'Male',
            dob DATE NOT NULL,
            address TEXT,
            profile VARCHAR(256) NOT NULL,
            nic VARCHAR(20) UNIQUE,
            role ENUM('seeker', 'provider', 'admin')
        );
    ";
    private $insert_user = "INSERT INTO `user` (first, last, username, password, email, contact, gender, dob, address, profile, nic, role) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
    private $auth_user = "SELECT id, first, last, email, gender, role, contact, nic, profile FROM `user` WHERE username = ? AND password = ?";
    private $update_password = "UPDATE `user` SET password = ? WHERE id = ?";
    private $delete_user = "DELETE FROM `user` WHERE id = ?";
    private $get_all = "SELECT * FROM `user`";
    private $user_count = "SELECT COUNT(*) as count FROM `user`";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_user_table);
    }

    public function createNewUser($first, $last, $username, $password, $email, $contact, $gener, $dob, $address, $profile, $nic, $role) {
        $this->insert($this->insert_user, [$first, $last, $username, $password, $email, $contact, $gener, $dob, $address, $profile, $nic, $role], "ssssssssssss");
    }

    public function authenticate($username, $password) {
        return $this->fetch($this->auth_user, [$username, $password], "ss");
    }

    public function updatePassword($id, $password) {
        $this->update($this->update_password, [$password, $password],"is");
    }

    public function deleteUser($id) {
        $this->delete($this->delete_user, [$id], "i");
    }

    public function getAllUsers() {
        return $this->fetch($this->get_all);
    }

    public function count() {
        $result = $this->fetch($this->user_count);
        while ($row = $result->fetch_assoc()) {
            return $row["count"];
        }
    }
}