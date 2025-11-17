<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./styles/loginregister.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <form method="POST" action="../controller/register_controller.php">
        <h1>Register</h1>
        <div>
            <label for="email">Email</label>
            <input id="email" type="email">
        </div>

        <div>
            <label for="email">Contraseña</label>
            <input id="passwd" type="password">
        </div>

        <div>
            <label for="email">Repite la contraseña</label>
            <input id="repeat_passwd" type="password">
        </div>

        <button id="send" type="submit">Register</button>
    </form>
</body>
</html>