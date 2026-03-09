<?php
namespace App\Model\Entities;

class OAuthUser {
    public function __construct(
        private int $providerUserId,
        private string $provider, 
        private string $username, 
        private string $email, 
        private string $access_token
    ) {
        $this->providerUserId = $providerUserId;
        $this->provider = $provider;
        $this->username = $username;
        $this->email = $email;
        $this->access_token = $access_token;
    }

    public function getProviderUserId() {
        return $this->providerUserId;
    }

    public function getProvider() {
        return $this->provider;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAcccess_Token() {
        return $this->access_token;
    }
}

?>