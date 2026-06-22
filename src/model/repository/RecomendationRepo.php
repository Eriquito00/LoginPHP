<?php

namespace App\Model\Repository;

use App\Model\Entities\CriteriaRecomendation;
use App\Model\Entities\Pagination;
use App\Model\Entities\Recomendation;

/**
 * @extends Repository<Recomendation>
 */
interface RecomendationRepo extends Repository {
    // TODO: migrar getPaginated a que le pases una criteria!
    /**
     * Este metodo te devuelve recomendaciones paginadas siguiendo los criterios del usuario
     * @param CriteriaRecomendation $criteria
     */
    public function getPaginated(CriteriaRecomendation $criteria) : Pagination;

    /**
     * Este metodo recupera el uid del usuario que posteo la recomendacion especificada como parametro
     * @param Recomendation $recomendation
     * @return int No puede ser null porque si o si una recomendacion es posteada por un usuario
     */
    public function getUserId($recomendation) : int;
}
?>