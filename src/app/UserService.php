<?php
    function checkEmail($email){
        $regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $email = trim($email, " ");

        if (strlen($email) > 255) return false;
        if (!preg_match($regex, $email)) return false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;

        return true;
    }

    function checkPassword($password){
        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";
        $password = trim($password, " ");

        return preg_match($regex, $password);
    }
?>