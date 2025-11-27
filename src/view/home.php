<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Con ♥️ y PHP</title>
    <base href="<?= BASE_URL ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="./styles/navigation.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/_pagination_buttons.css">
    <script defer src="./js/PaginationData.js"></script>
</head>
<body>
    <h1>PHProgramando</h1>
    
    <nav>
        <ul>
            <li><a href=""><button>Home</button></a></li>
            <li><a href="login"><button>Login</button></a></li>
            <li><a href="register"><button>Register</button></a></li>
            <li><a href="profile"><button>Profile</button></a></li>
            <li><a href="profile/settings"><button>Profile/Settings</button></a></li>
            <li><a href="profile/create"><button>Create Reco</button></a></li>
            <li><a href="login/forgot-password"><button>Passoword</button></a></li>
            <li><a href="admin/users"><button>Admin Users</button></a></li>
        </ul>
    </nav>

    <section class="feed_search">
        <input id="search" class="filter" type="search" placeholder="Encuentra a tu autor favorito">
        <select id="sentido" class="filter">
            <option value="asc">ASC</option>
            <option value="desc" selected>DESC</option>
        </select>
    </section>

    <section id="lista_posts"></section>
</body>
</html>