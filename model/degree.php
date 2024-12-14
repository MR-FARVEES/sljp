<?php
require_once __DIR__ ."/../core/model.php";

class DegreeModel extends Model {
    private $create_degree_table = "
        CREATE TABLE IF NOT EXISTS `degree`(
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(50) NOT NULL
        );
    ";
    private $insert_degree = "INSERT INTO `degree` (title) VALUES (?);";
    private $get_degrees = "SELECT * FROM `degree`";
    private $delete_degree = "DELETE FROM `degree` WHERE id = ?";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_degree_table);
    }

    public function createNewDegree($title) {
        $this->insert($this->insert_degree, [$title], "s");
    }

    public function getAllDegrees() {
        return $this->fetch($this->get_degrees);
    }

    public function deleteDegree($id) {
        $this->delete($this->delete_degree, [$id],"i");
    }
}