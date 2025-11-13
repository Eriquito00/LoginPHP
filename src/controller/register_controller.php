<?php
    include_once(__DIR__ . "/../view/register.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"] ?? "";
        $password = $_POST["passwd"] ?? "";
        $repeat_passwd = $_POST["repeat_passwd"] ?? "";
    }
?>