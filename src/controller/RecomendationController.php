<?php
namespace App\Controller;

use App\Helpers\InputImage;
use App\Infraestructure\Database\Connection;
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
        $image = $_FILES["image"] ?? null;
        $title = $_POST["title"] ?? "";
        $text = $_POST["text"] ?? "";

        try {
            $urlImage = InputImage::saveImage($image, 1);

            $connection = new Connection();
            $pdo = $connection->getConnection();

            $stmt = $pdo->prepare("
                INSERT INTO recomendations(user_id, title, description, image_url)
                    VALUES(:user_id, :title, :description, :image_url);
            ");

            // PODRIAMOS DEVOLVER LA ID DEL ULTIMO CREADO

            $stmt->execute([
                ':user_id' => 1,
                ':title' => $title,
                ':description' => $text,
                ":image_url" => $urlImage
            ]);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }

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