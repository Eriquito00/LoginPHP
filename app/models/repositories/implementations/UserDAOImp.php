<?php
require_once __DIR__ . "/../interfaces/UserDAO.php";

class UserDAOImp implements UserDAO {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getAllUsers() {
        // Implementation here
    }

    public function createUser($user) {
        // Implementation here
    }

    public function updateUser($user, $newUser) {
        // Implementation here
    }

    public function deleteUser($id) {
        // Implementation here
    }

    public function getUserById($id) {
        // Implementation here
    }
}
?>