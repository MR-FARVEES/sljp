<?php

require_once __DIR__ ."/core/request.php";
require_once __DIR__ ."/core/router.php";
require_once __DIR__ ."/core/control.php";
require_once __DIR__ ."/control/home.php";
require_once __DIR__ ."/control/user.php";
require_once __DIR__ ."/control/seeker.php";
require_once __DIR__ ."/control/provider.php";
require_once __DIR__ ."/control/admin.php";

$request = new Request();
$router = new Router();

// GET REQUEST METHODS
$router->addRoute("GET", "/"                , [HomeController::class    , "index"           ]);
$router->addRoute("GET", "/about"           , [HomeController::class    , "about"           ]);
$router->addRoute("GET", "/contact"         , [HomeController::class    , "contact"         ]);
$router->addRoute("GET", "/login"           , [UserController::class    , "login"           ]);
$router->addRoute("GET", "/logout"          , [UserController::class    , "logout"          ]);
$router->addRoute("GET", "/register"        , [UserController::class    , "register"        ]);
$router->addRoute("GET", "/seeker"          , [SeekerController::class  , "index"           ]);
$router->addRoute("GET", "/seeker/network"  , [SeekerController::class  , "network"         ]);
$router->addRoute("GET", "/seeker/job"      , [SeekerController::class  , "job"             ]);
$router->addRoute("GET", "/seeker/chat"     , [SeekerController::class  , "chat"            ]);
$router->addRoute("GET", "/seeker/profile"  , [SeekerController::class  , "seekerProfile"   ]);
$router->addRoute("GET", "/provider"        , [ProviderController::class, "index"           ]);
$router->addRoute("GET", "/provider/network", [ProviderController::class, "network"         ]);
$router->addRoute("GET", "/provider/job"    , [ProviderController::class, "job"             ]);
$router->addRoute("GET", "/provider/chat"   , [ProviderController::class, "chat"            ]);
$router->addRoute("GET", "/provider/profile", [ProviderController::class, "providerProfile" ]);
$router->addRoute("GET", "/admin"           , [AdminController::class   , "index"           ]);

// POST REQUEST METHODS
$router->addRoute("POST", "/login"          , [UserController::class    , "login"            ]);
$router->addRoute("POST", "/register"       , [UserController::class    , "register"         ]);

// DATA FETCH VIA POST
$router->addRoute("POST", "/skills"         , [UserController::class    , "skills"          ]);

include_once __DIR__ ."/header.php";
$router->resolveRoute($request);
include_once __DIR__ ."/footer.php";