<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <base href="/LoginPHP/public/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/navigation.css">
    <link rel="stylesheet" href="./styles/profile_settings.css">
</head>
<body>
    <h1>Opciones de tu perfil</h1>
    <nav>
        <ul>
            <li><a href=""><button>Home</button></a></li>
            <li><a href="login"><button>Login</button></a></li>
            <li><a href="register"><button>Register</button></a></li>
            <li><a href="profile"><button>Profile</button></a></li>
            <li><a href="profile/settings"><button>Profile/Settings</button></a></li>
            <li><a href="profile/create"><button>Create Reco</button></a></li>
        </ul>
    </nav>
    <section>
        <form method="POST" action="profile/settings">
            <div class="div_img_profile">
                <div class="img_profile">
                    <img class="img_profile" src="./assets/moai.jpg" alt="Foto de perfil">
                    <label for="image">Foto de perfil</label>
                </div>
                <div>
                    <input name="image" type="file">
                    <button class="btn-form" type="submit">Aplicar</button>
                </div>
            </div>
            <input type="hidden" name="action" value="changePhoto">
        </form>

        <form method="POST" action="profile/settings" class="div-structure">
            <label for="username">Username</label>
            <p>Cambia tu nombre de usuario y pulsa <strong>renombrar</strong> para cambiarlo.</p>
            <div class="div-1">
                <input name="username" type="text" placeholder="Username">
                <button class="btn-form" type="submit">Renombrar</button>
            </div>
            <input type="hidden" name="action" value="changeUsername">
        </form>

        <form method="POST" action="profile/settings" class="div-structure">
            <label for="email">Email</label>
            <p>Introduce tu correo electronico y pulsa en <strong>verificar</strong>. Una vez hecho te llegara un correo electronico para la verificacion.</p>
            <div class="div-1">
                <input name="email" type="email" placeholder="Email">
                <button class="btn-form" type="submit">Verificar</button>
            </div>
            <input type="hidden" name="action" value="verifyEmail">
        </form>

        <form method="POST" action="profile/settings" class="div-structure">
            <label for="email">Email</label>
            <div>
                <input name="email" type="email" placeholder="Email">
            </div>
            <label for="newEmail">Nuevo Email</label>
            <div>
                <input name="newEmail" type="email" placeholder="Nuevo Email">
            </div>
            <button class="btn-form" type="submit">Cambiar</button>
            <input type="hidden" name="action" value="changeEmail">
        </form>

        <form method="POST" action="profile/settings" class="div-structure">
            <label for="password">Password</label>
            <div>
                <input name="password" type="password" minlength="8" placeholder="Password">
            </div>
            <label for="newPassword">Nueva Password</label>
            <div>
                <input name="newPassword" type="password" minlength="8" placeholder="Nueva Password">
            </div>
            <button class="btn-form" type="submit">Cambiar</button>
            <input type="hidden" name="action" value="changePassword">
        </form>
    </section>
</body>
</html>