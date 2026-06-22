<?php
namespace App\Controller;

use App\App\RecomendationService;
use App\Infraestructure\Database\Connection;
use App\Infraestructure\Persistence\UserRepositoryPDO;
use App\Infraestructure\Persistence\RecomendationRepositoryPDO;
use Exception;

class HomeController {
    public function index(){
        require_once(__DIR__ . "/../view/home.php");
    }

    public function showFeed(){
        try {
            // Validar que es una petición AJAX
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

            $acceptsHtml = strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'text/html') !== false;
            
            // Si no es AJAX y acepta HTML, es navegación directa
            if (!$isAjax && $acceptsHtml) {
                header("Location: " . BASE_URL);
                exit;
            }

            $page = empty($_GET["page"]) ? 1 : $_GET["page"];
            $size = $_GET["items_page"] ?? 10;
            $search = $_GET["search"] ?? "";
            $sentido = $_GET["sentido"] ?? "desc";

            $connection = Connection::getInstance();

            $recoService = new RecomendationService(
                new RecomendationRepositoryPDO($connection), 
                new UserRepositoryPDO($connection), 
                $connection);
            $pageData = $recoService->getPost($page, $size, $search, $sentido);
            require_once(__DIR__ . "/../view/components/_feed.php");
            require_once(__DIR__ . "/../view/components/_pagination_buttons.php");
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
}
?>