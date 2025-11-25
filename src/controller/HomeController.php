<?php
namespace App\Controller;

use App\App\RecomendationService;
use App\Infraestructure\Database\Connection;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use App\Infraestructure\Persistence\RecomendationRepositoryPDO;

class HomeController {
    public function index(){
        require_once(__DIR__ . "/../view/home.php");
    }

    public function showFeed(){
        $search = $_POST["search"];
        $sentido = $_POST["sentido"];

        $connection = Connection::getInstance();

        $recoService = new RecomendationService(
            new RecomendationRepositoryPDO($connection), 
            //new UserRepositoryPDO($connection), 
            $connection);
        $pageData = $recoService->getPost(1, 10, $search, $sentido);

        require_once(__DIR__ . "/../view/components/_feed.php");
        require_once(__DIR__ . "/../view/components/_pagination_buttons.php");
    }
}
?>