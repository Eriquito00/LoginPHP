<?php

namespace App\App;

use App\Infraestructure\Database\Connection;
use App\Infraestructure\Persistence\AnimeRepositoryPDO;
use App\Model\Entities\Anime;
use Exception;
use RuntimeException;

class AnimeService
{
    private const JIKAN_BASE_URL = 'https://api.jikan.moe/v4';
    private const JIKAN_MAX_RETRIES = 2;

    private AnimeRepositoryPDO $dao;
    private Connection $con;

    public function __construct(AnimeRepositoryPDO $dao, Connection $con)
    {
        $this->dao = $dao;
        $this->con = $con;
    }

    public function getByMalId(int $malId): ?Anime
    {
        if ($malId <= 0) {
            throw new RuntimeException('Anime id invalido', 400);
        }

        $dbAnime = $this->dao->getByMalId($malId);
        if ($dbAnime) {
            return $dbAnime;
        }

        $jikanAnime = $this->fetchFromJikan($malId);
        if ($jikanAnime === null) {
            return null;
        }

        $anime = new Anime();
        $anime->init(
            malId: $jikanAnime['mal_id'],
            title: $jikanAnime['title'],
            imageUrl: $jikanAnime['image_url'],
            synopsis: $jikanAnime['synopsis'],
            score: $jikanAnime['score'],
            episodes: $jikanAnime['episodes']
        );

        $this->tx(function () use ($anime) {
            $this->dao->create($anime);
        });

        $stored = $this->dao->getByMalId($malId);
        return $stored ?? $anime;
    }

    private function fetchFromJikan(int $malId): ?array
    {
        $url = self::JIKAN_BASE_URL . '/anime/' . rawurlencode((string)$malId);

        for ($attempt = 0; $attempt <= self::JIKAN_MAX_RETRIES; $attempt++) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
            curl_setopt($ch, CURLOPT_USERAGENT, 'LoginPHP/1.0 (Jikan client)');

            $response = curl_exec($ch);
            if ($response === false) {
                curl_close($ch);
                throw new RuntimeException('No se pudo conectar a Jikan API', 502);
            }

            $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($statusCode === 200) {
                $decoded = json_decode($response, true);
                if (!is_array($decoded) || !isset($decoded['data']) || !is_array($decoded['data'])) {
                    throw new RuntimeException('Respuesta invalida de Jikan API', 502);
                }

                $data = $decoded['data'];

                $title = trim((string) ($data['title_english'] ?? $data['title'] ?? $data['title_japanese'] ?? ''));
                if ($title === '') {
                    throw new RuntimeException('Jikan API no devolvio titulo valido', 502);
                }

                return [
                    'mal_id' => (int) ($data['mal_id'] ?? $malId),
                    'title' => $title,
                    'image_url' => $data['images']['jpg']['image_url'] ?? null,
                    'synopsis' => $data['synopsis'] ?? null,
                    'score' => isset($data['score']) ? (float) $data['score'] : null,
                    'episodes' => isset($data['episodes']) ? (int) $data['episodes'] : null,
                ];
            }

            if ($statusCode === 404) {
                return null;
            }

            $canRetry = $attempt < self::JIKAN_MAX_RETRIES;
            if (($statusCode === 429 || $statusCode >= 500) && $canRetry) {
                usleep(($attempt + 1) * 350000);
                continue;
            }

            if ($statusCode === 429) {
                throw new RuntimeException('Jikan API rate limit alcanzado. Intenta de nuevo en unos segundos.', 429);
            }

            if ($statusCode >= 500) {
                throw new RuntimeException('Jikan API temporalmente no disponible.', 503);
            }

            throw new RuntimeException('Jikan API devolvio estado no esperado: ' . $statusCode, 502);
        }

        throw new RuntimeException('No se pudo recuperar el anime desde Jikan API.', 502);
    }

    private function tx(callable $func)
    {
        try {
            $pdo = $this->con->getConnection();
            $pdo->beginTransaction();
            $result = $func();
            $pdo->commit();
            return $result;
        } catch (Exception $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            throw $e;
        }
    }
}
