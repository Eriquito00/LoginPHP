<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/loginregister.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <form method="POST" action="../controller/login_controller.php">
        <h1>Login</h1>
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" placeholder="Introduce tu email">
        </div>

        <div>
            <label for="email">Contraseña</label>
            <input id="passwd" type="password" placeholder="Introduce tu contraseña">
        </div>
        <button id="send" type="submit">Login</button>
    </form>
</body>
</html>