<?php
namespace App\Controller;

class ProfileController {
    public function index(){
        require_once(__DIR__ . "/../view/profile.php");
    }

    public function userSetup(){
        $username = $_POST["username"] ?? null;
        echo $username;
    }
}

?>