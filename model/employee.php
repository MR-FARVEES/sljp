<?php
require_once __DIR__ . "/../core/model.php";

class EmployeeModel extends Model {
    private $create_employee_table = "
        CREATE TABLE IF NOT EXISTS `employee` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            company_id INT REFERENCES `company` (id) ON DELETE CASCADE,
            position ENUM('founder', 'manager', 'employee') DEFAULT 'employee',
            department ENUM('HR', 'IT', 'Marketing', 'Finance') DEFAULT 'HR'
        );
    ";
    private $insert_employee = "INSERT INTO `employee` (user_id, company_id, position, department) VALUES (?,?,?,?);";
    private $get_employee = "SELECT * FROM `employee` WHERE user_id = ?";
    private $get_all_employees = "SELECT * FROM `employee` WHERE company_id = ?";

    public function __construct() {
        parent::__construct();
        $this->createEmployee();
    }

    public function createEmployee() {
        $this->create($this->create_employee_table);
    }

    public function createNewEmployee($user_id, $company_id, $position, $department) {
        $this->insert($this->insert_employee, [$user_id, $company_id, $position, $department], "iiss");
    }

    public function getEmployee($user_id) {
        return $this->fetch($this->get_employee, [$user_id], "i");
    }

    public function getAllEmployees($compan_id) {
        return $this->fetch($this->get_all_employees, [$compan_id], "i");
    }
}