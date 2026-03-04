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
    <title>Login</title>
    <base href="<?= BASE_URL ?>">
    <?php if ($showRecaptcha): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php endif; ?>
    <script defer src="./js/ajax/OAuth2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/loginregister.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&display=swap" rel="stylesheet">
    <script type="module" src="./js/ajax/LoginData.js"></script>
</head>
<body class="log_reg_back">
    <form class="log_reg_form" method="POST" id="loginForm" action="auth/login">
        <h1 class="log_reg_title">Login</h1>
        <div>
            <label class="log_reg_label log_reg_lab_inp" for="email">Email</label>
            <input class="log_reg_input log_reg_shadow" name="email" id="email" type="text" placeholder="email@example.com" required>
        </div>

        <div>
            <label class="log_reg_label log_reg_lab_inp" for="password">Contraseña</label>
            <input class="log_reg_input log_reg_shadow" name="password" id="password" type="password" minlength="8" placeholder="Minimum 8 characters" required>
        </div>
        <div class="div_rem_passwd">
            <div>
                <input class="log_remember log_reg_shadow" name="remember" id="remember" type="checkbox">
                <label class="log_reg_label" for="remember">Remember me</label>
            </div>
            <a class="forgot_passwd" href="login/forgot-password-data">Has olvidado la contraseña?</a>
        </div>

        <p id="error-message"></p>

        <?php if ($showRecaptcha): ?>
            <div class='g-recaptcha' aria-label="recaptcha" data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>"></div>
        <?php endif; ?>

        <button class="log_reg_submit" type="submit">LOGIN</button>

        <p class="log_separation">- o -</p>

        <div class="log_oauth">
            <button class="log_container" type="button">
                <img class="log_oauth_img" src="./assets/github.webp" alt="Google logo">
                <p class="log_oauth_p">Login with GitHub</p>
            </button>
        </div>
    </form>
</body>
</html>