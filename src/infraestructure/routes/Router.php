<?php

namespace App\Infraestructure\Routes;


class Router {
    private static $routes = [];

    public static function get($uri, $callback) {
        $uri = trim($uri, '/');
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post($uri, $callback) {
        $uri = trim($uri, '/');
        self::$routes['POST'][$uri] = $callback;
    }

    public static function dispatch($method) {
        $base = dirname($_SERVER["SCRIPT_NAME"]); // ES LA RUTA JUSTO A LA CARPETA DEL INDEX PHP
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); // ES LA URL SIN QUERY PARAMS

        $path = str_replace($base, '', $uri);
        $path = trim($path, '/');

        $found = false;

        foreach(self::$routes[$method] as $route => $callback){

            if (strpos($route, ":") !== false){
                $pattern = preg_replace("#:[a-z0-9]+#", "([^/]+)", $route);
            }
            else $pattern = $route;
            
            if (preg_match("#^$pattern$#", $path, $matches)){
                $found = true;
                $params = array_slice($matches, 1);
                
                //con funcion anonima
                if (is_callable($callback)){
                    $response = $callback(...$params);
                    echo $response;
                }

                if (is_array($callback)){
                    $controller = new $callback[0];
                    $response = $controller->{$callback[1]}(...$params);
                }

                break;
            }
        }

        if (!$found) echo "404 Not found";
    }
}

?>