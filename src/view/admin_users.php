<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <base href="/LoginPHP/public/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/admin_users.css">
</head>
<body>
    <h1>Admin de usuarios</h1>
    <section>
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Lock / Unlock</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form method="POST" action="admin/users">
                        <td>Username</td>
                        <td>email@email.email</td>
                        <td>user</td>
                        <td>0</td>
                        <td>
                            <button class="lock" name="action" value="block" type="submit">
                                <img src="./assets/block.png" alt="Bloquear usuario">
                            </button>
                        </td>
                        <td>
                            <button class="delete" name="action" value="delete" type="submit">
                                <img src="./assets/delete.png" alt="Eliminar usuario">
                            </button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <form method="POST" action="admin/users">
                        <td>Username</td>
                        <td>email@email.email</td>
                        <td>moderator</td>
                        <td>1</td>
                        <td>
                            <button class="lock" name="action" value="block" type="submit">
                                <img src="./assets/block.png" alt="Bloquear usuario">
                            </button>
                        </td>
                        <td>
                            <button class="delete" name="action" value="delete" type="submit">
                                <img src="./assets/delete.png" alt="Eliminar usuario">
                            </button>
                        </td>
                    </form>
                </tr>
                <tr>
                    <form method="POST" action="admin/users">
                        <td>Username</td>
                        <td>email@email.email</td>
                        <td>admin</td>
                        <td>1</td>
                        <td>
                            <button class="lock" name="action" value="block" type="submit">
                                <img src="./assets/block.png" alt="Bloquear usuario">
                            </button>
                        </td>
                        <td>
                            <button class="delete" name="action" value="delete" type="submit">
                                <img src="./assets/delete.png" alt="Eliminar usuario">
                            </button>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </section>
</body>
</html>