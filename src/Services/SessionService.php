<?php namespace Lord\PosApp\Services;

use Lord\PosApp\Config\Database;

class SessionService implements \SessionHandlerInterface {
  
  private ?\PDO $connection = null;

  public function __construct(){
    $this->connection = Database::getConnection();
  }

  public function open($savePath, $sessionName): bool
  {
    return true;
  }

  public function close(): bool {
    return true;
  }

  public function read($id): string {
    $statement = $this->connection->prepare("select data from sessions where id = :id limit 1");
    $statement->execute(["id" => $id]);
    $row = $statement->fetch(\PDO::FETCH_ASSOC);
    return $row ? $row["data"] : '';
  }

  public function write($id, $data): bool {
    $statement = $this->connection->prepare("insert into sessions (id, data, created_at, updated_at) values (:id, :data, current_timestamp, current_timestamp) on conflict (id) do update set data = excluded.data, updated_at = current_timestamp");
    return $statement->execute([
      "id" => $id,
      "data" => $data
    ]);
  }

  public function destroy($id): bool
  {
      $statement = $this->connection->prepare("DELETE FROM sessions WHERE id = :id");
      return $statement->execute(['id' => $id]);
  }

  public function gc($max_lifetime): bool
  {
    $statement = $this->connection->prepare("DELETE FROM sessions WHERE updated_at < NOW() - INTERVAL '{$max_lifetime} seconds'");
    return $statement->execute();
  }

  public static function get(string $key)
  {
      return $_SESSION[$key] ?? null;
  }

  public static function set(string $key, $value)
  {
      $_SESSION[$key] = $value;
  }

  public static function forget(string $key)
  {
      unset($_SESSION[$key]);
  }
}
