<?php namespace Lord\PosApp\Config;

use Dotenv\Dotenv;

class EnvConfig {

  public static function load(): void {
    $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
    $dotenv->load();
  }

  public static function get(string $key, mixed $default = null): mixed {
    return $_ENV[$key] ?? $default;
  }
}
