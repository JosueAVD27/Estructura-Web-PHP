<section id="sidebar">
    <a href="<?= RUTA ?>" class="brand">
        <img class="logo_site" src="<?= RUTA ?>assets/img/logo/logoJosue.png" alt="Logo">
        <div class="title_text" id="title_page_sidebar">
            <p><?= $G_nombre_sito ?></p>
        </div>
    </a>

    <ul class="side-menu">

        <li><a href="<?= RUTA . $inicio ?>" class="sidebar_inicio"><i class='bx bxs-dashboard icon'></i> Inicio</a></li>


        <li class="divider" data-text="más">Más</li>
        <div class="contenedor_config">
            <li><a href="<?= RUTA . $Logout ?>"><i class='bx bx-log-out icon salir'></i> Salir</a></li>
        </div>

    </ul>
</section>