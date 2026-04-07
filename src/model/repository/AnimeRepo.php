<?php

namespace App\Model\Repository;

use App\Model\Entities\Anime;

/**
 * @extends Repository<Anime>
 */
interface AnimeRepo extends Repository {
    /**
     * Recupera un anime por su MAL ID (id de Jikan/MyAnimeList).
     */
    public function getByMalId(int $malId): ?Anime;
}

?>
