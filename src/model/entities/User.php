<?php
class User {
    private int $id;
    private string $username;
    private string $email;
    private string $passwordHash;

    public function __construct() {}

    public function hydrate(array $data) : void {
        foreach ($data as $k => $v) {
            if(property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    public function init(int $id, string $username, string $email, string $passwordHash = '') {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        if ($passwordHash !== '') {
            $this->passwordHash = $passwordHash;
        }
    }

    public function setPassword(string $plain) : void {
        $this->passwordHash = password_hash($plain, PASSWORD_DEFAULT);
        $plain = str_repeat("\0", strlen($plain));
    }

    public function verifyPassword(string $plain) : bool {
        return password_verify($plain, $this->passwordHash);
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

    public function getPasswordHash() {
        return $this->passwordHash;
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