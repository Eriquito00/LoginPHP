<?php

namespace App\Model\Repository;

/**
 * @extends Repository<Recomendation>
 */
interface RecomendationRepo extends Repository {
    public function getPaginated($limit, $offset);
}
?>