<?php

namespace App\Infraestructure\Persistence;

use App\model\repository\RecomendationRepo;

class RecomendationRepositoryPDO implements RecomendationRepo {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function create($recomendation) {
        // TODO: Implement createRecomendation method
    }

    public function update($recomendation, $newRecomendation) {
        // TODO: Implement updateRecomendation method
    }

    public function delete($id) {
        // TODO: Implement deleteRecomendation method
    }

    public function getAll() : array {
        $a = [];
        return $a;
        // TODO: Implement getAllRecomendations method
    }

    public function get($id) {
        // TODO: Implement getRecomendationById method
    }

    public function getPaginated($page, $limit) {
        // TODO: Implement getRecomendationsPaginated method
    }
}
?>