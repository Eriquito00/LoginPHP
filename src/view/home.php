<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Con ♥️ y PHP</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/style.css">
    <script defer src="./js/PaginationData.js"></script></head>
<body>
    <?php require_once(__DIR__ . "/components/_header.php"); ?>

    <?php require_once(__DIR__ . "/components/_navigation.php"); ?>

    <main id="main_content" class="main_content">
        <section id="lista_posts"></section>
    </main>

</body>
</html>