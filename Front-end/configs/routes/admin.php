<?php
// Variables
$inicio_admin = 'admin';
$Users ='admin/usuarios';

// Designacion de rutas
$adminRoutes = [
    '/' . $inicio_admin => 'views/Admin/home/index.php',
    '/' . $Users => 'views/Admin/user/index.php',
];