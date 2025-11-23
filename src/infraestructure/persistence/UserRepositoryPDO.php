<?php

namespace App\Infraestructure\Persistence;

use App\Infraestructure\Database\Connection;
use App\Model\Repository\UserRepo;

/**
 * WIP: To be implemented
 */
class UserRepositoryPDO implements UserRepo {
    private Connection $connection;

    public function __construct(Connection $connection) {
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