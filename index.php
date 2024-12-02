<?php

require_once __DIR__ ."/core/request.php";
require_once __DIR__ ."/core/router.php";
require_once __DIR__ ."/core/control.php";
require_once __DIR__ ."/control/home.php";
require_once __DIR__ ."/control/user.php";

$request = new Request();
$router = new Router();

// GET REQUEST METHODS
$router->addRoute("GET", "/"         , [HomeController::class,"index"    ]);
$router->addRoute("GET", "/about"    , [HomeController::class,"about"    ]);
$router->addRoute("GET", "/contact"  , [HomeController::class,"contact"  ]);
$router->addRoute("GET", "/login"    , [UserController::class, "login"   ]);
$router->addRoute("GET", "/register" , [UserController::class, "register"]);


// POST REQUEST METHODS
$router->addRoute("POST", "/login"    , [UserController::class, "login"   ]);
$router->addRoute("POST", "/register" , [UserController::class, "register"]);

include_once __DIR__ ."/header.php";
$router->resolveRoute($request);
include_once __DIR__ ."/footer.php";