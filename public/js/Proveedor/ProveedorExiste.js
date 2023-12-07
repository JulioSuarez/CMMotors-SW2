let inp_nit = document.getElementById("nit_buscar");

//creando evento para el input de biuscar\
inp_nit.addEventListener("input", (e) => {
    e.preventDefault();
    //limpiar la lista

    let token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    let valor = e.target.value;
    let minimo_letras = 2;

    if (valor.length > minimo_letras) {
        //creando un formulario
        let Formulario = new FormData();
        Formulario.append("valor", valor);
        fetch("/ExisteProveedor", {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: Formulario,
        })
            .then((data) => data.json())
            .then((data) => {
                console.log("entre al fecht");
                console.log(data.result);
                let xd = document.getElementById("p_proveedor_existe");
                if (data.result) {
                    // let xd =document.getElementById('p_proveedor');
                    xd.className =
                        "text-red-500 text-xs px-1 pt-1.5 font-semibold rounded-xl  w-max";
                    xd.textContent = "*Este registro ya existe";
                } else {
                    xd.innerHTML = "";
                    xd.className = "";
                }
            })
            .catch(function (error) {
                console.error("Error: ", error);
                console.log("entre a error");
                // let xd =document.getElementById('ListaProductos');
                // xd.innerHTML = "";
            });
    } else {
        console.log("es meonr de 2 ");
    }
});
