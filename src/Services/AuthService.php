<?php namespace Lord\PosApp\Services;

use Lord\PosApp\Repositories\AuthRepository;
use Lord\PosApp\Models\{UserSigninRequest, UserSignupRequest};
use Lord\PosApp\Config\Database;
use Lord\PosApp\Domains\User;

class AuthService {

  private AuthRepository $authRepository;

  public function __construct(AuthRepository $authRepository) {
    $this->authRepository = $authRepository;
  }

  public function signin(UserSigninRequest $request): User {

    $this->validateUserSigninRequest($request);

    $user = $this->authRepository->findByEmail($request->email);
    if($user == null){
      throw new \Exception("Email or Password is wrong!");
    }

    if(password_verify($request->password, $user->password)){
      return $user;
    }else{
      throw new \Exception("Email or Password is wrong!");
    }
  }

  public function validateUserSigninRequest(UserSigninRequest $request){
    if ($request->email == null || $request->password == null ||
      trim($request->email) == "" || trim($request->password) == "") {
      throw new \Exception("Email, and Password can not blank");
    }
  }

  public function signup(UserSignupRequest $request){
    $this->validateUserSignupRequest($request);

    try {
      Database::beginTransaction();
      if($this->authRepository->findByEmail($request->email)){
        throw new \Exception("Email already exists!");
      }

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = password_hash($request->password, PASSWORD_BCRYPT);

      $user->role = "admin";
      $now = new \DateTime();
      $user->created_at = $now;
      $user->updated_at = $now;

      $this->authRepository->save($user);

      Database::commitTransaction();
      return true;
    }catch(\Exception $err){
      Database::rollbackTransaction();
      throw $exception;
    }
  }

  public function validateUserSignupRequest(UserSignupRequest $request){
    if ($request->name == null || $request->email == null || $request->password == null ||
      trim($request->name) == "" || trim($request->email) == "" || trim($request->password) == "") {
      throw new \Exception("Name, Email, and Password can not blank");
    }
  }
}
