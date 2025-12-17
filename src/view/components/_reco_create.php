<?php

use App\Controller\AuthController;

$authService = AuthController::getAuthService();
$isLogged = $authService ? $authService->isAuthenticated() : false;
$currentUser = $isLogged ? $authService->getCurrentUser() : null;
?>

<link rel="stylesheet" href="./styles/_reco_create.css">
<script defer src="./js/ImportImage.js"></script>
<div id="formMenuReco" class="backdrop">
    <form class="form_create_reco" method="POST" action="profile/recomendationdata" enctype="multipart/form-data">
        <div class="div_img">
            <img id="previewImage" class="form_image" alt="Foto del post">
            <input id="inputImage" name="image" type="file" accept="image/png, image/jpeg, image/webp">
        </div>
        <label class="form_labels form_label_title" for="title">Title</label>
        <input class="form_input_title" name="title" type="text" maxlength="50" placeholder="Introduce el titulo de tu recomendacion" required>
        <label class="form_labels form_label_text" for="text">Text</label>
        <textarea class="form_textarea_text" name="text" maxlength="2000" placeholder="Introduce el texto de tu recomendacion" required></textarea>
        <div class="div_buttons">
            <button id="btnMenuRecoClose" class="form_button" type="button">Cerrar</button>
            <button class="form_button" type="submit">Guardar</button>
        </div>
    </form>
</div>