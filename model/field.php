<?php
require_once __DIR__ ."/../core/model.php";

class FieldModel extends Model {
    private $create_field_table = "
        CREATE TABLE IF NOT EXISTS `field` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(50) NOT NULL
        );
    ";
    private $insert_field = "INSERT INTO `field` (title) VALUES (?);";
    private $get_fields = "SELECT * FROM `field`";
    private $delete_field = "DELETE FROM `field` WHERE id = ?";

    public function __construct() {
        parent::__construct();
        $this->Init();
    }

    public function Init() {
        $this->create($this->create_field_table);
    }

    public function CreateNewField($title) {
        $this->insert($this->insert_field, [$title], "s");
    }

    public function deleteField($id) {
        $this->delete($this->delete_field, [$id], "i");
    }

    public function getAllFields() {
        return $this->fetch($this->get_fields);
    }
}