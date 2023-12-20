const expresion = {
    ci_cliente: /^\d{4,20}$/,
    // nit: /^\d{5,30}$/,
    // usuario: /^[a-zA-Z0-9\_\-]{1,16}$/, // Letras, numeros, guion y guion_bajo
    // cliente: /^[a-zA-ZÀ-ÿ0-9\s]{1,255}$/, // Letras y espacios, pueden llevar acentos.
    cliente: /^[a-zA-ZÀ-ÿ0-9\s\-_.,]{1,255}$/, // Letras y espacios, pueden llevar acentos.
    telefono: /^\d{7,14}$/, // 7 a 14 numeros.
};

//estados
//no_s_escribio, false, true
const vali = {
    ci_cliente: 'no_s_escribio',
    cliente: 'no_s_escribio',
    telefono: true,
    nro_coti: true,
}


const errors_mensajes = {
    ci_cliente: "*El carnet debe ser minimo de 4 digitos",
    // nit: /^\d{5,30}$/,
    // usuario: /^[a-zA-Z0-9\_\-]{1,16}$/, // Letras, numeros, guion y guion_bajo
    cliente: "*Solo se permite letras, numeros y espacios, pueden llevar acentos, guiones,puntos y comas.", // Letras y espacios, pueden llevar acentos.
    telefono: "*Solo numeros, minimo 7 digitos", // 7 a 14 numeros.
};

let input_nombre = document.getElementById('cliente');
let input_telefono = document.getElementById('telefono');

const ExisteCliente2 = (input) => {
    //     // let nombre_imp = e.target.name;
    console.log('llegue a existre cliente');
    let valor = input.value;
    let token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    // let valor = e.target.value;
    let minimo_letras = 4;

    if (valor.length >= minimo_letras) {
        //creando un formulario
        let Formulario = new FormData();
        Formulario.append("valor", valor);
        fetch("/Existe_Cliente", {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: Formulario,
        })
            .then((data) => data.json())
            .then((data) => {
                // console.log('FECTH DEVUEL: '+data.result);
                if (data.result) {

                    input_nombre.value = data.clientes.nombre;
                    input_telefono.value = data.clientes.telefono;
                    // input_nombre.className = 'mt-0 mb-1 text-gray-600 outline-none focus:border-black  font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border capitalize'
                    input_telefono.className = 'mt-0 mb-1 text-gray-600 outline-none focus:border-black  font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border';
                    document.getElementById('cliente_error').innerHTML = '';
                    // vali.ci=false;
                    // console.log(input_nombre.value)
                    // buscar(valor);
                    vali.cliente = true;
                    vali.telefono = true;
                    // console.log('se cambio a truee los datos')

                } else {
                    input_nombre.value = '';
                    input_telefono.value = '';
                    vali.cliente = false;
                    vali.telefono = true;
                }
            })
            .catch(function (error) {
                // console.log("entre a catch,no se leyo la api o ruta");
            });
    } else {
        // console.log("es meonr de 1 ");
        // verificar(nombre_imp, false, true);
    }

}

const validaciones = (input) => {
    //verificar si esta bien escrito
    let mensaje = document.getElementById(input.name + '_error');
    let div_ip_cliente = document.getElementById('div_ip_cliente');
    if (input.value == '') {
        if (input.name == 'ci_cliente') {

            input.className = 'outline-none border-red-600 outline-none  text-gray-500 pl-16  text-sm rounded border font-normal w-full h-8 items-center ';
            mensaje.textContent = 'Obligatorio';
            vali[input.name] = false;
        } else {
            if (input.name == 'cliente') {
                // input.className = 'mt-0 mb-1 text-gray-600 border-red-600 outline-none  font-normal w-full h-8 flex items-center pl-3 text-sm  rounded border capitalize'
                // if(div_ip_cliente.classList.contains('border-gray-300')) {
                //     console.log('si esta dentro');
                //     div_ip_cliente.classList.remove('border-gray-300');
                //     div_ip_cliente.classList.add('border-red-600');
                //     console.log(div_ip_cliente);
                // }else{
                //     console.log('no estamod ')
                // }
                console.log('entre por cliente igual a cliente');
                mensaje.textContent = 'Obligatorio';
                vali[input.name] = false;
            } else {
                input.className = 'mt-0 mb-1 text-gray-600 outline-none focus:border-black  font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border capitalize ';
                mensaje.textContent = '';
                vali[input.name] = true;
            }

        }
    } else { //si no esta vacio
        if (expresion[input.name].test(input.value)) { //esta bien escrito???
            //cambair el border a normal gray
            // console.log('ESTA BIEN ESCRITO ');
            vali[input.name] = true;
            if (input.name == 'ci_cliente') {
                input.className = 'outline-none focus:border-black  text-gray-500 pl-16  text-sm border-gray-300 rounded border font-normal w-full h-8 items-center '
                ExisteCliente2(input)
            } else {
                if (input.name == 'cliente') {
                    // if(div_ip_cliente.classList.contains('border-gray-300')) {
                    //     div_ip_cliente.classList.remove('border-gray-300');
                    // div_ip_cliente.classList.add('border-red-600');
                    // }
                } else {
                    input.className = 'mt-0 mb-1 text-gray-600 outline-none focus:border-black  font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border capitalize ';
                }
            }
            mensaje.textContent = '';

        } else {
            // console.log('MAL ESCRITO');
            vali[input.name] = false;
            if (input.name == 'ci_cliente') {
                input.className = 'outline-none border-red-600 outline-none  text-gray-500 pl-16  text-sm rounded border font-normal w-full h-8 items-center '
                input_nombre.value = '';
                input_telefono.value = '';


            } else {
                console.log('mal escrito');
                input.className = 'mt-0 mb-1 text-gray-600 border-red-600 outline-none  font-normal w-full h-8 flex items-center pl-3 text-sm  rounded border capitalize';
                // mensaje.textContent = errors_mensajes[input.name];
                //  vali[inp_nombre]=false;
            }
            mensaje.textContent = errors_mensajes[input.name];
        }
    }
}




