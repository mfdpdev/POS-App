<?php namespace Lord\PosApp\Controllers;

use Lord\PosApp\Views\View;

class DashboardController {
  public function index(){
    View::render('Dashboard/index', [
      "title" => "Dashboard",
      "url" => [
        "logout" => "/auth/logout"
      ]
    ]);
  }

  public function orders(string $productId){
    echo "proudct $productId";
  }
}
