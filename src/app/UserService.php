<?php

namespace App\App;

use App\Controller\Exceptions\InputMismatchError;
use Dba\Connection;

class UserService {
    //private UserService $dao;
    //private Connection $con;

    public function __construct(/*$dao, $con*/){
        //$this->dao = $dao;
        //$this->con = $con;
    }

    public function register($email, $password, $repeat_password){
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
        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8}$/";
        $password = trim($password, " ");

        return preg_match($regex, $password);
    }

    private function checkEqualPassword($password, $repeat_password){
        if ($password !== $repeat_password) return false;
        return true;
    }
}
?>