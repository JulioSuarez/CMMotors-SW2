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
        data.Ventas.forEach(cotizacion => {
            let tr = document.createElement('tr');
            tr.appendChild(crear_input('id',cotizacion.id));
            tr.appendChild(crear_input('monto_total',cotizacion.monto_total));
            tr.appendChild(crear_input('fecha',cotizacion.fecha));
            tr.appendChild(crear_input('hora',cotizacion.hora));
            tr.appendChild(crear_input('descuento',cotizacion.descuento));
            tr.appendChild(crear_input('total_en_bolivianos',cotizacion.total_en_bolivianos));
            tr.appendChild(crear_input('total_en_dolares',cotizacion.total_en_dolares));
            tr.appendChild(crear_input('ci_cliente',cotizacion.ci_cliente));
            tr.appendChild(crear_input('ci_empleado',cotizacion.ci_empleado));
            tr.appendChild(crear_input('id_datos_generales',cotizacion.id_datos_generales));



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
