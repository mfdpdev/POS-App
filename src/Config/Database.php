<?php namespace Lord\PosApp\Config;

class Database
{
  private static ?\PDO $pdo = null;

  public static function getConnection(): \PDO
  {
    if(self::$pdo == null){
      EnvConfig::load();

      try {
        $url = "pgsql:host=" . EnvConfig::get("DB_HOST") . ";port=" . EnvConfig::get("DB_PORT") . ";dbname=" . EnvConfig::get("DB_NAME");
        self::$pdo = new \PDO(
          $url,
          EnvConfig::get("DB_USER"),
          EnvConfig::get("DB_PASS"),
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
