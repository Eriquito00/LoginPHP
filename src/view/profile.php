<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/navigation.css">
    <link rel="stylesheet" href="./styles/profile.css">
</head>
<body>

    <?php require_once(__DIR__ . "/components/_header.php"); ?>

    <?php require_once(__DIR__ . "/components/_navigation.php"); ?>

    <main id="main_content" class="main_content">
        <section class="section_profile">
            <img class="img_profile" src="./assets/moai.jpg" alt="Foto de perfil">
            <h2>Username</h2>
        </section>
        <h2>Tus recomendaciones</h2>
        <section class="section_recomendations">
            <article>
                <h3>Ejemplo</h3>
                <p>Texto</p>
            </article>
            <article>
                <h3>One Piece</h3>
                <p>One Piece es una obra increíble que combina aventura, humor y emociones profundas. La historia de Luffy y su tripulación está llena de momentos épicos y personajes memorables. El desarrollo del mundo y los arcos argumentales mantienen al espectador enganchado, y el mensaje sobre la amistad y perseguir los sueños es inspirador.</p>
            </article>
            <article>
                <img class="img_publication" src="./assets/moai.jpg" alt="Foto de la publicacion">
                <h3>Ejemplo</h3>
                <p>Texto</p>
            </article>
            <article></article>
            <article></article>
        </section>
    </main>
</body>
</html>