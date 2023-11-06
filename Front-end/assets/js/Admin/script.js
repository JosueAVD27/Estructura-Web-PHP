document.addEventListener("DOMContentLoaded", function () {

    // Local storage
    var storedState = localStorage.getItem('sidebarState');

    // Const
    const sidebar = document.getElementById('sidebar');
    const nav = document.getElementById('nav');
    const title_page = document.getElementById('title_page_sidebar');
    const allSideDivider = document.querySelectorAll('#sidebar .divider');
    const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
    const dropdownLinks = document.querySelectorAll('#sidebar .side-dropdown a:first-child');
    const toggleSidebarButton = document.querySelector('nav .toggle-sidebar');
    const scrollTopButton = $("#btn_top");
    const profileImage = document.querySelector('nav .profile img');
    const profileDropdown = document.querySelector('nav .profile .profile-link');

    const toggleBtn = document.getElementById('toggleBtn');
    const notificationsContainer = document.getElementById('notificationsContainer');
    const icono = document.getElementById('icono_notificacion');
    const contenedorNotificacion = document.querySelector('.contenedor_notificacion');

    // Obtener la ruta exacta
    const currentUri = window.location.href;
    const currentUrl = window.location.pathname;
    const url = currentUri.substring(currentUrl.length);
    const domain = window.location.origin;
    const url_x = currentUri.substring(url.length);
    const URL = domain + url_x;

    function showDropdownText() {
        allSideDivider.forEach(item => {
            item.textContent = '-';
            title_page.style.display = 'none';

            allDropdown.forEach(i => {
                const aLink = i.parentElement.querySelector('a:first-child');
                aLink.classList.remove('active');
                i.classList.remove('show');
            })
        });
    }

    function showOriginalDropdownText() {
        allSideDivider.forEach(item => {
            item.textContent = item.dataset.text;
            title_page.style.display = 'grid';

        });
    }

    function toggleProfileDropdown() {
        profileDropdown.classList.toggle('show');
    }

    function activateLinks(selector) {
        const links = document.querySelectorAll(selector);
        links.forEach(link => {
            const linkUrl = link.getAttribute("href");

            if (URL === linkUrl) {
                link.classList.add("active");
                link.closest("li").classList.add("active");
            }
        });
    }

    // Redimencionar sidebar por ancho de la patanlla
    function checkWidth() {
        if (window.innerWidth <= 800) {
            sidebar.classList.add("hide");
            title_page.style.display = 'none';
            showDropdownText();
            toggleSidebarButton.innerHTML = '<i class="bx bx-menu-alt-left"></i>';
            nav.style.marginLeft = '70px';
        } else {
            sidebar.classList.remove("hide");
            showOriginalDropdownText();
            toggleSidebarButton.innerHTML = '<i class="bx bx-menu"></i>';
            nav.style.marginLeft = '230px';
            title_page.style.display = 'grid';
        }
    }

    function handleScrollTop() {
        $("html, body").animate({ scrollTop: 0 }, 800);
        return false;
    }

    function handleDropdownClick(event) {

        const clickedItem = this;
        const allDropdowns = document.querySelectorAll('#sidebar .side-dropdown');

        allDropdowns.forEach(item => {
            const aLink = item.parentElement.querySelector('a:first-child');

            if (aLink !== clickedItem) {
                aLink.classList.remove('active');
                item.classList.remove('show');
            }
        });

        clickedItem.classList.toggle('active');
        const dropdown = clickedItem.parentElement.querySelector('.side-dropdown');
        dropdown.classList.toggle('show');
    }

    // Eventos
    dropdownLinks.forEach(link => {
        link.addEventListener('click', handleDropdownClick);
    });

    allDropdown.forEach(item => {
        const a = item.parentElement.querySelector('a:first-child');
        a.addEventListener('click', function (e) {
            e.preventDefault();

            if (!this.classList.contains('active')) {
                allDropdown.forEach(i => {
                    const aLink = i.parentElement.querySelector('a:first-child');

                    aLink.classList.remove('active');
                    i.classList.remove('show');
                })
            }

            this.classList.toggle('active');
            item.classList.toggle('show');
        })
    });

    sidebar.addEventListener('mouseenter', function () {
        if (this.classList.contains('hide')) {
            showOriginalDropdownText();
        }
    });

    sidebar.addEventListener('mouseleave', function () {
        if (this.classList.contains('hide')) {
            showDropdownText();
        }
    });

    // Switch de sidevar al presionar el boton
    toggleSidebarButton.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
        if (sidebar.classList.contains('hide')) {
            title_page.style.display = 'none';
            toggleSidebarButton.innerHTML = '<i class="bx bx-menu-alt-left"></i>';
            nav.style.marginLeft = '70px';
            showDropdownText();
            localStorage.setItem('sidebarState', 'hidden');
        } else {
            toggleSidebarButton.innerHTML = '<i class="bx bx-menu"></i>';
            showOriginalDropdownText();
            nav.style.marginLeft = '230px';
            localStorage.setItem('sidebarState', 'visible');
            title_page.style.display = 'grid';
        }
    });

    // Verificar si el sidebar esta en hidden o no
    function verificar_estado_sidebar(storedState) {
        if (storedState == 'hidden') {
            sidebar.classList.add('hide');
            toggleSidebarButton.innerHTML = '<i class="bx bx-menu-alt-left"></i>';
            nav.style.marginLeft = '70px';
            showDropdownText();
        } else {
            sidebar.classList.remove('hide');
            toggleSidebarButton.innerHTML = '<i class="bx bx-menu"></i>';
            nav.style.marginLeft = '230px';
            showOriginalDropdownText();
        }
    }


    // Agregar event listener para cerrar la lista cuando se hace clic fuera de ella
    document.addEventListener('click', function (event) {
        const profile = document.querySelector('.profile');
        const profileDropdown = document.querySelector('.profile .profile-link');

        if (!profile.contains(event.target)) {
            // El clic se produjo fuera del elemento .profile
            profileDropdown.classList.remove('show');
        }
    });

    profileImage.addEventListener('click', toggleProfileDropdown);

    // Boton para ir hacia arriba
    scrollTopButton.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            scrollTopButton.fadeIn();
        } else {
            scrollTopButton.fadeOut();
        }
    });
    scrollTopButton.click(handleScrollTop);

    // Activadores de navegacion
    activateLinks(".side-menu a");
    activateLinks(".contenedor_config a");
    activateLinks(".profile-link a");
    activateLinks(".more-button-list a");

    checkWidth();
    window.addEventListener("resize", checkWidth);


    // Boton de notificaciones
    function updateState() {
        // Verifica el estado almacenado en localStorage
        const isContainerVisible = localStorage.getItem('notificationsContainerVisible') === 'true';
        const isIconBxs = localStorage.getItem('iconIsBxs') === 'true';

        // Configura la visibilidad del contenedor
        notificationsContainer.style.display = isContainerVisible ? 'block' : 'none';

        // Configura el icono y el estilo del contenedor
        if (isIconBxs) {
            icono.classList.add('bxs-bell');
            icono.classList.remove('bx-bell');
            contenedorNotificacion.classList.add('active');
        } else {
            icono.classList.add('bx-bell');
            icono.classList.remove('bxs-bell');
            contenedorNotificacion.classList.remove('active');
        }
    }

    updateState(); // Llama a la función al cargar la página para inicializar el estado

    toggleBtn.addEventListener('click', function () {
        // Toggle la visibilidad del contenedor
        const isContainerVisible = notificationsContainer.style.display === 'none';
        notificationsContainer.style.display = isContainerVisible ? 'block' : 'none';
        localStorage.setItem('notificationsContainerVisible', isContainerVisible.toString());

        // Toggle el icono y el estilo del contenedor
        const isIconBxs = icono.classList.contains('bxs-bell');
        if (isIconBxs) {
            icono.classList.remove('bxs-bell');
            icono.classList.add('bx-bell');
            contenedorNotificacion.classList.remove('active');
        } else {
            icono.classList.remove('bx-bell');
            icono.classList.add('bxs-bell');
            contenedorNotificacion.classList.add('active');
        }
        localStorage.setItem('iconIsBxs', (!isIconBxs).toString());
    });

    // Cargar el estado almacenado en localStorage al cargar completamente la página
    window.addEventListener('load', function () {
        var storedState = localStorage.getItem('sidebarState');
        verificar_estado_sidebar(storedState);
    });
});


