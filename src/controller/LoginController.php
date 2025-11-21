<?php
namespace App\Controller;

class LoginController {
    public function index(){
        require_once(__DIR__ . "/../view/login.php");
    }

    public function getData(){
        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;

        echo $email . " " . $password;
    }
}
?>