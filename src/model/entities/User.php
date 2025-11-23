<?php
namespace App\Model\Entities;

class User {
    private int $id;
    private string $username;
    private string $email;
    private string $role;
    private string $passwordHash;

    /**
     * Constructor vacio para PDO::FETCH_CLASS
     */
    public function __construct() {}


    /**
     * @param array $data ARRAY ASSOC con los datos
     * 
     * @return void
     */
    public function hydrate(array $data) : void {
        foreach ($data as $k => $v) {
            if(property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }


    /**
     * Funcion para hidratar el objeto como si fuera un constructor parametrizado
     * @param int $id
     * @param string $username
     * @param string $email
     * @param string $role
     * @param string $passwordHash
     * 
     * @return void
     */
    public function init(int $id, string $username, string $email, string $role = "user",string $passwordHash = '') : void {
        $this->id = $id;
        $this->username = $username;
        $this->role = $role;
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

    public function getRole() {
        return $this->role;
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