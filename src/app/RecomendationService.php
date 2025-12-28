<?php

namespace App\App;

use App\App\Exceptions\LimitExceededException;
use App\Infraestructure\Database\Connection;
use App\Infraestructure\Persistence\RecomendationRepositoryPDO;
use Exception;
use App\App\Exceptions\UserNotExistsException;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use App\Model\Entities\CriteriaRecomendation;
use App\Model\Entities\Pagination;
use App\Model\Entities\Recomendation;

class RecomendationService {
    private RecomendationRepositoryPDO $dao;
    private UserRepositoryPDO $userdao;
    private Connection $con;

    public function __construct(RecomendationRepositoryPDO $dao, UserRepositoryPDO $userdao, Connection $con){
        $this->dao = $dao;
        $this->userdao = $userdao;
        $this->con = $con;
    }

    public function post($userid, $title, $text): void{
        if (strlen($title) > 50 || strlen($text) > 2000){
            $superado = strlen($title) > 50 ? "title" : "text";
            throw new LimitExceededException("Estas superando el limite de caracteres en $superado.");
        }

        if (!$this->userdao->get($userid)) throw new UserNotExistsException("No existe ningun usuario con este id.");

        $this->tx(function() use ($userid, $title, $text) {
            $recomendation = new Recomendation;
            $recomendation->init($userid, $title, $text);
            $this->dao->create($recomendation);
        });
    }

    public function getPost($page, $size, $username, $sentido): Pagination {
        $pagination = new CriteriaRecomendation($page, $size, $username, $sentido);

        return $this->tx(function() use ($pagination) {
            return $this->dao->getPaginated($pagination);
        });
    }

    public function editPost(){

    }

    public function deletePost(){
        
    }

    private function tx(callable $func){
        try {
            $pdo = $this->con->getConnection();
            $pdo->beginTransaction();
            $result = $func();
            $pdo->commit();
            return $result;
        }
        catch (Exception $e){
            if ($pdo->inTransaction()) $pdo->rollBack();
            throw $e;
        }
    }
}

?>