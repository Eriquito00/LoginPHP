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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/loginregister.css">
</head>
<body>
    <form method="POST" action="register" id="registerForm">
        <h1>Register</h1>
        <div>
            <label for="email">Email</label>
            <input name="email" type="email" placeholder="Introduce tu email" required>
        </div>

        <div>
            <label for="email">Contraseña</label>
            <input name="password" type="password" minlength="8" placeholder="Introduce tu contraseña" required>
        </div>

        <div>
            <label for="email">Repite la contraseña</label>
            <input name="repeat_password" type="password" placeholder="Repite tu contraseña" minlength="8" required>
        </div>

        <p id="error-message"></p>

        <?php if ($showRecaptcha): ?>
            <div class='g-recaptcha' data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>"></div>
        <?php endif; ?>

        <button type="submit">Register</button>
    </form>
</body>
</html>