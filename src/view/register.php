<?php
session_start();
if (!isset($_SESSION["register_try"])){
    $_SESSION["register_try"] = 0;
}
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
<body class="log_reg_back">
    <form class="log_reg_form" method="POST" action="register">
        <h1 class="log_reg_title">Register</h1>
        <div>
            <label class="log_reg_label log_reg_lab_inp" for="email">Email</label>
            <input class="log_reg_input log_reg_shadow" name="email" type="email" placeholder="Introduce tu email" required>
        </div>

        <div>
            <label class="log_reg_label log_reg_lab_inp" for="email">Contraseña</label>
            <input class="log_reg_input log_reg_shadow" name="password" type="password" minlength="8" placeholder="Introduce tu contraseña" required>
        </div>

        <div>
            <label class="log_reg_label log_reg_lab_inp" for="email">Repite la contraseña</label>
            <input class="log_reg_input log_reg_shadow" name="repeat_password" type="password" placeholder="Repite tu contraseña" minlength="8" required>
        </div>

        <?php if ($_SESSION["register_try"] >= 3):?>
            <div class='g-recaptcha' data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>"></div>
        <?php endif; ?>

        <button class="log_reg_submit" type="submit">Register</button>
    </form>
</body>
</html>