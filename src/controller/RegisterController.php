<?php
namespace App\Controller;

use App\App\UserService;
use App\Controller\Exceptions\InputMismatchError;
use App\Helpers\Recaptcha;
use App\Infraestructure\Database\Connection as DatabaseConnection;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use Dba\Connection;

class RegisterController {

    public function index(){
        require_once(__DIR__ . "/../view/register.php");
    }

    public function getData(){
        session_start();
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $repeat_password = $_POST['repeat_password'] ?? null;

        if (!isset($_SESSION['register_try'])) {
            $_SESSION['register_try'] = 0;
        }

        try {
            if ($_SESSION["register_try"] >= 3){
                $recaptcha = new Recaptcha($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
                if (!$recaptcha->verifyRecaptcha()){
                    $_SESSION["register_try"]++;
                    header("Location: " . BASE_URL . "register");
                    exit;
                }
            }

            $userServ = new UserService();
            $userServ->register($email, $password, $repeat_password);
            
            $_SESSION["register_try"] = 0;
            $_SESSION["allow_profile_setup"] = true;
            header("Location: " . BASE_URL . "profile/setup");
        }
        catch (InputMismatchError $e){
            $_SESSION["register_try"]++;
            header("Location: " . BASE_URL . "register");
            exit;
        }

    }
}
?>