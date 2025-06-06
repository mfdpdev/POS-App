<?php require_once __DIR__ . "./../vendor/autoload.php";

use Lord\PosApp\Routes\Web;
use Lord\PosApp\Controllers\{DashboardController, AuthController};

Web::add("GET", "/", DashboardController::class, "index");
Web::add("GET", "/orders/([0-9a-zA-Z]*)", DashboardController::class, "orders");

Web::add("GET", "/signin", AuthController::class, "showSigninPage");
Web::add("POST", "/signin", AuthController::class, "signin");
Web::add("GET", "/signup", AuthController::class, "showSignupPage");
Web::add("POST", "/signup", AuthController::class, "signup");
Web::add("POST", "/logout", AuthController::class, "logout");

Web::run();
