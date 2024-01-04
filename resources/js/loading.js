//funcion para el boton de exportar excel de la vista index de productos
document
    .getElementById("exportButton")
    .addEventListener("click", function (event) {
        // Obtén una referencia al div de la pantalla de espera
        var loadingScreen = document.getElementById("loadingScreen");
        console.log("hola mundo");
        // Muestra la pantalla de espera
        loadingScreen.style.display = "flex"; // Muestra la pantalla y su contenido

        // Deshabilita el botón
        this.classList.add("disabled");
        this.disabled = true;
        this.style.backgroundColor = "gray"; // Cambia el color a gris

        // Redirige a la ruta de exportación Excel
        // window.location.href = '{{ route('exportar.producto.view') }}';
        fetch("/inf513/grupo07sa/proyecto2/public/exportar/producto/view")
        .then((response) => {
                console.log("hola xD");
                if (response.ok) {
                    // Habilita el botón y restaura el color original cuando la solicitud se complete

                    // Oculta la pantalla de espera
                    loadingScreen.style.display = "none";

                    // Habilita el botón y restaura el color original
                    document
                        .getElementById("exportButton")
                        .classList.remove("disabled");
                    document.getElementById("exportButton").disabled = false;
                    document.getElementById(
                        "exportButton"
                    ).style.backgroundColor = ""; // Restaura el color original
                }
            })
            .catch((error) => {
                console.error(error);
            });

        // setTimeout(function() {
        //     // Oculta la pantalla de espera
        //     loadingScreen.style.display = 'none';

        //     // Habilita el botón y restaura el color original
        //     document.getElementById('exportButton').classList.remove('disabled');
        //     document.getElementById('exportButton').disabled = false;
        //     document.getElementById('exportButton').style.backgroundColor =
        //         ''; // Restaura el color original
        // }, 5000); // Simula un proceso de 5 segundos
        // Evita que el botón siga su curso normal
        event.preventDefault();
    });
