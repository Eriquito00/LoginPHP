<?php
namespace App\Model\Entities;

class PublicUser {
    public function __construct(
        public int $id,
        public string $username,
        public string $email,
        public string $role
    ) {}

    public function getId(){
        return $this->id;
    }
}

?>