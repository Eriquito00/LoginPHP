<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;
use App\Infraestructure\Routes\Router;


$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

Router::dispatch();
?>