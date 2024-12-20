<?php
require_once __DIR__ . "/../core/model.php";

class EducationModel extends Model
{
    private $create_education_table = "
        CREATE TABLE IF NOT EXISTS `education` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT REFERENCES `user` (id) ON DELETE CASCADE,
            institude INT REFERENCES `university` (id) ON DELETE CASCADE,
            degree VARCHAR(50) NOT NULL,
            field VARCHAR(50) NOT NULL,
            smonth VARCHAR(2) NOT NULL,
            syear VARCHAR(4) NOT NULL,
            emonth VARCHAR(2) NOT NULL,
            eyear VARCHAR(4) NOT NULL,
            grade DECIMAL(3,2) NOT NULL,
            activities TEXT,
            description TEXT
        );
    ";
    private $insert_education = "INSERT INTO `education` (user_id, institude, degree, field, smonth, syear, emonth, eyear, grade, activities, description) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
    private $get_education = "SELECT * FROM `education` WHERE user_id = ?";
    private $get_users = "SELECT user_id FROM `education` WHERE institude = ?";

    public function __construct()
    {
        parent::__construct();
        $this->Init();
    }

    public function Init()
    {
        $this->create($this->create_education_table);
    }

    public function createNewEducation($user_id, $institude, $degree, $field, $smonth, $syear, $emonth, $eyear, $grade, $activities, $description)
    {
        $this->create($this->insert_education, [$user_id, $institude, $degree, $field, $smonth, $syear, $emonth, $eyear, $grade, $activities, $description], "iissssssdss");
    }

    public function getEducation($id)
    {
        return $this->fetch($this->get_education, [$id], "i");
    }

    public function getUsersByInstitude($id)
    {
        return $this->fetch($this->get_users, [$id], "i");
    }
}