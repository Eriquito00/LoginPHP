<?php
namespace App\Infraestructure\Persistence;

use App\Model\Repository\OAuthUserRepo;
use App\Infraestructure\Database\Connection;
use App\Model\Entities\OAuthUser;
use App\Model\Entities\User;
use PDO;

class OAuthUserRepositoryPDO implements OAuthUserRepo {
    private Connection $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function findOAuthAccount(OAuthUser $oauthUser): ?object {
        $pdo = $this->con->getConnection();

        $stmt = $pdo->prepare(`
            SELECT * 
                FROM oauth_accounts
            WHERE provider = :provider
            AND provider_user_id = :providerUserId
        `);

        $stmt->bindValue(':provider', $oauthUser->getProvider(), PDO::PARAM_STR);
        $stmt->bindValue(':providerUserId', $oauthUser->getProviderUserId(), PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row ?? null;
    }

    public function createOAuthAccount(User $user, OAuthUser $oauthUser) {
        $pdo = $this->con->getConnection();

        $stmt = $pdo->prepare(`
            INSERT INTO oauth_accounts (user_id, provider, provider_user_id, access_token)
            VALUES (:userId, :provider, :providerUserId, :accessToken)
        `);

        $stmt->bindValue(':userId', $user->getId(), PDO::PARAM_STR);
        $stmt->bindValue(':provider', $oauthUser->getProvider(), PDO::PARAM_STR);
        $stmt->bindValue(':providerUserId', $oauthUser->getProviderUserId(), PDO::PARAM_STR);
        $stmt->bindValue(':accessToken', $oauthUser->getAcccess_Token(), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateOAuthToken(OAuthUser $oauthUser) {
        $pdo = $this->con->getConnection();

        $stmt = $pdo->prepare(`
            UPDATE oauth_accounts
                SET access_token = :access_token
            WHERE provider = :provider
            AND provider_user_id = :providerUserId
        `);

        $stmt->bindValue(':access_token', $oauthUser->getAcccess_Token(), PDO::PARAM_STR);
        $stmt->bindValue(':provider', $oauthUser->getProvider(), PDO::PARAM_STR);
        $stmt->bindValue(':providerUserId', $oauthUser->getProviderUserId(), PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>