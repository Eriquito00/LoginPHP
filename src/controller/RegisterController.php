<?php
namespace App\Controller;

use App\App\UserService;
use App\Controller\Exceptions\InputMismatchError;
use App\Helpers\Recaptcha;
use App\Infraestructure\Database\Connection as DatabaseConnection;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use RuntimeException;
use Throwable;

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
                    http_response_code(403);
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Please complete the reCAPTCHA']);
                    exit;
                }
            }
            
            $userServ = new UserService(new UserRepositoryPDO(DatabaseConnection::getInstance()), DatabaseConnection::getInstance(), AuthController::getAuthService());
            $userServ->verifyRegister($email, $password, $repeat_password);

            $_SESSION["registerEmail"] = $email;
            $_SESSION["registerPassword"] = password_hash($password, PASSWORD_BCRYPT);
            
            $_SESSION["register_try"] = 0;
            $_SESSION["allow_profile_setup"] = true;
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'redirect' => BASE_URL . "profile/setup"
            ]);
        }
        catch (InputMismatchError $e){
            $_SESSION["register_try"]++;
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            exit;
        }
        catch (RuntimeException $e){
            $_SESSION["register_try"]++;
            http_response_code(409);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            exit;
        }
        catch (Throwable $e){
            $_SESSION["register_try"]++;
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'error' => 'An unexpected error occurred'
            ]);
            exit;
        }

    }
}
?>