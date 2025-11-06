<?php
require_once __DIR__ . "/../interfaces/RecomendationDAO.php";

class RecomendationDAOImp implements RecomendationDAO {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createRecomendation($recomendation) {
        // TODO: Implement createRecomendation method
    }

    public function updateRecomendation($recomendation, $newRecomendation) {
        // TODO: Implement updateRecomendation method
    }

    public function deleteRecomendation($id) {
        // TODO: Implement deleteRecomendation method
    }

    public function getAllRecomendations() {
        // TODO: Implement getAllRecomendations method
    }

    public function getRecomendationById($id) {
        // TODO: Implement getRecomendationById method
    }

    public function getRecomendationsPaginated($page, $limit) {
        // TODO: Implement getRecomendationsPaginated method
    }
}
?>