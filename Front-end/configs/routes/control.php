<?php
// Variables
$login_admin = 'administrador';
$login_user = 'login';
$Profile = 'perfil';
$Error_404 = '404';
$Logout = 'logout';

// Designacion de rutas
$controlRoutes = [
    '/' . $login_admin => 'views/Auth/admin.php',
    '/' . $login_user => 'views/Auth/user.php',
    '/' . $Profile => 'views/Account/user_profile.php',
    '/' . $Error_404 => 'views/Error/404.php',
    '/' . $Logout => 'configs/global/logout.php',
];