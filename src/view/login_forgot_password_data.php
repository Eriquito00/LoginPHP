<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperacion de contraseña</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/login_forgot_password_data.css">
</head>
<body>
    <form method="POST" action="">
        <h1>Recupera tu contraseña</h1>
        <p>Te enviaremos un correo a la direccion especificada para proceder al cambio de contraseña de tu cuenta.</p>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Introduce tu email" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>