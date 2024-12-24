<?php
require_once __DIR__ . "/../core/model.php";

class UserModel extends Model
{
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
            profile VARCHAR(256) DEFAULT 'default.jpg',
            cover VARCHAR(256) DEFAULT 'default.jpg',
            nic VARCHAR(20) UNIQUE,
            role ENUM('seeker', 'provider', 'admin'),
            status ENUM('Open', 'Hire', 'None') DEFAULT 'None',
            headline VARCHAR(512) default 'N/A',
            show_school ENUM('show', 'hide') DEFAULT 'show'
        );
    ";
    private $insert_user = "INSERT INTO `user` (first, last, username, password, email, contact, gender, dob, address, nic, role) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
    private $auth_user = "SELECT id, first, last, email, gender, role, contact, nic, profile, cover, status FROM `user` WHERE username = ? AND password = ?";
    private $update_password = "UPDATE `user` SET password = ? WHERE id = ?";
    private $delete_user = "DELETE FROM `user` WHERE id = ?";
    private $get_all = "SELECT * FROM `user`";
    private $user_count = "SELECT COUNT(*) as count FROM `user`";
    private $user_info = "SELECT * FROM `user` WHERE id = ?";
    private $update_user = "UPDATE `user` SET first = ?, last = ?, headline = ?, address = ?, show_school = ? WHERE id = ?";
    private $search_query = "SELECT * FROM `user` WHERE (first LIKE ? OR first LIKE ? OR first LIKE ? OR last LIKE ? OR last LIKE ? OR last LIKE ?) AND NOT role = 'admin';";
    private $match_headline = "SELECT * FROM `user` WHERE ";
    private $update_profile = "UPDATE `user` SET profile = ? WHERE id = ?";
    private $update_cover = "UPDATE `user` SET cover = ? WHERE id = ?";

    public function __construct()
    {
        parent::__construct();
        $this->Init();
    }

    public function Init()
    {
        $this->create($this->create_user_table);
    }

    public function createNewUser($first, $last, $username, $password, $email, $contact, $gener, $dob, $address, $nic, $role)
    {
        $this->insert($this->insert_user, [$first, $last, $username, $password, $email, $contact, $gener, $dob, $address, $nic, $role], "sssssssssss");
    }

    public function authenticate($username, $password)
    {
        return $this->fetch($this->auth_user, [$username, $password], "ss");
    }

    public function updatePassword($id, $password)
    {
        $this->update($this->update_password, [$id, $password], "is");
    }

    public function deleteUser($id)
    {
        $this->delete($this->delete_user, [$id], "i");
    }

    public function getAllUsers()
    {
        return $this->fetch($this->get_all);
    }

    public function count()
    {
        $result = $this->fetch($this->user_count);
        while ($row = $result->fetch_assoc()) {
            return $row["count"];
        }
    }

    public function getUserInfo($id)
    {
        return $this->fetch($this->user_info, [$id], "i");
    }

    public function updateSeeker($first, $last, $headline, $address, $show, $id)
    {
        $this->update($this->update_user, [$first, $last, $headline, $address, $show, $id], "sssssi");
    }

    public function searchUsersByQuery($query)
    {
        return $this->fetch(
            $this->search_query,
            [
                $query . '%',
                '%' . $query,
                '%' . $query . '%',
                $query . '%',
                '%' . $query,
                '%' . $query . '%'
            ],
            "ssssss"
        );
    }

    public function getUsersByHeadlineMatching($heads)
    {
        $whereClause = [];
        $params = [];
        foreach ($heads as $key => $value) {
            $whereClause[] = 'headline LIKE ?';
            $params[] = '%' . $value . '%';
        }
        $whereClauseString = implode(' OR ', $whereClause);
        $whereClauseString = "($whereClauseString) AND NOT role = 'admin'";
        return $this->fetch(
            $this->match_headline . $whereClauseString,
            $params,
            str_repeat('s', count($params))
        );
    }

    public function updateProfile($profile, $id)
    {
        $this->update($this->update_profile, [$profile, $id], "si");
    }

    public function updateCover($cover, $id) {
        $this->update($this->update_cover, [$cover, $id], "si");
    }
}