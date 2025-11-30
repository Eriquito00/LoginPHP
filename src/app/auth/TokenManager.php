<?php
namespace App\App\Auth;

use App\Infraestructure\Persistence\RefreshTokenRepositoryPDO;
use App\Model\Entities\User;
use DateTimeImmutable;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenManager {
    public function __construct(
        private string $iss,
        private string $aud,
        private string $encrypAlg,
        private int $accessTtl,
        private int $refreshTtlDays,
        private RefreshTokenRepositoryPDO $persistence,
        private ?string $privateKey = null,
        private ?string $publicKey = null,
        private ?string $hsSecret = null
    ) {}

    public function issueAccessToken(User $u) : object {
        $now = time();
        $exp = $now + $this->accessTtl;

        $payload = [
            'iss' => $this->iss,
            'aud' => $this->aud,
            'sub' => (string) $u->getId(),
            'iat' => $now,
            'nbf' => $now,
            'exp' => $exp,
            'role' => $u->getRole()
        ];

        $jwt = $this->sign($payload);

        return (object)[
            "jwt" => $jwt,
            "exp" => $exp
        ];
    }

    public function issueRefreshToken(User $u, string $ip, string $ua) : object {
        $token = bin2hex(random_bytes(64));
        $hash = hash("sha256", $token);

        $expiresAt = (new \DateTimeImmutable('+' . $this->refreshTtlDays . ' days'));
        $expTs = $expiresAt->getTimestamp();

        $this->persistence->store([
            'user_id'    => $u->getId(),
            'token_hash' => $hash,
            'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
            'ip'         => $ip,
            'user_agent' => $ua
        ]);

        return (object)[
            'token' => $token,
            'exp' => $expTs
        ];
    }

    /**
     * @param object{ id:int } $record
     */
    public function rotateRefreshToken(object $record, User $u, string $ip, string $ua) {
        $this->persistence->revoke($record->id);

        return $this->issueRefreshToken($u, $ip, $ua);
    }

    public function verifyAccessToken(string $jwt) {
        if ($this->encrypAlg === 'HS256') {
            if ($this->hsSecret === null) {
                throw new \RuntimeException('HS256 requiere hsSecret configurado');
            }
            $key = new Key($this->hsSecret, 'HS256');
        } else {
            if ($this->publicKey === null) {
                throw new \RuntimeException($this->encrypAlg . ' requiere publicKey configurada');
            }
            $key = new Key($this->publicKey, $this->encrypAlg);
        }

        //- Valida la firma
        //- Valida exp, nbf, iat (si están presentes)
        //- Si algo falla lanza una excepción (ExpiredException, SignatureInvalidException, etc.)
        $payload = JWT::decode($jwt, $key);

        if (($payload->iss ?? null) !== $this->iss) {
            throw new \UnexpectedValueException('Issuer (iss) inválido');
        }
        if (($payload->aud ?? null) !== $this->aud) {
            throw new \UnexpectedValueException('Audience (aud) inválido');
        }
    }

    private function sign(array $payload) : string {
        if ($this->encrypAlg == "HS256") {
            return JWT::encode($payload, $this->hsSecret, "HS256");
        }
        return JWT::encode($payload, $this->privateKey, $this->encrypAlg);
    }
 }
?>