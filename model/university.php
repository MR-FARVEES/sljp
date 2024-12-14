<?php
require_once __DIR__ ."/../core/model.php";

class UniversityModel extends Model {
    private $create_university_table = "
        CREATE TABLE IF NOT EXISTS `university` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            logo VARCHAR(100) NOT NULL
        );
    ";
    private $insert_uni = "INSERT INTO `university` (name, logo) VALUES (?,?);";
    private $get_uni = "SELECT * FROM `university` WHERE id = ?";
    private $get_all = "SELECT * FROM `university`";
    private $delete_uni = "DELETE FROM `university` WHERE id = ?";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_university_table);
    }

    public function createNewUniversity($name, $logo) {
        $this->create($this->insert_uni, [$name, $logo], "ss");
    }

    public function getUniversity($id) {
        return $this->fetch($this->get_uni, [$id],"i");
    }

    public function getAllUniversities() {
        return $this->fetch($this->get_all);
    }

    public function removeUniversity($id) {
        $this->delete($this->delete_uni, [$id],"i");
    }
}