
//metodo para prodcutos
let inp_code = document.getElementById('cod_oem');
//console.log(inp_code);
//creando evento para el input de biuscar\
inp_code.addEventListener("input", (e) => {
    e.preventDefault();
    //limpiar la lista
    console.log('llegue en buscador prducots');
    //console.log(e.target);

    let token = document.querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
    let valor = e.target.value;
    let minimo_letras = 2;

        if (valor.length > minimo_letras) {
        //creando un formulario
            let Formulario = new FormData();
            Formulario.append("valor", valor);
            fetch("/ExisteProducto", {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: Formulario,
            })  .then((data) => data.json())
                .then((data) => {
                    console.log(data.result)
                    let xd =document.getElementById('p_pruducto_existe');
                    if (data.result) {
                       // let xd =document.getElementById('p_proveedor');
                        xd.className =  "text-red-500 text-xs px-1 pt-1.5 font-semibold rounded-xl  w-max";
                        xd.textContent = ('*Este registro ya existe');
                    }else{
                        xd.innerHTML='';
                        xd.className =  "";
                        }

                }).catch(function (error) {
                        console.error("Error: ", error);
                        console.log('entre a error')
                        // let xd =document.getElementById('ListaProductos');
                        // xd.innerHTML = "";

                });
        } else {
              console.log('es meonr de 2 ');
             }

});


//metodo para prodcutos
let inp_alt = document.getElementById('cod_producto');
//console.log(inp_code);
//creando evento para el input de biuscar\
inp_alt.addEventListener("input", (e) => {
    e.preventDefault();
    //limpiar la lista
    console.log('llegue en buscador prducots');
    console.log(e.target);

    let token = document.querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
    let valor = e.target.value;
    let minimo_letras = 2;

        if (valor.length > minimo_letras) {
        //creando un formulario
            let Formulario = new FormData();
            Formulario.append("valor", valor);
            fetch("/ExisteProducto", {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: Formulario,
            })  .then((data) => data.json())
                .then((data) => {
                    console.log(data.result)
                    let xd =document.getElementById('p_prud_alterno_existe');
                    if (data.result) {
                       // let xd =document.getElementById('p_proveedor');
                        xd.className =  "text-red-500 text-xs px-1 pt-1.5 font-semibold rounded-xl  w-max";
                        xd.textContent = ('*Este registro ya existe');
                    }else{
                        xd.innerHTML='';
                        xd.className =  "";
                        }

                }).catch(function (error) {
                        console.error("Error: ", error);
                        console.log('entre a error')
                        // let xd =document.getElementById('ListaProductos');
                        // xd.innerHTML = "";

                });
        } else {
              console.log('es meonr de 2 ');
             }

});


