<?php namespace Lord\PosApp\Middlewares;

use Lord\PosApp\Services\SessionService;
use Lord\PosApp\Views\View;

class MustLoginMiddleware implements Middleware {
  
  public function __construct(){}

  public function before(): void {
    $email = SessionService::get("user_email");
    if($email == null){
      View::redirect("/auth/signin");
    }
  }
}
