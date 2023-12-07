
//metodo para prodcutos
let ip_cotizar = document.getElementById('cotizacion');
// console.log(ip_cotizar);
//creando evento para el input de biuscar\
ip_cotizar.addEventListener("input", (e) => {
    e.preventDefault();
    //     //limpiar la lista
    // console.log('llegue en buscador prducots');
    //     //console.log(e.target);

    let token = document.querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    let valor = e.target.value;
    let antes = document.getElementById('antes').value;
    // console.log('antes'+antes);
    let minimo_letras = 1;

    if (valor.length >= minimo_letras) {
        //creando un formulario
        let Formulario = new FormData();
        Formulario.append("valor", valor);
        Formulario.append("antes", antes);
        fetch("/existeCotizar", {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: Formulario,
        }).then((data) => data.json())
            .then((data) => {
                // console.log(data.result)
                let xd = document.getElementById('p_cotizar_existe');
                if (data.result) {
                    // let xd =document.getElementById('p_proveedor');
                    xd.className = "text-red-500 text-xs px-1 pt-1.5 font-semibold rounded-xl  w-max";
                    xd.textContent = ('*Este Nro. de Cotizacion ya existe');
                    vali.nro_coti = false;
                } else {
                    xd.innerHTML = '';
                    xd.className = "";
                    vali.nro_coti = true;
                }

            }).catch(function (error) {
                //  console.error("Error: ", error);
                // console.log('entre a error')
                // let xd =document.getElementById('ListaProductos');
                // xd.innerHTML = "";

            });
    } else {
        // console.log('es meonr de 2 ');
    }

});






