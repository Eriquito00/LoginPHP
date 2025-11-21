<?php
namespace App\Model\Repository;

use App\Model\Entities\Recomendation;
use App\Model\Entities\User;

/**
 * @extends Repository<User>
 */
interface UserRepo extends Repository {
    /**
     * Este metodo recupera todas las recomendaciones publicadas
     * por un mismo usuario cogiendo el uid del mismo
     * @param User $user
     * @return Recomendation[]
     */
    public function getAllRecomendationsPaginated($user) : array;

    /**
     * Este metodo recupera un usuario de la base de datos buscandolo por su username
     * @param string $username
     * @return User|null devuelve user si encuentra, devuelve null si no existe un usuario con ese username
     */
    public function getByUsername(string $username) : User | null;

    public function getIdByUsername(string $username) : int | null;

    /**
     * Este metodo recupera un usuario de la base de datos buscandolo por su email
     * @param string $email
     * @return User|null devuelve user si encuentra usuario con ese email, si no, devuelve null.
     */
    public function getByEmail(string $email) : User | null;
}
?>