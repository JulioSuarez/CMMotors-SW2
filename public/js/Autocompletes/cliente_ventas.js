
//poner en variables los compoentes de html que se usarar

let contadorItem = 1;
let tipo_cambio = document.getElementById('tipo_cambio');

//esto cambia el buscador de navegador para poder usarlo en create ventas
let inp_conf = document.getElementById('verificarVentasCreate');
inp_conf.value = contadorItem;




//-----------------------------------------------------------------------
arrayMonto = [];
valiCode_oem = [];
valiCantidad = [];
valiPrecio = [];

erroMensajeCantidad = [];
// arrayCantidad = [];
let ventana = document.getElementById('verificar_solo_vista_Cotizacion').value;

const cambiarCantidadVali = () => {
    // let ventana = document.getElementById('verificar_solo_vista_Cotizacion').value;
    if (ventana == 'pasarA_Venta') {
        let men = document.querySelectorAll('.men')

        for (let m = 0; m < men.length; m++) {
            // console.log('hla: '+ men[m].value);
            if (men[m].value != '') {
                valiCantidad[m + 1] = false;
                erroMensajeCantidad[m + 1] = 'Cantidad no disponible!! ';
            } else {
                valiCantidad[m + 1] = true;
            }
        }
    }
}
cambiarCantidadVali();


