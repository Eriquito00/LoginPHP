<?php

namespace App\infraestructure\routes;


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

    public static function dispatch() {
        $base = dirname($_SERVER["SCRIPT_NAME"]); // ES LA RUTA JUSTO A LA CARPETA DEL INDEX PHP
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); // ES LA URL SIN QUERY PARAMS

        $path = str_replace($base, '', $uri);
        $path = trim($path, '/');

        if (isset(self::$routes[$path])) {
            self::$routes[$path]();
        } else {
            http_response_code(404);
            echo "404 Not found";
        }
    }
}

?>