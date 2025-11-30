<?php

use App\Infraestructure\Database\Connection;

$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
$dir = str_replace('\\', '/', __DIR__);

$basePath = str_replace($documentRoot, '', $dir);
$host = $_SERVER["HTTP_HOST"];
define('BASE_URL', "http://$host$basePath/");

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../src/infraestructure/routes/web.php";

use Dotenv\Dotenv;
use App\Infraestructure\Routes\Router;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$connection = new Connection();

Router::dispatch($_SERVER["REQUEST_METHOD"]);
?>