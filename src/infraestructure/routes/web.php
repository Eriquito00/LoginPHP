<?php

use App\Infraestructure\Routes\Router;

use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\RegisterController;

Router::get("/", [HomeController::class, "index"]);

Router::get("/login", [LoginController::class, "index"]);

Router::get("/register", [RegisterController::class, "index"]);

?>