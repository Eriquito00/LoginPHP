<?php
namespace App\Controller;

class LoginController {
    public function index(){
        require_once(__DIR__ . "/../view/login.php");
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