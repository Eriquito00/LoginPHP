<?php

use App\Infraestructure\Routes\Router;

use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\Controller\ProfileController;

Router::get("/homepage", [HomeController::class, "index"]);

Router::get("/login", [LoginController::class, "index"]);
Router::post("/login", [LoginController::class, "getData"]);

Router::get("/register", [RegisterController::class, "index"]);
Router::post("/register", [RegisterController::class, "getData"]);

Router::get("/profile", [ProfileController::class, "index"]);

?>