<?php namespace Lord\PosApp\Config;

class Database
{
  private static ?\PDO $pdo = null;

  public static function getConnection(string $env = "dev"): \PDO
  {
    if(self::$pdo == null){
      require_once __DIR__ . "/../../config/database.php";

      $config = getDatabaseConfig();
      try {
        self::$pdo = new \PDO(
          $config['database'][$env]['url'],
          $config['database'][$env]['username'],
          $config['database'][$env]['password']
        );
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      } catch (\PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
      }
    }

    return self::$pdo;
  }

  public static function beginTransaction(){
    self::$pdo->beginTransaction();
  }

  public static function commitTransaction(){
    self::$pdo->commit();
  }

  public static function rollbackTransaction(){
    self::$pdo->rollback();
  }
}