//cereaciones de eventos para la acciones que se hagan
const crearEventListeners = (c) => {
    arrayMonto[c - 1] = 0;
    valiCode_oem[c] = true;   //qeu este bien escrito
    // valiCantidad[c] = true;   //que haay cantidad disponible
    valiPrecio[c] = true;
    //por que se lo crea en null??
    if (valiCantidad[c] == null)
        valiCantidad[c] = true;

    // console.log( valiCantidad);



    // arrayCantidad[c - 1] = 1;
    let input_cod_oem = document.getElementById('cod_oem' + c);
    let input_precio = document.getElementById('precio' + c);
    let button_eliminar = (document.getElementById('button_eliminar' + c));
    let button_sumar = (document.getElementById('button_sumar' + c));
    let button_restar = (document.getElementById('button_restar' + c));

    let input_cantidad = (document.getElementById('cantidad' + c));
    let input_subtotal = (document.getElementById('subtotal' + c));

    // console.log('se creo el evento de cod en la fila: ' + c)
    //console.log('array monot: ' + arrayMonto)
    //console.log('array cantiad: ' + arrayCantidad)

    //crear el evetno para cod_oem
    input_cod_oem.addEventListener('input', (e) => {
        //almacenar el valor que se buscara en cod
        // console.log('llegue!! al fect');
        let cod = e.target.value;
        if (cod.length >= 3) {
            //buscar nombre
            // console.log(' entre a buscador para: ' + c)
            // console.log(cod);

            // let cliente = buscar(ci);
            buscarCod(cod, c);
        } else {
            //poner false porque no se encontro producto
            valiCode_oem[c] = false;
            let ppp = document.getElementById('p_no_encontrado');
            document.getElementById('unidad_co' + c).value = 'PZA';
            ppp.innerHTML = '';
            // document.getElementById('costop'+c).value = 0
            // document.getElementById('td_code_' + i).className = 'border-2 border-red-600';
        }
    });//end evento de cod_oem

    //evento cuando haya movientos en la caja de precio
    input_precio.addEventListener('keyup', (e) => {
        //miestras se difereetes de vacio
        // console.warn('ENTRE AL EVENTO DE PRECIO');
        let precio = e.target.value;
        if (precio != 0) {
            //mostrar bordes normales
            document.getElementById('td_precio_' + c).className = 'border border-gray-300';
            valiPrecio[c] = true;
            // console.warn(arrayMonto);
            let cant = document.getElementById('cantidad' + c).value;
            precio = Number((precio * cant).toFixed(2));
            input_subtotal.value = precio;
            //  console.log('precio:'+ precio);
            // let aux = Number((arrayMonto[c - 1] - precio).toFixed(2)); // arrayMonto[c - 1] - precio;
            //   console.log('axu: '+aux);
            //   monto1 = monto1 - (aux);
            monto1 = Number((monto1 - (arrayMonto[c - 1] - precio)).toFixed(2));
            document.getElementById('monto_total').value = monto1;
            arrayMonto[c - 1] = precio;
            //  console.warn(arrayMonto);
            descuento2(tipo_cambio.value);;
        } else {
            //mostrar bordes rojos
            document.getElementById('td_precio_' + c).className = 'border-2 border-red-600';
            valiPrecio[c] = false;
            monto1 = Number((monto1 - (arrayMonto[c - 1])).toFixed(2));
            document.getElementById('monto_total').value = monto1;
            arrayMonto[c - 1] = 0;
            descuento2(tipo_cambio.value);
        }

    });//end input precio

    button_eliminar.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();
        // console.warn('ENTRE EN '+k);
        monto1 = Number((monto1 - (arrayMonto[c - 1])).toFixed(2));
        arrayMonto[c - 1] = 0;
        let trx = document.getElementById('tr' + c);
        //   console.log(trx);
        trx.remove();
        //   console.log('Eliminado Fila:'+k);
        eliminados.push(c);
        disminuir_item();
        document.getElementById('monto_total').value = monto1;
        descuento2(tipo_cambio.value);
        document.getElementById('p_no_encontrado').innerHTML = '';
    });


    //cuando haya movimiento en la cantidad
    input_cantidad.addEventListener('keyup', (e) => {
        // console.warn('EVENTO CANTIDADA');
        // console.log('Array:' + arrayMonto);
        let cant = e.target.value;
        if (cant == 0) { //rntra
            //     document.getElementById('td_cantidad_' + c).className = 'border-2 border-red-600';
            valiCantidad[c] = false;
            // console.log('entree a vacioo')
        }
        else {
            valiCantidad[c] = true;
            //volver a pintar e ncolor plomo
            document.getElementById('td_cantidad_' + c).className = 'border border-gray-300';
            verificarCantidad(input_cod_oem.value, cant, e.target.id);
        }

        // console.log('cantidad:' + cant);
        input_cantidad.value = cant;
        //multiplicar por el precio unitario
        let aux = Number((input_precio.value * cant).toFixed(2));
        // console.log('aux A=' + aux);
        input_subtotal.value = aux;
        // aux = arrayMonto[c-1] - aux;
        // console.log('axu B: '+aux);
        monto1 = Number((monto1 - (arrayMonto[c - 1] - aux)).toFixed(2));
        // console.log('total: ' + monto1);
        document.getElementById('monto_total').value = monto1;
        arrayMonto[c - 1] = aux;
        // console.log('Arrat: ' + arrayMonto)
        descuento2(tipo_cambio.value);

    });

    button_sumar.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();

        // console.warn('ENTRE EN buton sumar con posicion:' + c);
        document.getElementById('td_cantidad_' + c).className = 'border border-gray-300';
        // console.warn( arrayMonto);
        let cant = parseInt(input_cantidad.value) + 1;
        input_cantidad.value = cant;
        //multiplicar por el precio unitario
        let aux = Number((input_precio.value * cant).toFixed(2));
        //  console.log( aux);
        input_subtotal.value = aux;
        //   console.log('monto antes: '+monto1);
        monto1 = Number((monto1 - (arrayMonto[c - 1] - aux)).toFixed(2));
        //   console.log('monto despues: '+monto1);
        document.getElementById('monto_total').value = monto1;
        arrayMonto[c - 1] = aux;
        descuento2(tipo_cambio.value);;

        if (cant == 0)
            //     document.getElementById('td_cantidad_' + c).className = 'border-2 border-red-600';
            valiCantidad[c] = false;
        else {
            valiCantidad[c] = true;
            verificarCantidad(input_cod_oem.value, cant, button_sumar.id);
        }
    });

    button_restar.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();
        // console.warn('ENTRE EN buton sumar con posicion:' + c);
        document.getElementById('td_cantidad_' + c).className = 'border border-gray-300';
        //   console.warn( arrayMonto);
        let cant = parseInt(input_cantidad.value) - 1;
        if (cant > 0) {
            input_cantidad.value = cant;
            let aux = Number((input_precio.value * cant).toFixed(2));
            input_subtotal.value = aux;
            //    console.log( aux);
            monto1 = Number((monto1 - (arrayMonto[c - 1] - aux)).toFixed(2));
            document.getElementById('monto_total').value = monto1; //Number(monto1.toFixed(2));
            arrayMonto[c - 1] = aux;
            descuento2(tipo_cambio.value);;
            if (cant == 0)
                valiCantidad[c] = false;
            else {
                valiCantidad[c] = true;
                verificarCantidad(input_cod_oem.value, cant, button_restar.id);
            }



        }
    }); //end boton restar

    //creando evetnos para el boton model
    let bt_abrir_modal = document.getElementById('bt_abrir_modal' + c);
    bt_abrir_modal.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();
        // console.warn('entreeeal boton abrir modal en posicion:!' +c );
        document.getElementById('myModal' + c).showModal();
    });//end abrir model


    let bt_cerrar_modal = document.getElementById('bt_cerrar_modal' + c);
    bt_cerrar_modal.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();
        // console.warn('entreeeal boton cerrar  modal en posicion:!' +c );
        document.getElementById('myModal' + c).close();
    });//boton cerrar model
}



