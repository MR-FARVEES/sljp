<?php

class ErrorHandler {
    private $pages = [
        404 => __DIR__ . "/../view/error/404.php",
        500 => __DIR__ . "/../view/error/500.php",
    ];

    public function handle($code) {
        if (array_key_exists($code, $this->pages)) {
            include_once $this->pages[$code];
            exit;
        } else {
            include_once $this->pages[500];
        }
    }
}