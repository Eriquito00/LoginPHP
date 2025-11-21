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
    <form method="POST" action="login">
        <h1>Login</h1>
        <div>
            <label for="email">Email</label>
            <input name="email" type="email" placeholder="Introduce tu email" required>
        </div>

        <div>
            <label for="email">Contraseña</label>
            <input name="password" type="password" minlength="8" placeholder="Introduce tu contraseña" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>