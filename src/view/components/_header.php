<?php

use App\Controller\AuthController;

$authService = AuthController::getAuthService();
$isLogged = $authService ? $authService->isAuthenticated() : false;
$currentUser = $isLogged ? $authService->getCurrentUser() : null;
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./styles/_header.css">
<script defer src="./js/CreateReco.js"></script>
<header class="feed_search">
    <div class="header_title">
        <button class="btn_navigation btn_title" id="btn_navigation" aria-label="home"></button>
        <h1 class="header_h1">PHProgramando</h1>
    </div>
    <div class="header_inputs">
        <button class="btn_navigation btn_nav" id="btn_navigation" aria-label="hide-navigation"></button>
        <input class="filter" id="search" type="search" aria-label="search-bar" placeholder="Encuentra a tu autor favorito" spellcheck="true">
    </div>
    <div class="header_buttons">
        <?php if ($isLogged): ?>
            <button id="btnMenuRecoOpen" class="create_button" type="button">Create<img src="./assets/plus.png" alt="Create Recomendation"></button>
        <?php else: ?>
            <button id="btnMenuRecoOpen" class="create_button" type="button">Login<img src="./assets/plus.png" alt="Create Recomendation"></button>
        <?php endif; ?>
        <select id="sentido" class="filter">
            <option value="asc">ASC</option>
            <option value="desc" selected>DESC</option>
        </select>
    </div>
</header>
<?php require_once(__DIR__ . "/_reco_create.php"); ?>