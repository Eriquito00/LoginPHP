<?php
namespace App\Controller;

use App\App\Auth\OAuthGitHubService;

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
        
        //Verificar que esta code y state
        if (!$code || !$state) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing code or state']);
            return;
        }
        
        //Verificar que el state coincide con el CSFR generado anteriormente
        session_start();
        if ($state !== ($_SESSION['oauth_state'] ?? null)) {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid state']);
            return;
        }

        $oauthService = new OAuthGitHubService();
        $tokenRes = $oauthService->changeCodeForToken($code);
        
        if (isset($tokenRes['error'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Failed to exchange code for token']);
            return;
        }

        $accessToken = $tokenRes['access_token'];

        // Obtener datos del usuario de GitHub
        $userData = $oauthService->getUserData($accessToken);

        if (isset($userData['error'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Failed to fetch user data']);
            return;
        }

        /**
         * No se porque trae el EMAIL null asi que no se puede mirar en la DB si existe.
         * Lo que faltaria seria:
         *  - Pillar el email
         *  - Mirar si existe en la DB
         *  - Existe el usuario? 
         *      - Si existe se vincula con OAuth con GitHub
         *      - Si no existe se crea el usuario con OAuth con GitHub
         *  - Se le inicia sesion
         *  - Se comprueba que se pueda iniciar sesion con OAuth y registrarse con OAuth
         *  - Ya estaria
         */
        echo json_encode([
            'status' => 'success',
            'github_user' => $userData
        ]);
    }
}
?>
