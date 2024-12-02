<?php
require_once __DIR__ ."/../core/control.php";

class HomeController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->initNav();
    }

    public function index() {
        include_once __DIR__ . "/../view/home/index.php";
    }

    public function about() {
        $name = "Ijaz";
        include_once __DIR__ ."/../view/home/about.php";
    }

    public function contact() {
        echo "This contact";
    }
}