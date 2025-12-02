<?php
namespace App\Model\Entities;

class User {
    private ?int $id = null;
    private string $username;
    private string $email;
    private ?string $role = null;
    private int $role_id;
    private ?string $password_hash = null;
    private bool $is_active;

    private const AVAILABLE_ROLES = ["user" => 1, "mod" => 2, "admin" => 3];

    /**
     * Constructor vacio para PDO::FETCH_CLASS
     */
    public function __construct() {}

    /**
     * Funcion para hidratar el objeto como si fuera un constructor parametrizado
     * @param int|null $id
     * @param string $username
     * @param string $email
     * @param string $role
     * @param string $password_hash
     * 
     * @return void
     */
    public function init(
        ?int $id,
        string $username,
        string $email,
        string $role,
        string $password_hash
    ): void {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        if (!empty(self::AVAILABLE_ROLES[$role])) {
            $this->role_id = self::AVAILABLE_ROLES[$role];
        } else {
            $this->role_id = 1;
        }
        $this->password_hash = $password_hash;
        $this->is_active = (bool)1;
    }

    public function setPassword(string $plain) : void {
        $this->password_hash = password_hash($plain, PASSWORD_DEFAULT);
        $plain = str_repeat("\0", strlen($plain));
    }

    public function verifyPassword(string $plain) : bool {
        return password_verify($plain, $this->password_hash);
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() { 
        return $this->username;
    }

    public function getEmail() { 
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getRoleId() {
        return $this->role_id;
    }

    public function isActive(): bool {
        return $this->is_active;
    }

    public function getPasswordHash() {
        return $this->password_hash;
    }

    public function __toString() {
        return "{
                    id: {$this->id}, 
                    username: {$this->username}, 
                    email: {$this->email}
                }";
    }
}
?>