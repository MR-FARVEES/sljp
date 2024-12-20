<?php
require_once __DIR__ . "/user.php";

class ProviderController extends UserController
{

    public function __construct()
    {
        parent::__construct();
        $this->initNav();
    }

    public function index()
    {
        include_once __DIR__ . "/../view/provider/index.php";
    }

    public function network()
    {
        include_once __DIR__ . "/../view/provider/network.php";
    }

    public function job()
    {
        include_once __DIR__ . "/../view/provider/job.php";
    }

    public function providerProfile()
    {
        $this->profile();
    }
}