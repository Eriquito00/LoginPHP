<?php

namespace App\App;

use App\Application\Exceptions\UserAlreadyExistsException;
use App\Controller\Exceptions\InputMismatchError;
use App\Infraestructure\Database\Connection as DatabaseConnection;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use App\Model\Entities\User;
use Exception;

class UserService {
    private UserRepositoryPDO $dao;
    private DatabaseConnection $con;

    public function __construct($dao, $con){
        $this->dao = $dao;
        $this->con = $con;
    }

    public function register($username, $email, $passwordhash){
        $this->tx(function () use ($username, $email, $passwordhash) {
            if ($this->dao->getByUsername($username)) throw new UserAlreadyExistsException("Ya existe un usuario con este nombre.");
            if ($this->dao->getByEmail($email)) throw new UserAlreadyExistsException("Email en uso");
            $user = new User;
            $user->init(null,$username, $email, "", $passwordhash);
            $this->dao->create($user);
        });
    }

    public function verifyRegister($email, $password, $repeat_password){
        if (!$this->checkEmail($email)) throw new InputMismatchError("El email introducido no es valido.");
        if (!$this->checkPassword($password)) throw new InputMismatchError("La contraseña debe contener 8 caracteres, 1 mayuscula, 1 minuscula y 1 numero.");
        if (!$this->checkEqualPassword($password, $repeat_password)) throw new InputMismatchError("Las contraseñas no coinciden.");
    }

    private function checkEmail($email){
        $regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$/";
        $email = trim($email, " ");

        if (strlen($email) > 255) return false;
        if (!preg_match($regex, $email)) return false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;

        return true;
    }

    private function checkPassword($password){
        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";
        $password = trim($password, " ");

        return preg_match($regex, $password);
    }

    private function checkEqualPassword($password, $repeat_password){
        if ($password !== $repeat_password) return false;
        return true;
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