<?php
namespace App\Controller;

use App\App\Auth\AuthService;
use App\App\UserService;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use App\Infraestructure\Database\Connection as DatabaseConnection;

class ProfileController {
    public function index(){
        require_once(__DIR__ . "/../view/profile.php");
    }

    public function indexProfileSetup(){
        session_start();
        if (empty($_SESSION['allow_profile_setup'])) {
            header("Location: " . BASE_URL);
            exit;
        }
        unset($_SESSION['allow_profile_setup']);
        require_once(__DIR__ . "/../view/profile_setup.php");
    }

    public function userSetup(){
        session_start();
        $username = $_POST["username"] ?? null;

        $userServ = new UserService(new UserRepositoryPDO(DatabaseConnection::getInstance()), DatabaseConnection::getInstance(), AuthController::getAuthService());
        $userServ->register($username, $_SESSION["registerEmail"], $_SESSION["registerPassword"]);
        
        require_once(__DIR__ . "/../view/profile.php");
    }
}

?>