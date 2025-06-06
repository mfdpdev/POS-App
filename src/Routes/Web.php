<?php namespace Lord\PosApp\Routes;

class Web {
  private static array $routes = [];

    /**
   * Menambahkan route baru.
   * 
   * @param string $method HTTP Method (GET, POST, etc)
   * @param string $path URL path yang digunakan
   * @param string $controller Nama controller yang menangani route
   * @param string $function Nama method dalam controller yang menangani route
   */
  public static function add(string $method, string $path, string $controller, string $function): void {
    self::$routes[] = [
      'method' => $method,
      'path' => $path,
      'controller' => $controller,
      'function' => $function,
    ];
  }

  public static function run(): void {
    $path = $_SERVER["PATH_INFO"] ?? "/";
    $method = $_SERVER["REQUEST_METHOD"];

    foreach(self::$routes as $route){
      $pattern = '#^' . $route["path"] . '$#';
      // if($path == $route["path"] && $method == $route["method"]){
      if(preg_match($pattern, $path, $variables) && $method == $route["method"]){
        $controller = new $route["controller"];
        $function = $route["function"];
        // $controller->$function();
        
        array_shift($variables);
        call_user_func_array([$controller, $function], $variables);
        return;
      }
    }

    http_response_code(404);
    echo "CONTROLLER NOT FOUND";
  }
}
