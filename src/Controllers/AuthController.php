<?php namespace Lord\PosApp\Controllers;

use Lord\PosApp\Views\View;
use Lord\PosApp\Models\{UserSigninRequest, UserSignupRequest};
use Lord\PosApp\Config\Database;
use Lord\PosApp\Services\{AuthService};
use Lord\PosApp\Repositories\{AuthRepository};

class AuthController {

  private AuthService $authService;

  public function __construct(){
    $connection = Database::getConnection();

    $authRepository = new AuthRepository($connection);
    $this->authService = new AuthService($authRepository);
  }

  public function showSigninPage()
  {
    View::render('Auth/signin', [
      "title" => "SignIn",
      "action" => "/auth/signin"
    ]);
  }

  public function signin()
  {
    $request = new UserSigninRequest();
    $request->email = $_POST["email"];
    $request->password = $_POST["password"];

    try {
      $this->authService->signin($request);
      View::redirect('/');
    } catch (\Exception $err) {
      View::render('Auth/signin', [
        "title" => "Signin",
        "action" => "/auth/signin",
        "error" => $err->getMessage(),
      ]);
    }
  }

  public function showSignupPage()
  {
    View::render('Auth/signup', [
      "title" => "SignUp",
      "action" => "/auth/signup"
    ]);
  }

  public function signup(){
    $request = new UserSignupRequest();
    $request->name = $_POST["name"];
    $request->email = $_POST["email"];
    $request->password = $_POST["password"];

    try {
      $this->authService->signup($request);
      View::redirect('/auth/signin');
    }catch(\Exception $err){
      View::render('Auth/signup', [
        "title" => "SignUp",
        "action" => "/auth/signup",
        "error" => $err->getMessage()
      ]);
    }
  }
}
