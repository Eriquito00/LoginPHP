<?php
namespace App\Controller;

class RecomendationController {
    private $recomendationid = "";

    public function indexCreate(){
        require_once(__DIR__ . "/../view/components/_reco_create.php");
    }

    public function indexUpdate(){
        //pillar los datos y pasarlos a la vista y mostrarlos

        $this->recomendationid = "";

        require_once(__DIR__ . "/../view/recomendation_data.php");
    }

    public function getData(){
        $image = $_POST["image"];
        $title = $_POST["title"];
        $text = $_POST["text"];

        if (!empty($this->recomendationid)){
            //tirar el update
        }
        else {
            //tirar el insert
        }

        require_once(__DIR__ . "/../view/profile.php");
    }
}

?>