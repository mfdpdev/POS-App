<?php namespace Lord\PosApp\Views;

class View
{
  public static function render(string $view, $data)
  {
    require_once __DIR__ . '/header.php';
    require_once __DIR__ . "/" . $view . '.php';
    require_once __DIR__ . '/footer.php';
  }

  public static function redirect(string $url)
  {
    header("Location: $url");
  }
}
