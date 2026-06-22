<?php

use App\Controller\AuthController;

$authService = AuthController::getAuthService();
$isLogged = $authService ? $authService->isAuthenticated() : false;
$currentUser = $isLogged ? $authService->getCurrentUser() : null;
?>

<link rel="stylesheet" href="./styles/_reco_create.css">
<script defer src="./js/ImportImage.js"></script>
<script type="module" src="./js/ajax/RecomendationData.js"></script>
<div id="formMenuReco" class="backdrop">
    <form class="form_create_reco" enctype="multipart/form-data">
        <div class="div_img">
            <img id="previewImage" class="form_image" alt="Foto del post">
            <input id="inputImage" name="image" type="file" accept="image/png, image/jpeg, image/webp">
        </div>
        <label class="form_labels form_label_title" for="title">Title</label>
        <input id="title" class="form_input_title" name="title" type="text" maxlength="50" placeholder="Introduce el titulo de tu recomendacion" required>
        <label class="form_labels form_label_text" for="text">Text</label>
        <textarea id="description" class="form_textarea_text" name="text" maxlength="2000" placeholder="Introduce el texto de tu recomendacion" required></textarea>
        <input type="hidden" id="user" name="user" value="<?php echo $currentUser?->getId() ?? 0; ?>">
        <div class="div_buttons">
            <button id="btnMenuRecoClose" class="form_button" type="button">Cerrar</button>
            <button id="btnSubmitReco" class="form_button" type="submit">Guardar</button>
        </div>
    </form>
</div>