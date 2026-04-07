<?php

namespace App\Infraestructure\Persistence;

use App\Infraestructure\Database\Connection;
use App\Infraestructure\Exceptions\DBErrorException;
use App\Model\Entities\Anime;
use App\Model\Repository\AnimeRepo;
use PDOException;

class AnimeRepositoryPDO implements AnimeRepo {
    private Connection $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * @param Anime $anime
     */
    public function create($anime) {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                INSERT INTO animes(mal_id, title, image_url, synopsis, score, episodes)
                    VALUES(:mal_id, :title, :image_url, :synopsis, :score, :episodes)
                ON DUPLICATE KEY UPDATE
                    title = VALUES(title),
                    image_url = VALUES(image_url),
                    synopsis = VALUES(synopsis),
                    score = VALUES(score),
                    episodes = VALUES(episodes),
                    updated_at = CURRENT_TIMESTAMP;
            ');

            $stmt->execute([
                ':mal_id' => $anime->getMalId(),
                ':title' => $anime->getTitle(),
                ':image_url' => $anime->getImageUrl(),
                ':synopsis' => $anime->getSynopsis(),
                ':score' => $anime->getScore(),
                ':episodes' => $anime->getEpisodes()
            ]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    /**
     * @param Anime $anime
     * @param Anime $newAnime
     */
    public function update($anime, $newAnime) {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                UPDATE animes
                SET title = :title,
                    image_url = :image_url,
                    synopsis = :synopsis,
                    score = :score,
                    episodes = :episodes
                WHERE id = :id;
            ');

            $stmt->execute([
                ':title' => $newAnime->getTitle(),
                ':image_url' => $newAnime->getImageUrl(),
                ':synopsis' => $newAnime->getSynopsis(),
                ':score' => $newAnime->getScore(),
                ':episodes' => $newAnime->getEpisodes(),
                ':id' => $anime->getId()
            ]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function delete(int $id) {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                DELETE FROM animes WHERE id = :id;
            ');
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function get(int $id): ?Anime {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                SELECT * FROM animes WHERE id = :id;
            ');
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetchObject(Anime::class);
            if (!$result) return null;
            return $result;
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    public function getByMalId(int $malId): ?Anime {
        try {
            $pdo = $this->connection->getConnection();
            $stmt = $pdo->prepare('
                SELECT * FROM animes WHERE mal_id = :mal_id;
            ');
            $stmt->execute([':mal_id' => $malId]);
            $result = $stmt->fetchObject(Anime::class);
            if (!$result) return null;
            return $result;
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }
}

?>
