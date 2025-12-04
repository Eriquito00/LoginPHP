<?php

namespace App\Helpers;

use App\Helpers\Exceptions\InvalidImageFormatException;
use App\Helpers\Exceptions\ErrorSavingImageException;

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
            throw new InvalidImageFormatException("El formato de la imagen no esta entre los formatos permitidos.");
        }

        $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, ['png', 'jpg', 'jpeg', 'webp'])) {
            throw new InvalidImageFormatException("El formato de la imagen no esta entre los formatos permitidos.");
        }

        $folderDest = BASE_PATH . "/uploads/" . $imageTypes[$typeImage];
        if (!file_exists($folderDest)) {
            mkdir($folderDest, 0777, true);
        }

        $imgName = uniqid("img_" . $imageTypes[$typeImage] . "_") . "." . $ext;

        $rutaFinal = $folderDest . "/" . $imgName;

        if (!move_uploaded_file($image['tmp_name'], $rutaFinal)) {
            throw new ErrorSavingImageException("Error al guardar la imagen.");
        }

        return "uploads/" . $imageTypes[$typeImage] . "/" . $imgName;
    }
}
?>