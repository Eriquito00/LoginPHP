<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Setup</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/profile_setup.css">
</head>
<body>
    <form method="POST" action="profile/setup">
        <h1>Personaliza tu perfil</h1>
        <div class="div-image">
            <label for="image">Foto de perfil</label>
            <img id="preview" src="./assets/moai.jpg" alt="Imagen por defecto">
            <input id="image" type="file">
        </div>
        <div class="div-username">
            <label for="username">Username</label>
            <input type="text" placeholder="Introduce tu username" required>
        </div>
        <div class="div-button">
            <button type="submit">Crear perfil</button>
        </div>
    </form>
</body>
</html>