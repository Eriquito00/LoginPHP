<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recomendation</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/recomendation_data.css">
</head>
<body>
    <form method="POST" action="profile/recomendationdata">
        <div class="div_img">
            <img src="./assets/moai.jpg" alt="Foto del post">
            <input name="image" type="file">
        </div>
        <label for="title">Title</label>
        <input name="title" type="text" maxlength="50" placeholder="Introduce el titulo de tu recomendacion" required>
        <label for="text">Text</label>
        <textarea name="text" maxlength="2000" placeholder="Introduce el texto de tu recomendacion" required></textarea>
        <div class="div_buttons">
            <button type="button" onclick="window.history.back();">Volver</button>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>
</html>