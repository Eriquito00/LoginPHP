<?php
namespace App\Controller;

use App\Auth\AuthService;
use App\Helpers\Recaptcha;
use Throwable;

class AuthController {
    public function __construct(
        private AuthService $authService
    ) {}
    
    public function login(string $plain, string $identity, string $remember) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? "0.0.0.0";
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

        $result = $this->authService->login($identity, $plain, $ip, $ua);
        if ($remember) {
            setcookie('refresh_token', $result['refresh_token'], [
                'expires' => $result['refresh_expires'],
                'path' => '/auth',
                'httponly' => true,
                'secrue' => true,
                'samesite' => 'Lax'
            ]);
        } else {
            setcookie('refresh_token', $result['refresh_token'], [
                'path' => '/auth',
                'httponly' => true,
                'secrue' => true,
                'samesite' => 'Lax'
            ]);
        }

        header('Content-Type: application/json');
        echo json_encode([
            'access_token' => $result['access_token'],
            'expires_in' => $result['access_expires'] - time(),
            'user_id' => $result['user_id']
        ]);
    }

    public function getData(){
        session_start();
        $identity = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;
        $remember = $_POST["remember"] ?? false;

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

            $_SESSION["login_try"] = 0;
            $this->login($password, $identity, $remember);
        }
        catch (Throwable $e){
            $_SESSION["login_try"]++;
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }
}
?>