const forms_inputs = document.querySelectorAll("#form input");
// console.log(forms_inputs);
forms_inputs.forEach((input) => {
    if (input.name == "ci_cliente" || input.name == "cliente" || input.name == "telefono") {
        // console.log(input.name);
        //a cada input se le crea un evento
        input.addEventListener("keyup", (e) => {
            //se enviar nombre del input y el valor
            // console.log(e.target);
            validaciones(e.target)


        });
    }
});



const marcarInputsEnRojo = (inp_name, id) => {
    id = sacarNum(id);
    switch (inp_name) {
        case "cod_oem[]":
            document.getElementById('td_code_' + id).className = 'border-2 border-red-600';
            break;
        case "cantidad[]":
            document.getElementById('td_cantidad_' + id).className = 'border-2 border-red-600';
            break;
        case "precio[]":
            document.getElementById('td_precio_' + id).className = 'border-2 border-red-600';
            break;
    }
}


const verificarInpusTablas = (inp_name, fila, id, e) => {
    id = sacarNum(id);
    // console.log('entre al swhit y saqeu la id:'+id)
    switch (inp_name) {
        case "cod_oem[]":
            // console.log('llegeu a codigo code_oem')
            if (valiCode_oem[id] == false) {
                e.preventDefault();
                mostrarMensaje('Error: no se encontro producto en COD_OEM de la fila ' + fila);
                document.getElementById('td_code_' + id).className = 'border-2 border-red-600';
            }
            break;
        case "cantidad[]":
            // console.log('llegue a cantida')
            if (valiCantidad[id] == false) {
                // e.preventDefault();
                // console.log('ESTOY EN CANTIDA VERIFICAR')
                // console.log(erroMensajeCantidad[id])
                mostrarMensaje(erroMensajeCantidad[id]);
                document.getElementById('td_cantidad_' + id).className = 'border-2 border-red-600';
            }
            break;
        case "precio[]":
            // console.log('llegue a precio')
            if (valiPrecio[id] == false) {
                e.preventDefault();
                mostrarMensaje('Precio vacio o cero en la fila ' + fila);
            }
            break;
    }
};


const mostrarMensaje = (mensaje) => {
    let div_error = document.getElementById('error_validacion');
    let divXD = document.createElement('div');
    divXD.className = 'flex flex-row-reverse px-5';
    divXD.innerHTML += ' <p class="px-1 text-xs text-red-600 font-semibold  flex items-center"> ' + mensaje + ' </p> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 max-h-max p-1 text-red-600 "> <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /> </svg>';
    div_error.append(divXD)
    setTimeout(() => {
        divXD.remove();
    }, 7000);
}

