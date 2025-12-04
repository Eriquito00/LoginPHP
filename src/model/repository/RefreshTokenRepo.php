<?php
namespace App\Model\Repository;

interface RefreshTokenRepo {
    public function store(array $data): int;

    public function findActiveByToken(string $token): ?object;

    public function revoke(int $id): void;

    public function revokeAllForUser(int $userId): void;
}
?>