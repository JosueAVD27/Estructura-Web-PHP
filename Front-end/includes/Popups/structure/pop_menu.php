<div id="overlay" class="overlay overlay_menu"></div>
<div id="pop_menu" class="modal">
    <button id="btnCerrarModal_menu" class="menu-toggle"><i class="bx bx-x"></i></button>
    <div class="content">
        <div id="contenedor_menu">
            <ul class="nav_menu_movil">
                <?php foreach ($menu_principal as $menu) { ?>
                    <li><a class="nav-item-movil" href="<?= RUTA . $menu['url'] ?>"><?= $menu['name'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>