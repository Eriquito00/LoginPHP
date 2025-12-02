<?php

use App\App\Auth\TokenManager;
use App\App\Auth\AuthService;
use App\Infraestructure\Routes\Router;
use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\Controller\ProfileController;
use App\Controller\ProfileSettingsController;
use App\Controller\RecomendationController;
use App\Controller\AdminController;
use App\Controller\AuthController;
use App\Infraestructure\Database\Connection;
use App\Infraestructure\Middleware\AuthMiddleware;
use App\Infraestructure\Persistence\RefreshTokenRepositoryPDO;
use App\Infraestructure\Persistence\UserRepositoryPDO;

$tokenManager = new TokenManager(
                iss: $_ENV['JWT_ISS'],
                aud: $_ENV['JWT_AUD'],
                encrypAlg: $_ENV['JWT_ALG'],           // "HS256"
                accessTtl: (int) $_ENV['JWT_ACCESS_TTL'],
                refreshTtlDays: (int) $_ENV['REFRESH_TTL_DAYS'],
                persistence: new RefreshTokenRepositoryPDO(Connection::getInstance()),  // tu repo inyectado
                privateKey: null,                // no se usan en HS256
                publicKey: null,
                hsSecret: $_ENV['JWT_SECRET'],
);

$userRepo = new UserRepositoryPDO(Connection::getInstance());

$rtRepo = new RefreshTokenRepositoryPDO(Connection::getInstance());

AuthController::setAuthService(new AuthService($userRepo, $rtRepo, $tokenManager));

Router::setAuthMiddleware(
    new AuthMiddleware($tokenManager, $userRepo,
        [
            // CONFIGURACION DE LAS RUTAS PUBLICAS
            '/login',
            '/auth/login',
            '/auth/refresh',
            '/register',
            '/feed',
            '/profile/setup'
        ]
    )
);

Router::get("/", [HomeController::class, "index"]);

Router::get("/feed", [HomeController::class, "showFeed"]);

Router::get("/login", [LoginController::class, "index"]);
Router::post("/auth/login", [AuthController::class, "getData"]);

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

Router::get("/profile/:username", [ProfileController::class, "index"]);

Router::get("/profile/setup", [ProfileController::class, "indexProfileSetup"]);
Router::post("/profile/setup", [ProfileController::class, "userSetup"]);

Router::get("/profile/create", [RecomendationController::class, "indexCreate"]);
Router::get("/profile/update/:id", [RecomendationController::class, "indexUpdate"]);
Router::post("/profile/recomendationdata", [RecomendationController::class, "getData"]);

Router::get("/profile/settings", [ProfileSettingsController::class, "index"]);
Router::post("/profile/settings", [ProfileSettingsController::class, "getData"]);

Router::get("/admin/users", [AdminController::class, "index"]);
Router::post("/admin/users", [AdminController::class, "getData"]);

?>