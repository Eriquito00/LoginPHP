<?php
namespace App\Controller;

class ProfileSettingsController {
    public function index(){
        require_once(__DIR__ . "/../view/profile_settings.php");
    }

    public function getData(){
        $type = $_POST["action"];
        switch ($type){
            case "changePhoto":
                echo "Este aun no estara implementado porque hay que traerse la foto etc y hay que mirar como hacerlo.";
                break;
            case "changeUsername":
                $this->getUsername();
                break;
            case "verifyEmail":
                $this->verifyEmail();
                break;
            case "changeEmail":
                $this->getNewEmail();
                break;
            case "changePassword":
                $this->getNewPassword();
                break;                                
        }
    }

    private function getUsername(){
        $username = $_POST["username"] ?? null;
        echo $username;
    }

    private function verifyEmail(){
        $email = $_POST["email"] ?? null;
        echo $email;
    }

    private function getNewEmail(){
        $email = $_POST["email"] ?? null;
        $newEmail = $_POST["newEmail"] ?? null;
        echo $email . " " . $newEmail;
    }

    private function getNewPassword(){
        $password = $_POST["password"] ?? null;
        $newPassword = $_POST["newPassword"] ?? null;
        echo $password . " " . $newPassword;
    }
}
?>