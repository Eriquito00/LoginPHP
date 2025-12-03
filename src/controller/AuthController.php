<?php
namespace App\Controller;

use App\App\Auth\AuthService;
use App\Helpers\Recaptcha;
use Throwable;

class AuthController {
    private static ?AuthService $authService = null;

    public static function setAuthService(AuthService $instance): AuthService {
        if (self::$authService === null) {
            self::$authService = $instance;
        }
        return self::$authService;
    }

    public static function getAuthService(): ?AuthService {
        return self::$authService;
    }

    public function __construct() {}
    
    public function login(string $identity, string $plain, string $remember) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? "0.0.0.0";
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

        $result = self::$authService->login($identity, $plain, $ip, $ua);

        $cookieOptions = [
            'path' => '/',
            'httponly' => true,
            'secure' => true, // Solo HTTPS
            'samesite' => 'Strict'
        ];

        if ($remember) {
            $cookieOptions['expires'] = $result['refresh_expires'];

        }

        setcookie('refresh_token', $result['refresh_token'], $cookieOptions);

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
            $this->login($identity, $password, $remember);
        }
        catch (Throwable $e){
            $_SESSION["login_try"]++;
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }
}
?>