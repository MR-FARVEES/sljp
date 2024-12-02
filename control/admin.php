<?php
require_once __DIR__ ."/user.php";
class AdminController extends UserController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    }
}