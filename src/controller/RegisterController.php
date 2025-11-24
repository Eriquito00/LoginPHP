<?php
namespace App\Controller;

use App\Helpers\Recaptcha;

class RegisterController {
    public function index(){
        require_once(__DIR__ . "/../view/register.php");
    }

    public function getData(){
        $recaptcha = new Recaptcha($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
        if (!$recaptcha->verifyRecaptcha()) return $this->index();
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $repeat_password = $_POST['repeat_password'] ?? null;

        require_once(__DIR__ . "/../view/profile_setup.php");
    }
}
?>