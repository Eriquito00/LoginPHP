<?php
namespace App\Controller;

class HomeController {
    public function index(){
        require_once(__DIR__ . "/../view/home.php");
    }

    public function showFeed(){
        $sentido = $_POST["sentido"];
        require_once(__DIR__ . "/../view/home/_feed.php");
    }
}
?>