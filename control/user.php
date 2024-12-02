<?php
require_once __DIR__ . "/../core/control.php";

class UserController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            $username = $_POST["username"];
            $password = $_POST["password"];
        }
        include_once __DIR__ ."/../view/login.php";
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
        }
        include_once __DIR__ ."/../view/register.php";
    }

    public function logout() {
    
    }

    public function profile() {

    }
}