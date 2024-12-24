<?php
require_once __DIR__ . "/../core/model.php";

class CompanyModel extends Model {
    private $company_table = "
        CREATE TABLE IF NOT EXISTS `company` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            founder INT REFERENCES `user` (id) ON DELETE CASCADE,
            name VARCHAR(100) UNIQUE,
            location VARCHAR(100),
            industry VARCHAR(100),
            website VARCHAR(100),
            cover VARCHAR(255) DEFAULT 'default.jpg',
            logo VARCHAR(255) DEFAULT 'default.jpg',
            founded_at DATE DEFAULT (CURRENT_TIMESTAMP)
        );
    ";
    private $insert_company = "INSERT INTO `company` (founder, name, location, industry, website) VALUES (?,?,?,?,?);";
    private $update_company_profile = "UPDATE `company` SET cover = ?, logo = ? WHERE id = ?";		
    private $get_company = "SELECT * FROM `company` WHERE founder = ?";
    private $get_company_by_id = "SELECT * FROM `company` WHERE id = ?";
    private $get_all_companies = "SELECT * FROM `company`";
    private $update_company = "UPDATE `company` SET name = ?, location = ?, industry = ?, website = ?, founded_at = ? WHERE id = ?";
    private $delete_company = "DELETE FROM `company` WHERE id = ?";

    public function __construct() {
        parent::__construct();
        $this->createCompany();
    }

    public function createCompany() {
        $this->create($this->company_table);
    }

    public function createNewCompany($founder, $name, $location, $industry, $website) {
        $this->insert($this->insert_company, [$founder, $name, $location, $industry, $website], "issss");
    }

    public function updateCompanyProfile($cover, $logo, $id) {
        $this->update($this->update_company_profile, [$cover, $logo, $id], "ssi");
    }

    public function getCompany($id) {
        return $this->fetch($this->get_company, [$id], "i");
    }

    public function getAllCompanies() {
        return $this->fetch($this->get_all_companies);
    }

    public function updateCompany($name, $location, $industry, $website, $founded_at, $id) {
        $this->update($this->update_company, [$name, $location, $industry, $website, $founded_at, $id], "sssssi");
    }

    public function deleteCompany($id) {
        $this->delete($this->delete_company, [$id], "i");
    }

    public function getCompanyById($id) {
        return $this->fetch($this->get_company_by_id, [$id], "i");
    }
}