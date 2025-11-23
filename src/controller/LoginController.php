<?php
namespace App\Controller;

use App\Helpers\Recaptcha;

class LoginController {
    public function index(){
        require_once(__DIR__ . "/../view/login.php");
    }

    public function getData(){
        $recaptcha = new Recaptcha($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
        if (!$recaptcha->verifyRecaptcha()) return $this->index();
        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;
        $remember = $_POST["remember"] ?? null;

        echo $email . " " . $password . " " . $remember;
    }

    public function forgotPasswordData(){
        $email = $_POST["email"] ?? null;
        
        if (!empty($email)){
            $this->index();
        }
        else include_once(__DIR__ . "/../view/login_forgot_password_data.php");
    }
}
?>