<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"] ?? "";
        $password = $_POST["passwd"] ?? "";
        $repeat_passwd = $_POST["repeat_passwd"] ?? "";
    }
?>