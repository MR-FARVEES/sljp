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
$router->addRoute("GET", "/"                    , [HomeController::class    , "index"               ]);
$router->addRoute("GET", "/about"               , [HomeController::class    , "about"               ]);
$router->addRoute("GET", "/contact"             , [HomeController::class    , "contact"             ]);
$router->addRoute("GET", "/login"               , [UserController::class    , "login"               ]);
$router->addRoute("GET", "/logout"              , [UserController::class    , "logout"              ]);
$router->addRoute("GET", "/register"            , [UserController::class    , "register"            ]);
$router->addRoute("GET", "/search/result"  , [UserController::class    , "searchResults"       ]);
$router->addRoute("GET", "/user/connection"     , [SeekerController::class  , "connection"          ]);
$router->addRoute("GET", "/seeker"              , [SeekerController::class  , "index"               ]);
$router->addRoute("GET", "/seeker/network"      , [SeekerController::class  , "network"             ]);
$router->addRoute("GET", "/seeker/job"          , [SeekerController::class  , "job"                 ]);
$router->addRoute("GET", "/seeker/chat"         , [SeekerController::class  , "chat"                ]);
$router->addRoute("GET", "/seeker/profile"      , [SeekerController::class  , "seekerProfile"       ]);
$router->addRoute("GET", "/provider"            , [ProviderController::class, "index"               ]);
$router->addRoute("GET", "/provider/network"    , [ProviderController::class, "network"             ]);
$router->addRoute("GET", "/provider/job"        , [ProviderController::class, "job"                 ]);
$router->addRoute("GET", "/provider/chat"       , [ProviderController::class, "chat"                ]);
$router->addRoute("GET", "/provider/profile"    , [ProviderController::class, "providerProfile"     ]);
$router->addRoute("GET", "/admin"               , [AdminController::class   , "dashboard"           ]);

// POST REQUEST METHODS
$router->addRoute("POST", "/login"              , [UserController::class    , "login"               ]);
$router->addRoute("POST", "/register"           , [UserController::class    , "register"            ]);

// DATA FETCH | INSERT | DELETE
$router->addRoute("POST", "/university/add"     , [AdminController::class   , "createUniversity"    ]);
$router->addRoute("POST", "/university/del"     , [AdminController::class   , "removeUniversity"    ]);
$router->addRoute("POST", "/skill/add"          , [AdminController::class   , "createSkill"         ]);
$router->addRoute("POST", "/skill/del"          , [AdminController::class   , "removeSkill"         ]);
$router->addRoute("POST", "/degree/add"         , [AdminController::class   , "createDegree"        ]);
$router->addRoute("POST", "/degree/del"         , [AdminController::class   , "removeDegree"        ]);
$router->addRoute("POST", "/field/add"          , [AdminController::class   , "createField"         ]);
$router->addRoute("POST", "/field/del"          , [AdminController::class   , "removeField"         ]);

$router->addRoute("POST", "/skills"             , [UserController::class    , "skills"              ]);
$router->addRoute("POST", "/universities"       , [UserController::class    , "universities"        ]);
$router->addRoute("POST", "/degrees"            , [UserController::class    , "degrees"             ]);
$router->addRoute("POST", "/fields"             , [UserController::class    , "fields"              ]);
$router->addRoute("POST", "/education/add"      , [UserController::class    , "addEducation"        ]);
$router->addRoute("POST", "/profile/update"     , [UserController::class    , "updateSeeker"        ]);
$router->addRoute("POST", "/search/global"      , [UserController::class    , "findUsers"           ]);
$router->addRoute("POST", "/user/notification"  , [UserController::class    , "notifications"       ]);
$router->addRoute("POST", "/user/follow"        , [UserController::class    , "followUser"          ]);
$router->addRoute("POST", "/user/follow/request", [UserController::class    , "showNotifications"   ]);
$router->addRoute("POST", "/user/follow/add"    , [UserController::class    , "acceptFollow"        ]);

include_once __DIR__ ."/header.php";
$router->resolveRoute($request);
include_once __DIR__ ."/footer.php";