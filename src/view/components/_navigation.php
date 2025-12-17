<?php

use App\Controller\AuthController;

$authService = AuthController::getAuthService();
$isLogged = $authService ? $authService->isAuthenticated() : false;
$currentUser = $isLogged ? $authService->getCurrentUser() : null;
?>
<link rel="stylesheet" href="./styles/_navigation.css">
<script defer src="./js/Navigation.js"></script>
<aside id="navigation" class="nav_aside">
    <ul class="nav_list">
        <li><a href=""><button>Home</button></a></li>
        <li><a href="login/forgot-password"><button>Passoword</button></a></li>
        <li><a href="admin/users"><button>Admin Users</button></a></li>
    </ul>
    <?php if(!$isLogged): ?>
    <footer class="footer_user">
        <div class="footer_user_content">
            <img class="footer_user_img" src="./assets/moai.jpg" alt="Foto de perfil">
            <p class="footer_user_username">Inicia sesion</p>
        </div>
        
        <div class="footer_dropdown">
            <ul class="footer_dropdown_menu">
                <li><a href="login"><button>Login</button></a></li>
                <li><a href="register"><button>Register</button></a></li>
            </ul>
        </div>
    </footer>
    <?php else: ?>
    <footer class="footer_user">
        <div class="footer_user_content">
            <img class="footer_user_img" src="https://ih1.redbubble.net/image.5195043568.7951/st,small,507x507-pad,600x600,f8f8f8.jpg" alt="Foto de perfil">
            <p class="footer_user_username"><?= $currentUser->username ?></p>
        </div>
        
        <div class="footer_dropdown">
            <ul class="footer_dropdown_menu">
                <li><a href="profile"><button>Mi Perfil</button></a></li>
                <li><a href="profile/settings"><button>Configuración</button></a></li>
            </ul>
        </div>
    </footer>
    <?php endif; ?>
</aside>