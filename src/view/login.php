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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/loginregister.css">
    <script type="module" src="./js/ajax/LoginData.js"></script>
</head>
<body>
    <form method="POST" id="loginForm" action="auth/login">
        <h1>Login</h1>
        <div>
            <label for="email">Email</label>
            <input name="email" id="email" type="text" placeholder="email@example.com" required>
        </div>

        <div>
            <label for="email">Contraseña</label>
            <input name="password" id="password" type="password" minlength="8" placeholder="Minimum 8 characters" required>
        </div>
        <div class="rembember div_rem_passwd">
            <div class="rembember">
                <input name="remember" id="remember" type="checkbox">
                <label for="remember">Remember me</label>
            </div>
            <a class="forgot_passwd" href="login/forgot-password-data">Has olvidado la contraseña?</a>
        </div>

        <p id="error-message"></p>

        <?php if ($showRecaptcha): ?>
            <div class='g-recaptcha' data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>"></div>
        <?php endif; ?>

        <button type="submit">Login</button>
    </form>
</body>
</html>