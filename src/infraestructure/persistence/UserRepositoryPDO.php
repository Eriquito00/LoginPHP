<?php
class UserRepositoryPDO implements UserRepo {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getAll() : array {
        $a = [];
        return $a;
        // Implementation here
    }

    public function create($user) {
        // Implementation here
    }

    public function update($user, $newUser) {
        // Implementation here
    }

    public function delete($user) {
        // Implementation here
    }

    public function get($user) {
        // Implementation here
    }
}
?>