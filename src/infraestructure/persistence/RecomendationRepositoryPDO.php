<?php

namespace App\Infraestructure\Persistence;

use App\Model\Entities\Recomendation;
use App\Model\Repository\RecomendationRepo;
use App\Infraestructure\Database\Connection;
use App\Infraestructure\Exceptions\DataConflictException;
use App\Infraestructure\Exceptions\DBErrorException;
use App\Model\Entities\CriteriaRecomendation;
use App\Model\Entities\Pagination;
use PDO;
use PDOException;

class RecomendationRepositoryPDO implements RecomendationRepo {
    private Connection $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * @param Recomendation $recomendation
     * @throws DBErrorException
     */
    public function create($recomendation) {
        try {
            $pdo = $this->connection->getConnection();

            $stmt = $pdo->prepare("
                INSERT INTO recomendations(user_id, title, description)
                    VALUES(:user_id, :title, :description);
            ");

            // PODRIAMOS DEVOLVER LA ID DEL ULTIMO CREADO

            $stmt->execute([
                ':user_id' => $recomendation->getUserId(),
                ':title' => $recomendation->getTitle(),
                ':description' => $recomendation->getDescription()
            ]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    /**
     * @param Recomendation $oldRecomendation
     * @param Recomendation $newRecomendation
     * 
     * @throws DBErrorException|DataConflictException
     */
    public function update($oldRecomendation, $newRecomendation) {
        try {
            if ($oldRecomendation->getId() == 0) throw new DataConflictException("Recomendation ID invalid");
            if ($oldRecomendation->getUserId() != $newRecomendation->getUserId()) throw new DataConflictException("User_Id must be the same");

            $pdo = $this->connection->getConnection();

            $stmt = $pdo->prepare("
                UPDATE TABLE recomendations
                    SET title = :title, description = :description
                WHERE id = :id;
            ");

            $stmt->execute([
                ':title' => $newRecomendation->getTitle(),
                ':description' => $newRecomendation->getDescription(),
                ':id' => $oldRecomendation->getId()
            ]);
        } catch (PDOException|DataConflictException $e) {
            if ($e instanceof PDOException) {
                throw new DBErrorException("Internal Server Error: " . $e->getMessage());
            }
            throw $e;
        }
    }

    public function delete(int $id) {
        try {
            $pdo = $this->connection->getConnection();

            $stmt = $pdo->prepare("
                DELETE FROM TABLE recomendations WHERE id = :id;
            ");

            $stmt->execute([
                ":id" => $id
            ]);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }

    /**
     * @param int $recomendationid
     * @return Recomendation|null
     */
    public function get(int $recomendationid) {
        try {
            $pdo = $this->connection->getConnection();

            $stmt = $pdo->prepare("
                SELECT * FROM recomendations
                WHERE id = :id;
            ");

            $stmt->execute([
                ":id" => $recomendationid
            ]);
            return $stmt->fetchObject(Recomendation::class);
        } catch (PDOException $e) {
            throw new DBErrorException("Internal Server Error: " . $e->getMessage());
        }
    }
    
    /**
     * @param CriteriaRecomendation $criteria
     * 
     * @return Pagination pagina con los resultados siguiendo la criteria
     */
    public function getPaginated(CriteriaRecomendation $criteria) : Pagination {
        $pdo = $this->connection->getConnection();
        [$whereSql, $params] = $this->buildWhere($criteria);

        $sqlCount = "
            SELECT COUNT(*) AS total 
            FROM recomendations r 
            INNER JOIN users u ON r.user_id = u.id
            $whereSql
        ";
        
        $stmt = $pdo->prepare($sqlCount);
        $stmt->execute($params);
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC); // ESTO DEBERIA (POR FAVOR QUE SEA ASI) DEVOLVER UN ARRAY ASSOC CON UN CAMPO llamado total => $total de items

        // AQUI AHORA COMPRUEBO SI ES VALIDO EL OFFSET, SI NO, A LA MIELDA A LA ULTIMA
        $totalPages = intval(ceil($resultSet["total"] / $criteria->getSize()));

        if ($criteria->getPage() > $totalPages) {
            $offset = ($totalPages - 1) * $criteria->getSize();
            $criteria->setPage($totalPages);
        }
        $offset = ($criteria->getPage() - 1) * $criteria->getSize();

        $sqlPagination = "
            SELECT r.*, u.username 
            FROM recomendations r
            INNER JOIN users u ON r.user_id = u.id
            $whereSql 
            ORDER BY {$criteria->getOrden()} {$criteria->getSentido()} 
            LIMIT :page_size OFFSET :offset
        ";
        
        $paginatedStmt = $pdo->prepare($sqlPagination);

        $params[":page_size"] = $criteria->getSize();
        $params[":offset"] = $offset;

        $paginatedStmt->execute($params);

        $items = $paginatedStmt->fetchAll(PDO::FETCH_CLASS, Recomendation::class);

        return new Pagination(
            $items,
            $criteria->getPage(),
            $offset + $criteria->getSize() < $resultSet["total"],
            $criteria->getPage() != 1,
            $totalPages,
            $resultSet["total"]
        );

    }

    public function getUserId($recomendation): int
    {   
        // TODO: Implement this method for geting the uid of a recomendation in the db
        throw new \Exception('Not implemented');
    }

    private function buildWhere(CriteriaRecomendation $criteria) : array {
        $conds = [];
        $params = [];

        if (!empty($criteria->getUsername())) {
            $sub = "(SELECT username FROM users u WHERE u.id = r.user_id)";
            array_push($conds, "$sub LIKE :username");
            $params[":username"] = "%{$criteria->getUsername()}%";
        }

        $whereSql = "";
        if ($conds) {
            $whereSql = "WHERE " . implode(" AND ", $conds);
        }

        return [$whereSql, $params];
    }
}
?>