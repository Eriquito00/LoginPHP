<?php

namespace App\Controller;

use App\App\AnimeService;
use App\Infraestructure\Database\Connection;
use App\Infraestructure\Persistence\AnimeRepositoryPDO;
use Exception;
use RuntimeException;

class AnimeController
{
    public function getById($id): void
    {
        header('Content-Type: application/json');

        $animeId = (int) $id;
        if ($animeId <= 0) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => 'Anime id invalido'
            ]);
            return;
        }

        try {
            $connection = Connection::getInstance();
            $animeService = new AnimeService(
                new AnimeRepositoryPDO($connection),
                $connection
            );

            $anime = $animeService->getByMalId($animeId);

            if (!$anime) {
                http_response_code(404);
                echo json_encode([
                    'success' => false,
                    'error' => 'Anime no encontrado'
                ]);
                return;
            }

            http_response_code(200);
            echo json_encode([
                'success' => true,
                'data' => $anime->toArray()
            ]);
        } catch (RuntimeException $e) {
            $statusCode = $e->getCode();
            if ($statusCode < 400 || $statusCode > 599) {
                $statusCode = 500;
            }

            http_response_code($statusCode);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'An unexpected error occurred'
            ]);
        }
    }
}