//funcion para buscar el codigo de
const buscarCod = (cod, i) => {
    document.getElementById('td_code_' + i).className = 'border border-gray-300';
    document.getElementById('td_cantidad_' + i).className = 'border border-gray-300';
    document.getElementById('td_precio_' + i).className = 'border border-gray-300';
    // fetch("https://cmmotors.net/api/ProductoApi/" + cod)
    // fetch("https://www.tecnoweb.org.bo/inf513/grupo07sa/CMMotors-SW2/public/api/ProductoApi/" + cod)
    //   fetch("https://kuregrill.ga/api/ProductoApi/" + cod)
    // fetch("http://localhost:8000/api/ProductoApi/" + cod)

    console.log('entre a buscar cod: ' + cod + ' en la posicion: ' + i);

    let formulario = new FormData();
    formulario.append("code", cod);

    let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    // console.warn('token: '+token);
    fetch('/inf513/grupo07sa/proyecto2/public/api/ProductoApiXD/', {
        headers: {
            "X-CSRF-TOKEN": token,
        },
        method: "post",
        body: formulario,
    })  .then((res) => res.json()) //promesa
        .then((data) => {
            console.warn('encontre code en la posicion:' + i);
            data = data.data;
            // data = data.data;
            document.getElementById('detalles' + i).value = data.nombre;

            if (data.precio_venta_con_factura != arrayMonto[i - 1]) {

                // document.getElementById('p_no_encontrado').innerHTML ='';
                let ppp = document.getElementById('p_no_encontrado');
                //  ppp.className = "text-green-400"
                ppp.textContent = '';

                valiCode_oem[i] = true;

                let precio = parseFloat(data.precio_venta_con_factura);
                document.getElementById('precio' + i).value = Number(precio.toFixed(2));
                // document.getElementById('costop'+i).value = 0

                //unidad de prosucto
                document.getElementById('unidad_co'+i).value = data.unidad;
                let cant = document.getElementById('cantidad' + i).value;

                verificarCantidad(cod, cant, i.toString());

                precio = Number((precio * cant).toFixed(2));
                // console.log(precio);
                document.getElementById('subtotal' + i).value = precio;
                // console.log('llegue!! ')
                //si estoy en la ventana ventas
                if(document.getElementById('verificar_solo_vista_Cotizacion').value == 'vacio'){
                    let precio_compra = parseFloat(data.precio_compra);
                    document.getElementById('costop' + i).value = Number((precio_compra).toFixed(2))
                }


                monto1 = Number((monto1 - (arrayMonto[i - 1] - precio)).toFixed(2));
                document.getElementById('monto_total').value = monto1;//Number(monto1.toFixed(2));
                arrayMonto[i - 1] = precio;
                //    arrayCantidad[i - 1] = cant;
                //    console.warn( arrayMonto);

                //fucio que realizar el descuento
                descuento2(tipo_cambio.value);


                //aqui se llenaran los datos dentro del modal
                document.getElementById('p_nombre_prod' + i).textContent = data.nombre;
                let img = document.getElementById('img_producto_venta' + i);
                img.src = "http://tecnoweb.org.bo/inf513/grupo07sa/proyecto2/public/img/fotosProductos/" + data.foto;
                document.getElementById('p_precio_fact_prod' + i).textContent = data.precio_venta_con_factura;
                document.getElementById('p_estante_prod' + i).textContent = data.estante;
                document.getElementById('p_cantidad_prod' + i).textContent = data.cantidad;
                document.getElementById('p_pro' + i).textContent = data.cod_producto;
                document.getElementById('p_alt' + i).textContent = data.cod_oem;
                document.getElementById('p_precio_comp' + i).textContent = data.precio_compra;
                document.getElementById('p_precio_sin_fact' + i).textContent = data.precio_venta_sin_factura;
                document.getElementById('p_marca' + i).textContent = data.marca;
                document.getElementById('p_procedencia' + i).textContent = data.procedencia;
                document.getElementById('p_origen' + i).textContent = data.origen;
                document.getElementById('p_stock_min' + i).textContent = data.cant_minima;
                // document.getElementById('p_vence' + i).textContent = data.fecha_expiracion;
                document.getElementById('p_proveedor' + i).textContent = data.nombre_proveedor;


            } else {
                console.log('no entre a completar las caja de precios');
            }
            return;

        }) //end de data
        .catch((e) => {
            //que hacer cuando hay un error
            console.log('NO SE ENCONTRO PRODUCTO xd entre al catch i=' + i);
            console.log(e);

            valiCode_oem[i] = false;
            // console.log( document.getElementById('td_code_' +i))
            document.getElementById('unidad_co'+i).value = 'PZA';
            document.getElementById('subtotal' + i).value = 0;
            document.getElementById('precio' + i).value = 0;
            monto1 = monto1 - arrayMonto[i - 1];
            document.getElementById('monto_total').value = monto1;
            arrayMonto[i - 1] = 0;
            descuento2(tipo_cambio.value);
            document.getElementById('p_no_encontrado').textContent = 'Producto no encontrado en la fila: ' + i;


            //poner vacio los datos dl models
            document.getElementById('p_nombre_prod' + i).textContent = 'NOMBRE DE PRODUCTO'
            let img = document.getElementById('img_producto_venta' + i);
            img.src = "http://tecnoweb.org.bo/inf513/grupo07sa/proyecto2/public/img/fotosProductos/default.png";
            console.warn('estyo entrando en la pos : '+i)
            // console.log( document.getElementById('p_precio_fact_prod' + i))
            document.getElementById('p_precio_fact_prod' + i).textContent = '';
            document.getElementById('p_estante_prod' + i).textContent = '';
            document.getElementById('p_cantidad_prod' + i).textContent = ' ';
            document.getElementById('p_pro' + i).textContent = ' ';
            document.getElementById('p_alt' + i).textContent = ' ';
            document.getElementById('p_precio_comp' + i).textContent = '';
            document.getElementById('p_precio_sin_fact' + i).textContent = '';
            document.getElementById('p_marca' + i).textContent = '';
            document.getElementById('p_procedencia' + i).textContent = '';
            document.getElementById('p_origen' + i).textContent = '';
            document.getElementById('p_stock_min' + i).textContent = '';
            // document.getElementById('p_vence' + i).textContent = '';
            document.getElementById('p_proveedor' + i).textContent = '';


        });

};




