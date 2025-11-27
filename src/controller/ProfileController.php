<?php
namespace App\Controller;

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
        $username = $_POST["username"] ?? null;
        echo $username;
        
        require_once(__DIR__ . "/../view/profile.php");
    }
}

?>