<?php
namespace App\App\Auth;

use App\App\Auth\TokenManager;
use App\App\Exceptions\RefreshTokenInvalidException;
use App\App\Exceptions\UserNotAvailableException;
use App\App\Exceptions\WrongCredentialsException;
use App\Infraestructure\Persistence\RefreshTokenRepositoryPDO;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use App\Model\Entities\PublicUser;

class AuthService {
    public ?PublicUser $cachedUser = null;
    private ?string $cachedTokenHash = null;

    public function __construct(
        private UserRepositoryPDO $users,
        private RefreshTokenRepositoryPDO $refreshTokens,
        private TokenManager $tokens
    ) {}

    public function login(string $identity, string $plain, string $ip, string $ua): array {
        $user = $this->users->getByIdentity($identity);
        
        if(!$user || !$user->verifyPassword($plain)) {
            throw new WrongCredentialsException("Credenciales invalidas");
        }

        if (!$user->isActive()) {
            throw new \RuntimeException('Cuenta desactivada');
        }

        // TODO: Implementar el update del last login

        // emitimos tokens
        $access = $this->tokens->issueAccessToken($user);

        $refresh = $this->tokens->issueRefreshToken($user, $ip, $ua);

        return [
            "user_id" => $user->getId(),
            "access_token" => $access->jwt,
            "access_expires" => $access->exp,
            "refresh_token" => $refresh->token,
            "refresh_expires" => $refresh->exp
        ];
    }

    public function loginByUserId(int $userId, string $ip, string $ua): array {
        $user = $this->users->get($userId);
        if (!$user || !$user->isActive()) {
            throw new UserNotAvailableException("User not available");
        }

        $access = $this->tokens->issueAccessToken($user);
        $refresh = $this->tokens->issueRefreshToken($user, $ip, $ua);

        return [
            'user_id' => $user->getId(),
            'access_token' => $access->jwt,
            'access_expires' => $access->exp,
            'refresh_token' => $refresh->token,
            'refresh_expires' => $refresh->exp
        ];
    }


    public function isAuthenticated() : bool {
        $refreshToken = $_COOKIE["refresh_token"] ?? null;

        if(!$refreshToken) {
            return false;
        }

        $record = $this->refreshTokens->findActiveByToken($refreshToken);
        
        return $record !== null;
    }

    public function getCurrentUser(): ?PublicUser {
        $refreshToken = $_COOKIE['refresh_token'] ?? null;
        
        if (!$refreshToken) {
            return $this->clearCache();
        }

        $currentHash = hash('sha256', $refreshToken);

        if ($this->cachedTokenHash != $currentHash) {
            $this->clearCache();
        }

        if ($this->cachedUser != null) {
            return $this->cachedUser;
        }

        $record = $this->refreshTokens->findActiveByToken($refreshToken);
        
        if (!$record) {
            return null;
        }

        $privateUser = $this->users->get((int)$record->user_id);
        
        if (!$privateUser || !$privateUser->isActive()) {
            return null;
        }

        $parsedUser = new PublicUser(
            $privateUser->getId(),
            $privateUser->getUsername(),
            $privateUser->getEmail(),
            $privateUser->getRole()
        );

        $this->cacheUser($parsedUser, $currentHash);

        return $parsedUser;
    }

    public function refresh(string $refreshToken, string $ip, string $ua): array {
        $record = $this->refreshTokens->findActiveByToken($refreshToken);

        if (!$record) {
            throw new RefreshTokenInvalidException('Refresh token inválido o expirado');
        }

        $user = $this->users->get((int)$record->user_id);
        if (!$user || !$user->isActive()) {
            throw new UserNotAvailableException("User not available");
        }

        $newRefresh = $this->tokens->rotateRefreshToken($record, $user, $ip, $ua);
        $newAccess = $this->tokens->issueAccessToken($user);
        
        return [
            'user_id'         => $user->getId(),
            'access_token'    => $newAccess->jwt,
            'access_expires'  => $newAccess->exp,
            'refresh_token'   => $newRefresh->token,
            'refresh_expires' => $newRefresh->exp,
        ];
    }

    private function cacheUser(PublicUser $u, string $tokenHash) {
        $this->cachedUser = $u;
        $this->cachedTokenHash = $tokenHash;
    }

    public function clearCache() : null {
        $this->cachedUser = null;
        $this->cachedTokenHash = null;
        return null;
    }  

    public function logout(?string $refreshToken): void
    {
        if ($refreshToken === null || $refreshToken === '') {
            return;
        }

        $record = $this->refreshTokens->findActiveByToken($refreshToken);

        if ($record) {
            $this->refreshTokens->revoke((int)$record->id);
        }
    }

    public function logoutAll(int $userId): void
    {
        $this->refreshTokens->revokeAllForUser($userId);
    }
}

?>