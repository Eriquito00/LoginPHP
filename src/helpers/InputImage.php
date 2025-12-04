<?php
namespace App\Helpers;

class InputImage {
    /**
     * Funcion que guarda una imagen en el servidor
     *
     * @param array $image La imagen con toda su informacion
     * @param number $typeImage 0 si es perfil, 1 si es un post
     * @return string La ruta final a la imagen
     */
    public static function saveImage($image, $typeImage) {
        $imageTypes = ["profile", "post"];
        $tiposPermitidos = ['image/png', 'image/jpeg', 'image/webp'];

        if (!in_array($image['type'], $tiposPermitidos)) {
            //tirar una excepcion de tipo InvalidImageFormatException
        }

        $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, ['png', 'jpg', 'jpeg', 'webp'])) {
            //tirar una excepcion de tipo InvalidImageFormatException
        }

        $folderDest = "../uploads/" . $imageTypes[$typeImage];
        if (!file_exists($folderDest)) {
            mkdir($folderDest, 0777, true);
        }

        $imgName = uniqid("img_" . $imageTypes[$typeImage] . "_") . "." . $ext;

        $rutaFinal = $folderDest . "/" . $imgName;

        if (!move_uploaded_file($image['tmp_name'], $rutaFinal)) {
            //tirar una excepcion de tipo ErrorSavingImageException
        }

        return "uploads/" . $imageTypes[$typeImage] . "/" . $imgName;
    }
}
?>