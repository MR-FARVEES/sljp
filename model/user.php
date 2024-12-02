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
    
    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_user_table);
    }
}