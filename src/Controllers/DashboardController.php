<?php namespace Lord\PosApp\Controllers;

class DashboardController {
  public function index(){
    echo "DashboardController.index()";
  }

  public function orders(string $productId){
    echo "proudct $productId";
  }
}
