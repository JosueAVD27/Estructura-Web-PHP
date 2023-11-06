<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Estilos generales -->
    <?php require_once 'includes/Design/Admin/head.php'; ?>

    <!-- Estilos propios -->
    <link href="<?= RUTA ?>assets/css/Admin/home.css" rel="stylesheet">

    <title>Inicio</title>
</head>

<body>
    <!-- SIDEBAR -->
    <?php require_once 'includes/Design/Admin/sidebar.php'; ?>

    <section id="content">
        <!-- NAVBAR -->
        <?php require_once 'includes/Design/Admin/navbar.php'; ?>

        <!-- MAIN -->
        <main>
            <h1 class="title">Administración</h1>
            <ul class="breadcrumbs">
                <li><a href="#" class="active">Inicio</a></li>
            </ul>

            <div class="general_contenedor">
                <div class="info-data">
                    <div class="contenedor_perfil">
                        <div class="contenedor_subtitulo_pagina">
                            <h3></h3>
                        </div>
                        <div class="perfil">



                        </div>
                    </div>
                </div>
            </div>

        </main>
    </section>
</body>

</html>