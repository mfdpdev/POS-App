<?php namespace Lord\PosApp\Repositories;

use Lord\PosApp\Domains\User;

class AuthRepository {
  
  private \PDO $connection;

  public function __construct(\PDO $connection){
    $this->connection = $connection;
  }

  public function save(User $user): User {
    $statement = $this->connection->prepare("INSERT INTO users(name, email, password, role, created_at, updated_at) values (?, ?, ?, ?, ?, ?)");
    $statement->execute([
      $user->name,
      $user->email,
      $user->password,
      $user->role,
      $user->created_at->format('Y-m-d H:i:s'),
      $user->updated_at->format('Y-m-d H:i:s'),
    ]);

    return $user;
  }

  public function findByEmail(string $email): ?User {
    $statement = $this->connection->prepare("select * from users where email = ?");
    $statement->execute([$email]);

    try {
      if($row = $statement->fetch()){
        $user = new User();
        $user->name = $row["name"];
        $user->email = $row["email"];
        $user->password = $row["password"];
        $user->role = $row["role"];
        $user->created_at = new \DateTime($row["created_at"]);
        $user->updated_at = new \DateTime($row["updated_at"]);
        return $user;
      }else{
        return null;
      }
    } finally {
      $statement->closeCursor();
    }
  }

  public function findById(string $id): ?User {
    $statement = $this->connection->prepare("select * from users where id = ?");
    $statement->execute([$id]);

    try {
      if($row = $statement->fetch()){
        $user = new User();
        $user->name = $row["name"];
        $user->email = $row["email"];
        $user->password = $row["password"];
        $user->role = $row["role"];
        $user->created_at = new \DateTime($row["created_at"]);
        $user->updated_at = new \DateTime($row["updated_at"]);
        return $user;
      }else{
        return null;
      }
    } finally {
      $statement->closeCursor();
    }
  }
}
