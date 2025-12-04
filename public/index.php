<?php

use App\Infraestructure\Database\Connection;
use App\Infraestructure\Exceptions\DBErrorException;
use Dotenv\Dotenv;
use App\Infraestructure\Routes\Router;

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
$dir = str_replace('\\', '/', __DIR__);

$basePath = str_replace($documentRoot, '', $dir);
$host = $_SERVER["HTTP_HOST"];
define('BASE_URL', "http://$host$basePath/");
define('BASE_PATH', dirname(BASE_URL));

try {
    $connection = new Connection();
    require_once __DIR__ . "/../src/infraestructure/routes/web.php";
    Router::dispatch($_SERVER["REQUEST_METHOD"]);
} catch(DBErrorException $e) {
    http_response_code(500);
    echo(500 . " Internal server error: " . $e->getMessage());
}
?>