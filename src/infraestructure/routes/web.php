<?php

use App\Infraestructure\Routes\Router;

use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\Controller\ProfileController;
use App\Controller\ProfileSettingsController;

Router::get("/", [HomeController::class, "index"]);

Router::get("/login", [LoginController::class, "index"]);
Router::post("/login", [LoginController::class, "getData"]);

Router::get("/register", [RegisterController::class, "index"]);
Router::post("/register", [RegisterController::class, "getData"]);

Router::get("/profile", [ProfileController::class, "index"]);
Router::post("/profile/setup", [ProfileController::class, "userSetup"]);

Router::get("/profile/settings", [ProfileSettingsController::class, "index"]);
Router::post("/profile/settings", [ProfileSettingsController::class, "getData"]);

?>