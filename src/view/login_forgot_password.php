<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de contraseña</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/login_forgot_password.css">
</head>
<body>
    <form method="POST" action="">
        <h1>Cambio de contraseña</h1>
        <p>Introduce la nueva contraseña para tu cuenta.</p>
        <label for="password">Password</label>
        <input type="password" name="password" minlength="8" placeholder="Introduce tu nueva contraseña" required>
        <label for="repeat_password">Repite la contraseña</label>
        <input type="password" name="repeat_password" minlength="8" placeholder="Repite tu nueva contraseña" required>
        <button type="submit" name="action" value="">Guardar</button>
    </form>
</body>
</html>