<?php
namespace App\Infraestructure\Persistence;

use App\Infraestructure\Database\Connection;
use App\Model\Repository\RefreshTokenRepo;
use PDO;

class RefreshTokenRepositoryPDO implements RefreshTokenRepo{
    private Connection $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function store(array $data) : int
    {
        $pdo = $this->con->getConnection();
        $stmt = $pdo->prepare('
            INSERT INTO refresh_tokens (user_id, token_hash, expires_at, ip, user_agent)
                VALUES(:user_id, :token_hash, :expires_at, :ip, :ua);
        ');
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':token_hash', $data['token_hash'], PDO::PARAM_STR);
        $stmt->bindValue(':expires_at', $data['expires_at'], PDO::PARAM_STR);
        $stmt->bindValue(':ip', $data['ip'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':user_agent', $data['user_agent'] ?? null, PDO::PARAM_STR);
        $stmt->execute();

        return (int)$pdo->lastInsertId();
    }

    public function findActiveByToken(string $token): ?object
    {   
        $pdo = $this->con->getConnection();
        $hash = hash('sha256', $token);

        $stmt = $pdo->prepare('
            SELECT * FROM refresh_tokens
            WHERE token_hash = :hash
                AND revoked_at IS NULL
                AND expires_at > NOW()
            LIMIT 1;
        ');

        $stmt->bindValue(':hash', $hash, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_OBJ); // NECESITO VER EXACTAMENTE QUE MIERDA DEVUELVE ESTO PLS ERIC TEN CUIDAO Y ME AVISAS

        return $row ?: null;

    }

    public function revoke(int $id): void
    {
        $pdo = $this->con->getConnection();

        $stmt = $pdo->prepare('
            UPDATE refresh_tokens
                SET revoked_at = NOW()
                WHERE id = :id
                  AND revoked_at IS NULL;
        ');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function revokeAllForUser(int $userId): void
    {
        $pdo = $this->con->getConnection();

        $stmt = $pdo->prepare("
            UPDATE refresh_tokens
            SET revoked_at = NOW()
            WHERE user_id = :user_id
                AND revoked_at IS NULL;
        ");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>