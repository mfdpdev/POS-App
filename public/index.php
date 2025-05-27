<?php require_once __DIR__ . "./../vendor/autoload.php";

use Lord\PosApp\Routes\Web;
use Lord\PosApp\Controllers\DashboardController;

Web::add("GET", "/", DashboardController::class, "index");

Web::run();
