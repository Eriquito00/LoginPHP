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

    private const AVAILABLE_ROLES = ["1" => "user", "2" => "mod", "3" => "admin"];

    /**
     * Constructor vacio para PDO::FETCH_CLASS
     */
    public function __construct() {}

    /**
     * Funcion para hidratar el objeto como si fuera un constructor parametrizado
     * @param int|null $id
     * @param string $username
     * @param string $email
     * @param int $role_id
     * @param string $password_hash
     * 
     * @return void
     */
    public function init(
        ?int $id,
        string $username,
        string $email,
        int $role_id,
        string $password_hash = ""
    ): void {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->role_id = $role_id;
        $this->resolveRole();
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

    private function resolveRole(): void {
        if ($this->role_id != null && isset(self::AVAILABLE_ROLES[$this->role_id])) {
            $this->role = self::AVAILABLE_ROLES[$this->role_id];
        } else {
            $this->role_id = 1;
            $this->role = "user";
        }
    }

    public function setId(int $id) {
        $this->id = $id;
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

    public function getRole(): string {
        // Lazy loading: si role es null pero role_id existe, lo resolvemos
        if ($this->role == null && $this->role_id != null) {
            $this->resolveRole();
        }
        return $this->role ?? 'user';
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