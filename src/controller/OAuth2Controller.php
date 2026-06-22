<?php
namespace App\Controller;

use App\App\Auth\OAuthGitHubService;
use App\Infraestructure\Persistence\OAuthUserRepositoryPDO;
use App\Infraestructure\Database\Connection;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use App\Model\Entities\OAuthUser;
use App\Model\Entities\User;
use Exception;

class OAuth2Controller {
    public function oauth2GitHub(){
        $oauthService = new OAuthGitHubService();
        $result = $oauthService->generateAuthorizationUrl();
        
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function oauth2GitHubCallback() {
        $code = $_GET['code'] ?? null;
        $state = $_GET['state'] ?? null;
        
        try {
            //Verificar que esta code y state
            if (!$code || !$state) throw new Exception("Missing code or state");

            //Verificar que el state coincide con el CSFR generado anteriormente
            session_start();
            if ($state !== ($_SESSION['oauth_state'] ?? null)) throw new Exception("Invalid state");

            //Obtener el Access Token para poder acceder a la info de Github del usuario
            $oauthService = new OAuthGitHubService();
            $tokenRes = $oauthService->changeCodeForToken($code);

            if (isset($tokenRes['error'])) throw new Exception("Failed to exchange code for token: " . $tokenRes["error"]);

            $accessToken = $tokenRes['access_token'];

            // Obtener datos del usuario de GitHub
            $userData = $oauthService->getUserData($accessToken);

            $con = Connection::getInstance();
            $oauthUserRepo = new OAuthUserRepositoryPDO($con);

            //Mirar si el usuario existe en la tabla de OAuth
            $oauthAccount = $oauthUserRepo->findOAuthAccount($userData);

            if ($oauthAccount === null) {
                $user = $this->createOAuthUserAccount($con, $userData);
            }
            else {
                $oauthUserRepo->updateOAuthToken($userData);
                $userRepo = new UserRepositoryPDO($con);
                $user = $userRepo->getByEmail($userData->getEmail());
            }
            $this->loginOAuth($user->getId());

            require_once(__DIR__ . "/../view/home.php");
            exit;
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    private function loginOAuth(int $userId) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? "0.0.0.0";
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

        $result = AuthController::getAuthService()->loginByUserId($userId, $ip, $ua);

        $cookieOptions = [
            'path' => '/',
            'httponly' => true,
            'secure' => true,
            'samesite' => 'Strict',
            'expires' => $result['refresh_expires']
        ];
        setcookie('refresh_token', $result['refresh_token'], $cookieOptions);
        $_COOKIE['refresh_token'] = $result['refresh_token'];
    }

    private function createOAuthUserAccount(Connection $con, OAuthUser $newOauthUser) {
        // Mirar si existe un usuario con ese correo electronico 
        $userRepo = new UserRepositoryPDO($con);
        $oauthUserRepo = new OAuthUserRepositoryPDO($con);
        $user = $userRepo->getByEmail($newOauthUser->getEmail());

        if ($user === null) {
            $newUser = new User();
            $newUser->init(
                null, 
                $newOauthUser->getUsername(), 
                $newOauthUser->getEmail(), 
                1
            );
            $newUser->setPassword(bin2hex(random_bytes(16)));
            $userId = $userRepo->create($newUser);

            $newUser->setId((int) $userId);
            $newUser->setPassword(bin2hex(random_bytes(16)));

            $oauthUserRepo->createOAuthAccount($newUser, $newOauthUser);
            return $newUser;
        }
        else {
            $oauthUserRepo->createOAuthAccount($user, $newOauthUser);
            return $user;
        }
    }
}
?>
