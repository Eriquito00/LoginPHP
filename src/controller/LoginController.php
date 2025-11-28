<?php
namespace App\Controller;

use App\Helpers\Recaptcha;

class LoginController {
    public function index(){
        require_once(__DIR__ . "/../view/login.php");
    }

    public function getData(){
        session_start();
        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;
        $remember = $_POST["remember"] ?? null;

        if (!isset($_SESSION['login_try'])) {
            $_SESSION['login_try'] = 0;
        }

        try {
            if ($_SESSION["login_try"] >= 3){
                $recaptcha = new Recaptcha($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
                if (!$recaptcha->verifyRecaptcha()){
                    $_SESSION["login_try"]++;
                    header("Location: " . BASE_URL . "login");
                    exit;
                }
            }

            //crear la clase donde se haran las comprovaciones y tirara la excepcion
            

            $_SESSION["login_try"] = 0;
            //Una vez hecho el login por defecto se le llevara al home, si no se cambia
            header("Location: " . BASE_URL);
        }
        catch (InputMismatchError $e){
            $_SESSION["login_try"]++;
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }

    public function forgotPasswordData(){
        $email = $_POST["email"] ?? null;
        
        if (!empty($email)){
            echo $email;
        }
        else include_once(__DIR__ . "/../view/login_forgot_password_data.php");
    }
}
?>