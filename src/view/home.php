<?php require_once __DIR__ . "/../services/api/WikipediaAPIClient.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Con ♥️ y PHP</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <h1>Phpero</h1>
    <?php $phpinfo = getWikipediaArticle("PHP"); ?>
    <p><?= $phpinfo['extract']; ?></p>
    <img src="<?= $phpinfo['thumbnail']['source']; ?>" alt="PHP Thumbnail">
</body>
</html>