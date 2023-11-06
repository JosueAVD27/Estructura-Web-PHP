document.addEventListener("DOMContentLoaded", function () {
    const main1 = document.getElementById("main1");
    const main2 = document.getElementById("main2");
    const toggleButton1 = document.getElementById("toggleButton1");
    const toggleButton2 = document.getElementById("toggleButton2");
    let isAnimating = false;

    // Función para realizar la animación de las tarjetas
    function toggleCards(mainFrom, mainTo) {
        if (!isAnimating) {
            isAnimating = true;

            mainFrom.classList.remove("created");
            mainFrom.classList.add("dismissed");
            mainTo.classList.remove("dismissed");
            mainTo.classList.add("created");

            setTimeout(function () {
                mainFrom.style.display = "none";
                mainTo.style.display = "block";
                isAnimating = false;
            }, 500); // Ajusta este valor al tiempo de duración de la animación en milisegundos
        }
    }

    toggleButton1.addEventListener("click", function () {
        toggleCards(main1, main2);
        obtenerPaises_activos();
        validacionPaisCampos();
    });

    toggleButton2.addEventListener("click", function () {
        toggleCards(main2, main1);
    });
});