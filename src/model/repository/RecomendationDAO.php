<?php 
interface RecomendationDAO {
    public function createRecomendation($recomendation);
    public function updateRecomendation($recomendation, $newRecomendation);
    public function deleteRecomendation($recomendation);
    public function getAllRecomendations();
    public function getRecomendationById($id);
    public function getRecomendationsPaginated($limit, $offset);
}
?>