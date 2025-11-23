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

    public function indexForgotPassword(){
        require_once(__DIR__ . "/../view/login_forgot_password.php");
    }

    public function setNewPassword(){
        $passwd = $_POST["password"] ?? null;
        $repeatPasswd = $_POST["repeat_password"] ?? null;

        echo $passwd . " " . $repeatPasswd;

        /**
         * Aqui obtendriamos la contraseña y la repetida pero claro
         * el correo tiene que ir en el token temporal que se ha enviado
         * al correo asi que a ese sera el correo al que se le cambie
         * la contraseña, una vez eso se puede:
         * 1. Cerrar la ventana
         * 2. Dejarla invalida con un mensaje de si se ha canviado o no y punto
         * 3. Enviarlo al login
         */
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