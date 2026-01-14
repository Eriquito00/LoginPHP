<?php
namespace App\Controller;

use App\App\RecomendationService;
use App\Helpers\InputImage;
use App\Infraestructure\Database\Connection;
use App\Infraestructure\Persistence\RecomendationRepositoryPDO;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use Exception;

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
        $user = $_POST["user"] ?? "";
        $image = $_FILES["image"] ?? null;
        $title = $_POST["title"] ?? "";
        $text = $_POST["text"] ?? "";

        try {
            $connection = Connection::getInstance();
            $recoServ = new RecomendationService(
                new RecomendationRepositoryPDO($connection),
                new UserRepositoryPDO($connection),
                $connection
            );

            $recoServ->post($user, $title, $text);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

        //require_once(__DIR__ . "/../view/profile.php");
    }
}

?>