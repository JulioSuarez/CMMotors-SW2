let button  = document.getElementById('buttonApi');
console.log(button);

button.addEventListener('click',(e)=>{
    e.preventDefault();

        fetch( "js/backupxd/Json_Cmmotors.json")
        .then((res) => res.json()) //promesa
        .then((data) => {
        //
        console.log(data);
        let tabla = document.getElementById('tabla');
        console.log(data.DetallesCotizaciones);
        data.DetallesCotizaciones.forEach(DetalleCotizacion => {
            let tr = document.createElement('tr');
            tr.appendChild(crear_input('id',DetalleCotizacion.id));
            tr.appendChild(crear_input('cantidad',DetalleCotizacion.cantidad));
            tr.appendChild(crear_input('precio',DetalleCotizacion.precio));
            tr.appendChild(crear_input('id_producto',DetalleCotizacion.id_producto));
            tr.appendChild(crear_input('id_cotizacion',DetalleCotizacion.id_cotizacion));
            tr.appendChild(crear_input('precio_producto_unitario',DetalleCotizacion.precio_producto_unitario));
            tr.appendChild(crear_input('tiempo_entrega',DetalleCotizacion.tiempo_entrega));
            tr.appendChild(crear_input('detalle_co',DetalleCotizacion.detalle_co));
            tr.appendChild(crear_input('unidad_co',DetalleCotizacion.unidad_co));



            //  // // // // // // // // // // ejemplos // // // // // // // // // //
            //
            // tr.append(td1,td2,td3);
            // tr.append(crear_input('id',Cliente.id),crear_input('nombre',Cliente.nombre),crear_input('empresa',Cliente.empresa))
            // tr.appendChild(crear_input('direccion',Cliente.direccion));
            // tr.appendChild(crear_input('correo',Cliente.correo));
            // tr.appendChild(crear_input('telefono',Cliente.telefono));
            // tr.appendChild(crear_input('direccion',Cliente.direccion));
            //
            //  // // // // // // // // // ejemplos // // // // // // // // // //


            tabla.appendChild(tr);

        });



        }) //end de data
        .catch(() => {
        console.log('entre a error getP')
        });


});

const crear_input = (inp_nombre,valor)=>{
    let td = document.createElement('td');
    let inp = document.createElement('input');
    inp.className = 'w-20 mx-1';
    inp.name = inp_nombre+"[]";
    inp.value = valor;
    td.appendChild(inp);
    return td;
};


                //
