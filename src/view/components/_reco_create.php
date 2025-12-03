<link rel="stylesheet" href="./styles/_reco_create.css">
<script defer src="./js/CreateReco.js"></script>
<form class="form_create_reco" method="POST" action="profile/recomendationdata">
    <div class="div_img">
        <img class="form_image" src="./assets/moai.jpg" alt="Foto del post">
        <input name="image" type="file">
    </div>
    <label class="form_labels form_label_title" for="title">Title</label>
    <input class="form_input_title" name="title" type="text" maxlength="50" placeholder="Introduce el titulo de tu recomendacion" required>
    <label class="form_labels form_label_text" for="text">Text</label>
    <textarea class="form_textarea_text" name="text" maxlength="2000" placeholder="Introduce el texto de tu recomendacion" required></textarea>
    <div class="div_buttons">
        <button class="form_button" type="button" onclick="window.history.back();">Volver</button>
        <button class="form_button" type="submit">Guardar</button>
    </div>
</form>