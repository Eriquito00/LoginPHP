<?php
namespace App\Model\Repository;

use App\Model\Entities\User;

/**
 * @extends Repository<User>
 */
interface UserRepo extends Repository {
    /**
     * Este metodo recupera un usuario de la base de datos buscandolo por su username
     * @param string $username
     * @return User|null devuelve user si encuentra, devuelve null si no existe un usuario con ese username
     */
    public function getByUsername(string $username) : User | null;

    /**
     * Este metodo devuelve la id de un usuario por su nombre de usuario
     * @param string $username el nombre de usuario del que rescatar la id
     * @return int|null la id del usuario rescatada o nulo si no hay usuario con ese username
     */
    public function getIdByUsername(string $username) : int | null;

    /**
     * Este metodo recupera un usuario de la base de datos buscandolo por su email
     * @param string $email
     * @return User|null devuelve user si encuentra usuario con ese email, si no, devuelve null.
     */
    public function getByEmail(string $email) : User | null;

    // METODO PARA EL AUTH SERVICE --> EXCLUSIVAMENTE PORVAFOR

    /**
     * Este metodo sirve unica i exclusivamente para actualizar contraseñas, pero se debe utilizar solo
     * desde la clase de AuthService o Autenticaciones futuras porfavor!!
     * @param int $uid el usuario al que se le actualizará la contraseña
     * @param string $newHash el hash de la contraseña nueva que se actualizará en la db
     */
    public function updatePasswordHash(int $uid, string $newHash);

}
?>