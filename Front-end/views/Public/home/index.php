<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Estilos generales -->
    <?php require_once 'includes/Design/Public/head.php'; ?>

    <!-- Estilos propios -->
    <link href="<?= RUTA ?>assets/css/Admin/home.css" rel="stylesheet">
    <title>Inicio</title>
</head>

<body>
    <!-- SIDEBAR -->
    <?php require_once 'includes/Design/Public/sidebar.php'; ?>

    <section id="content">
        <!-- NAVBAR -->
        <?php require_once 'includes/Design/Public/navbar.php'; ?>

        <!-- MAIN -->
        <main>
            <h1 class="title">Inicio</h1>
            <ul class="breadcrumbs">
                <li><a href="#" class="active">Inicio</a></li>
            </ul>

            <div class="general_contenedor">
                <div class="info-data">
                    <div class="contenedor_perfil">
                        <div class="contenedor_subtitulo_pagina">
                            <h3>Cuerpo</h3>
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