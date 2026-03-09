<?php
namespace App\Controller;

use App\App\Auth\OAuthGitHubService;
use App\Infraestructure\Persistence\OAuthUserRepositoryPDO;
use App\Infraestructure\Database\Connection;
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

            $oauthService = new OAuthGitHubService();
            $tokenRes = $oauthService->changeCodeForToken($code);

            if (isset($tokenRes['error'])) throw new Exception("Failed to exchange code for token");

            $accessToken = $tokenRes['access_token'];

            // Obtener datos del usuario de GitHub
            $userData = $oauthService->getUserData($accessToken);

            $con = Connection::getInstance();
            $oauthUserRepo = new OAuthUserRepositoryPDO($con);

            $oauthAccount = $oauthUserRepo->findOAuthAccount($userData);

            if ($oauthAccount === null) return; //Llamar al metodo que haga el apartado 3
            else return; //Llamar al metodo que haga todo el 4

            // Hacer el procedimiento necesario para hacer el 5 y ya

            /**
             * Pasos pendientes para completar el flujo OAuth:
             *
             * 1. Recibir el DTO (OAuthUser) desde el servicio de GitHub.
             *    - Pasarlo al repositorio OAuthUserRepository (interfaz).
             *    - Implementarlo en OAuthUserRepositoryPDO para acceso a base de datos.
             *
             * 2. Comprobar si ya existe una cuenta OAuth:
             *    - Buscar en la tabla oauth_accounts por:
             *          provider = "github"
             *          provider_user_id = github_id
             *
             * 3. Si la cuenta OAuth ya existe:
             *    - Obtener el user_id asociado.
             *    - (Opcional) actualizar el access_token si ha cambiado.
             *    - Recuperar el usuario y continuar con el login.
             *
             * 4. Si la cuenta OAuth NO existe:
             *    - Comprobar si existe un usuario con el mismo email en la tabla users.
             *
             *      4.1 Si el usuario existe:
             *          - Obtener su user_id.
             *          - Crear un registro en oauth_accounts con:
             *                user_id
             *                provider ("github")
             *                provider_user_id
             *                access_token
             *          - Esto vincula la cuenta OAuth a la cuenta existente.
             *
             *      4.2 Si el usuario NO existe:
             *          - Crear un nuevo usuario usando los datos obtenidos de GitHub:
             *                username
             *                email
             *          - Generar una contraseña aleatoria (solo para cumplir el esquema).
             *          - Insertar el usuario en la tabla users y obtener el user_id.
             *          - Insertar el registro en oauth_accounts con:
             *                user_id
             *                provider
             *                provider_user_id
             *                access_token
             *
             * 5. Iniciar sesión del usuario en la aplicación:
             *    - Crear la sesión o token interno del sistema.
             *    - El login se ejecuta automáticamente desde backend.
             *
             * 6. Verificar funcionamiento:
             *    - Login con OAuth para usuarios existentes.
             *    - Registro automático con OAuth para usuarios nuevos.
             *    - Vinculación correcta de cuentas existentes por email.
             *
             * 7. Flujo OAuth completado.
             */
            
            echo json_encode([
                'status' => 'success',
                'github_user' => $userData
            ]);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>
