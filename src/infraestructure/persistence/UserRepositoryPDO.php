<?php

namespace App\Infraestructure\Persistence;

use App\Infraestructure\Database\Connection;
use App\Infraestructure\Exceptions\DBErrorException;
use App\Model\Entities\User;
use App\Model\Repository\UserRepo;
use PDOException;
use PDO;

class UserRepositoryPDO implements UserRepo {
    private Connection $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * Funcion para insertar un usuario a la db
     * @param User $user
     */
    public function create($user) {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                INSERT INTO users(username, email, role_id, password_hash)
                    VALUES(:username, :email, :role_id, :passwordHash);
            ');
            $stmt->execute([
                ':username' => $user->getUsername(),
                ':email' => $user->getEmail(),
                ':role_id' => $user->getRoleId(),
                ':passwordHash' => $user->getPasswordHash()
            ]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function update($user, $newUser) {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                UPDATE users
                SET username = :newUsername,
                    email = :newEmail,
                    role_id = :newRole
                WHERE id = :old_id;

            ');
            $stmt->execute([
                ':newUsername' => $newUser->getUsername(),
                ':newEmail' => $newUser->getEmail(),
                ':newRole' => $newUser->getRoleId(),
                ':old_id' => $user->getId()
            ]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function delete(int $id) {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                DELETE FROM users WHERE id = :uid;
            ');
            $stmt->execute([':uid' => $id]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    /**
     * @param int $uid
     * @return User|null
     */
    public function get(int $uid) {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                SELECT * FROM users WHERE id = :uid;
            ');
            $stmt->execute([":uid" => $uid]);
            return $stmt->fetchObject(User::class);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function getByEmail(string $email): ?User {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                SELECT * FROM users WHERE email = :email;
            ');
            $stmt->execute([":email" => $email]);
            return $stmt->fetchObject(User::class);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function getByUsername(string $username): ?User {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                SELECT * FROM users WHERE username = :username;
            ');
            $stmt->execute([":username" => $username]);
            $result = $stmt->fetchObject(User::class);
            if (!$result) return null;
            return $result;
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function getByIdentity(string $identity): ?User {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                SELECT * FROM users WHERE email = :identity1 OR username = :identity2;
            ');
            $stmt->execute([":identity1" => $identity, ":identity2" => $identity]);
            $result = $stmt->fetchObject(User::class);
            if (!$result) return null;
            return $result;
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function getIdByUsername(string $username): ?int {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                SELECT id FROM users WHERE username = :username;
            ');
            $stmt->execute([":username" => $username]);
            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultSet["id"]; // PUEDE QUE ESTO NO FUNCIONE AAAAAA
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function updatePasswordHash(int $uid, string $newHash) : void {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                UPDATE users
                SET password = :newHash,
                WHERE id = :uid;

            ');
            $stmt->execute([
                ':newHash' => $newHash,
                ':uid' => $uid
            ]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }
}
?>