const validar_input_arriba = (e) => {
    let tipo_cambio = document.getElementById('tipo_cambio');
    let inp_ci = document.getElementById('ci_autocomplete');
    let inp_senior = document.getElementById('cliente');
    // let inp_telefono = document.getElementById('telefono');
    if (isNaN(tipo_cambio.value) || tipo_cambio.value == 0) {
        e.preventDefault();
        mostrarMensaje('Error: TIPO DE CAMBIO, solo se acepta numero y punto');
        tipo_cambio.className = 'border-2 p-1 border-red-600 rounded text-xs text-center text-gray-900  mx-5  mb-3 outline-none';
    }
    if (inp_ci.value == '') {
        e.preventDefault();
        let mensaje = document.getElementById('ci_cliente_error');
        mensaje.textContent = '*Obligatorio';
        inp_ci.className = 'mt-0 mb-1 text-gray-600 outline-none focus:border-black  font-normal w-full h-8 flex items-center pl-3 text-sm border-red-600 rounded border capitalize'
    }
    if (inp_senior.value == '') {
        e.preventDefault();
        let mensaje = document.getElementById('cliente_error');
        mensaje.textContent = '*Obligatorio';
        inp_senior.className = 'mt-0 mb-1 text-gray-600 outline-none focus:border-black  font-normal w-full h-8 flex items-center pl-3 text-sm border-red-600 rounded border capitalize'

    }

}


const existeNro_coti = (inpNroCoti, e) => {
    // console.log('en existe xoit')
    // console.warn(e)
    let token = document.querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    let minimo_letras = 1;
    let valor = inpNroCoti.value;
    let estado_nro_coti = false;

    if (valor.length >= minimo_letras) {
        //creando un formulario
        let Formulario = new FormData();
        Formulario.append("valor", valor);
        fetch("/existeCotizar", {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: Formulario,
        }).then((data) => data.json())
            .then((data) => {
                // console.log('llegeu a l error');
                // console.log(data.result)
                if (data.result) {
                    // console.warn(e)
                    e.preventDefault();
                    // console.log('se debia detener')
                    let xd = parseInt(valor) + 1;
                    mostrarMensaje('El Nro Cotizacion ' + valor + ' ya fue usado por otro empleado, se le asigno el nuevo Nro Cotiacion ' + xd);
                    inpNroCoti.value = xd;
                    document.getElementById('p_cotizar_existe').innerHTML = '';
                    estado_nro_coti = true;
                    // console.log('hice el cabmmio a true')
                    // console.log(estado_nro_coti);
                } else {
                    // console.log('bien, mensaje')

                }

            }).catch(function (error) {
                //  console.error("Error: ", error);
                // console.log('entre a error')
                // let xd =document.getElementById('ListaProductos');
                // xd.innerHTML = "";

            });
    } else {
        // console.log('es meonr de 1 ');
    }

    // if (estado_nro_coti) {
    //     console.log('entre a ejecutar edtener pantlal');
    //     e.preventDefault();
    // }

}

let form = document.getElementById('form');
// console.warn(form)

form.addEventListener('submit', (e) => {
    // e.preventDefault();

    console.warn('LE DI CLICK AL FORM')
    // console.warn('la utliam pos es  :' + ulitmaPos())
    //limio el la caja de mensaje de error
    document.getElementById('error_validacion').innerHTML = '';
    validar_input_arriba(e); //validar los caja de arriba
    if (ulitmaPos() > 0) {  //para saber que al menos haya un caja
        let inputs = document.querySelectorAll('#tabla input')
        // console.log(inputs)
        inputs.forEach(input => {
            //   console.log(input.name)
            if (input.name == 'cod_oem[]' || input.name == 'cantidad[]' || input.name == 'precio[]') {
                // console.log('entre!! con '+input.name)
                // console.log(input.value)
                let fila = enQuePosicionEstoy(input.id); //posicino en la que estoy verificando
                let inp = (input.name.substring(0, input.name.length - 2)).toUpperCase(); //nombre de input
                // console.log(fila,inp)

                if (input.value == "" || input.value == 0) {
                    // console.warn('el' +input.id+'esta vacio o es cero')
                    //mostrar mensajes de vacioo
                    //no se permiten valores vacio en el code oem fila 1
                    e.preventDefault();
                    mostrarMensaje('Error: ' + inp + ' de la fila ' + fila + ' no puede estar vacia o en 0');
                    marcarInputsEnRojo(input.name, input.id)
                } else {
                    //hay letras, preguntar si se encontro el producto!!
                    // valiCode_oe[c] = false;
                    console.log('no es vacio hay letras')
                    console.log(valiCode_oem)
                    console.log(valiCantidad)
                    console.log(valiPrecio)
                    verificarInpusTablas(input.name, fila, input.id, e)

                }
            }

        });
    } else {
        mostrarMensaje('ERROR: SELECCIONE AL MENOS UN PRODUCTO');
    }
    // let nrp_coti = document.getElementById('cotizacion');
    // console.warn(e)
    // console.log('hice la oregunta')
    //hacer cuando se este en la vista cotiacion
    //  existeNro_coti(nrp_coti, e);
    // console.log(vali)
    if (vali.nro_coti == false) {
        e.preventDefault();
        mostrarMensaje('El numero de cotizacion ya existe!!!')
    }

});

