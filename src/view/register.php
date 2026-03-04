<?php
session_start();
if (!isset($_SESSION["login_try"])){
    $_SESSION["login_try"] = 0;
}
$showRecaptcha = $_SESSION["login_try"] >= 3;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <base href="<?= BASE_URL ?>">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script defer src="./js/ajax/OAuth2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/loginregister.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
</head>
<body class="log_reg_back">
    <form class="log_reg_form" method="POST" action="register" id="registerForm">
        <h1 class="log_reg_title">Register</h1>
        <div>
            <label class="log_reg_label log_reg_lab_inp" for="email">Email</label>
            <input class="log_reg_input log_reg_shadow" name="email" type="email" placeholder="Introduce tu email" required>
        </div>

        <div>
            <label class="log_reg_label log_reg_lab_inp" for="password">Contraseña</label>
            <input class="log_reg_input log_reg_shadow" name="password" type="password" minlength="8" placeholder="Introduce tu contraseña" required>
        </div>

        <div>
            <label class="log_reg_label log_reg_lab_inp" for="repeat_password">Repite la contraseña</label>
            <input class="log_reg_input log_reg_shadow" name="repeat_password" type="password" placeholder="Repite tu contraseña" minlength="8" required>
        </div>

        <p id="error-message"></p>

        <?php if ($showRecaptcha): ?>
            <div class='g-recaptcha' data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>"></div>
        <?php endif; ?>

        <button class="log_reg_submit" type="submit">Register</button>
    
        <p class="log_separation">- o -</p>

        <div class="log_oauth">
            <button class="log_container" id="oauth_github" type="button">
                <img class="log_oauth_img" src="./assets/github.webp" alt="Google logo">
                <p class="log_oauth_p">Login with GitHub</p>
            </button>
        </div>
    </form>
</body>
</html>