//evento para cuando se acmbie de datos el porcentaje
let bt_porcentaje = document.getElementById('bt_descuento');
document.getElementById('bt_descuento').addEventListener('input', () => {
    descuento2(tipo_cambio.value);
});

const descuento = () => {
    // console.log('LLEGIEA A PORCENTAJE');
    // console.log(tipo_cambioxd);
    let bt_porcentaje = document.getElementById('bt_descuento');
    let bt_monto_total = document.getElementById('monto_total');
    let bt_totalbs = document.getElementById('totalBs');
    let bt_totalsus = document.getElementById('totalSus');
    let valor = bt_monto_total.value;
    let porcentaje = (bt_porcentaje.value / 100) * valor;
    // console.log('el por:'+porcentaje);
    bt_totalbs.value = Number((valor - porcentaje).toFixed(2));
    bt_totalsus.value = Number((parseFloat(bt_totalbs.value) / 6, 97).toFixed(2));

};

const descuento2 = (tipo_cambioxd) => {
    // console.log('LLEGIEA A PORCENTAJE');
    // console.log(tipo_cambioxd);
    let bt_porcentaje = document.getElementById('bt_descuento');
    let bt_monto_total = document.getElementById('monto_total');
    let bt_totalbs = document.getElementById('totalBs');
    let bt_totalsus = document.getElementById('totalSus');
    let cambioFF = parseFloat(tipo_cambioxd);

    // console.log('LLEGIEA A PORCENTAJE');
    let valor = bt_monto_total.value;
    let porcentaje = (bt_porcentaje.value / 100) * valor;
    // console.log('el por:'+porcentaje);
    bt_totalbs.value = Number((valor - porcentaje).toFixed(2));
    bt_totalsus.value = Number((parseFloat(bt_totalbs.value) / cambioFF).toFixed(2));

};

