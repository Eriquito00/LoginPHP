<?php
namespace App\Controller;

class RegisterController {
    public function index(){
        require_once(__DIR__ . "/../view/register.php");
    }

    public function getData(){
        $username = $_POST["username"] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $repeat_password = $_POST['repeat_password'] ?? null;

        require_once(__DIR__ . "/../view/profile_setup.php");
    }
}
?>