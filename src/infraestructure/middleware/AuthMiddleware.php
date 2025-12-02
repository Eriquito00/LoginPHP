<?php
namespace App\Infraestructure\Middleware;

use App\App\Auth\AuthContext;
use App\App\Auth\TokenManager;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use Throwable;

class AuthMiddleware
{
    public function __construct(
        private TokenManager $tokens,
        private UserRepositoryPDO $users,
        private array $publicPaths = [], // ejemplo: '/auth/login', '/auth/refresh'
    ) {}

    public function handle(string $path) {
        $normalizedPath = '/' . $path;

        if ($this->isPublic($normalizedPath)) {
            return;
        }

        $authHeader = $_SERVER["HTTP_AUTHORIZATION"] ?? null;
        if (!$authHeader || !preg_match('/^Bearer\s+(.+)$/i', $authHeader, $m)) {
            $this->unauthorized('No access token given for ' . $path . ' token: ' . $authHeader);
        }

        if (isset($m)) {
            $jwt = trim($m[1]);

            try {
                $payload = $this->tokens->verifyAccessToken($jwt);
            } catch (Throwable $e) {
                $this->unauthorized('Token invalido');
            }
        }
        
        $userId = (int)($payload->sub ?? 0);
        if ($userId <= 0) {
            $this->unauthorized('Token without valid sub');
        }

        $user = $this->users->get($userId);
        if(!$user || !$user->isActive()) {
            $this->unauthorized('User not available');
        }

        AuthContext::setUser($user);
    }

    private function isPublic(string $path): bool {
        if ($path == '/') return true;
        foreach ($this->publicPaths as $prefix) {
            if (str_starts_with($path, $prefix)) {
                return true;
            }
        }
        return false;
    }

    private function unauthorized(string $msg): void {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(['error' => $msg]);
        exit;
    }
}
?>