<?php require_once __DIR__ . "./../vendor/autoload.php";

use Lord\PosApp\Routes\Web as Route;
use Lord\PosApp\Controllers\{DashboardController, AuthController};
use Lord\PosApp\Services\SessionService;
use Lord\PosApp\Middlewares\{MustLoginMiddleware, MustNotLoginMiddleware};

session_set_save_handler(new SessionService(), true);
session_start();

Route::add("GET", "/", DashboardController::class, "index", [MustLoginMiddleware::class]);
// Route::add("GET", "/orders/([0-9a-zA-Z]*)", DashboardController::class, "orders");

Route::add("GET", "/auth/signin", AuthController::class, "showSigninPage", [MustNotLoginMiddleware::class]);
Route::add("POST", "/auth/signin", AuthController::class, "signin", [MustNotLoginMiddleware::class]);
Route::add("GET", "/auth/signup", AuthController::class, "showSignupPage", [MustNotLoginMiddleware::class]);
Route::add("POST", "/auth/signup", AuthController::class, "signup", [MustNotLoginMiddleware::class]);
Route::add("POST", "/auth/logout", AuthController::class, "logout", [MustLoginMiddleware::class]);

Route::run();
