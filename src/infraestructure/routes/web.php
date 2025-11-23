<?php

use App\Infraestructure\Routes\Router;

use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\Controller\ProfileController;
use App\Controller\ProfileSettingsController;
use App\Controller\RecomendationController;
use App\Controller\AdminController;

Router::get("/", [HomeController::class, "index"]);

Router::get("/login", [LoginController::class, "index"]);
Router::post("/login", [LoginController::class, "getData"]);

Router::get("/login/forgot-password-data", [LoginController::class, "forgotPasswordData"]);
Router::post("/login/forgot-password-data", [LoginController::class, "forgotPasswordData"]);

/**
 * Este en verdad no estara aqui, se hara con el token temporal
 * que se le enviara al usuario y durara x tiempo y bla bla bla,
 * pero el procedimiento es el mismo asi que se usa la misma funcion.
 * Tanto el GET como el POST.
 */
Router::get("/login/forgot-password", [ProfileSettingsController::class, "indexForgotPassword"]);
Router::post("/login/forgot-password", [ProfileSettingsController::class, "setNewPassword"]);

Router::get("/register", [RegisterController::class, "index"]);
Router::post("/register", [RegisterController::class, "getData"]);

Router::get("/profile", [ProfileController::class, "index"]);
Router::post("/profile/setup", [ProfileController::class, "userSetup"]);

Router::get("/profile/create", [RecomendationController::class, "indexCreate"]);
Router::get("/profile/update/:id", [RecomendationController::class, "indexUpdate"]);
Router::post("/profile/recomendationdata", [RecomendationController::class, "getData"]);

Router::get("/profile/settings", [ProfileSettingsController::class, "index"]);
Router::post("/profile/settings", [ProfileSettingsController::class, "getData"]);

Router::get("/admin/users", [AdminController::class, "index"]);
Router::post("/admin/users", [AdminController::class, "getData"]);

?>