// evento del tipo de cambio
tipo_cambio.addEventListener('keyup', e => {
    e.preventDefault();
    //verificar si esta bien escrito
    let valor = e.target.value;
    let mensaje = document.getElementById(e.target.id + '_error');
    tipo_cambio.className = "border-b p-1  border-gray-900  rounded text-xs text-center text-black mr-5   mb-3  outline-none";
    if (!isNaN(valor)) {
        mensaje.textContent = '';
        descuento2(e.target.value);
    } else {
        //no es numero mostrar mensaje
        descuento2(0);
        mensaje.textContent = '*Solo se permite numero y punto';

    }
});





//funcion para productos disponibles, cantidades
const verificarCantidad = (code, cantidad_restar, input_id) => {
    // console.warn('LLEGAMOS A VERIFICAR LA CANTIDAD');
    // console.log('code: '+code);
    // console.log('cantidad_restar: '+cantidad_restar);
    // console.log('input_id: '+input_id);
    let conf_cotizacion = document.getElementById('verificar_solo_vista_Cotizacion');
        // console.log(conf_cotizacion.value);

    if ((conf_cotizacion.value == 'vacio')||conf_cotizacion.value == 'pasarA_Venta') {
        let token = document.querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        //creando un formulario
        let datasearch = new FormData();
        datasearch.append("code", code);
        datasearch.append("cantidad", cantidad_restar);

        fetch('/inf513/grupo07sa/proyecto2/public/api/HayDisponible', {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: datasearch,
        }).then((data) => data.json())
            .then((data) => {
                // console.warn('llegue al then hay disponbles');
                // console.log(data);
                let in_encontrado = document.getElementById('p_no_encontrado');
                let c = enQuePosicionEstoy(input_id);
                let i = sacarNum(input_id);
                if (data.result != 'hay producotos disponibles') {
                    in_encontrado.textContent = data.result + c;
                    valiCantidad[i] = false;
                    // console.log('cambue el vaor a false en valicad[' + c + ']');
                    erroMensajeCantidad[i] = data.result + c;
                } else {
                    // console.log('ente a hay productos')
                    in_encontrado.innerHTML = '';
                    valiCantidad[i] = true;
                    // console.log('cambue el vaor a true en valicad[' + c + ']');
                    // console.log(valiCantidad[c]);
                }

            }).catch(function (error) {
                console.warn('llegue al error');
                console.error("Error: ", error);
            });


    }

}


//hacer una funcio para redondear los numero
const redondoRambo = () => {
    console.log('entre a la funcio')
}

redondoRambo()




