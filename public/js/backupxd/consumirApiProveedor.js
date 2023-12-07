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
        data.Proveedores.forEach(Proveedor => {
            let tr = document.createElement('tr');
            tr.appendChild(crear_input('id',Proveedor.id));
            tr.appendChild(crear_input('nombre_proveedor',Proveedor.nombre_proveedor));
            tr.appendChild(crear_input('proveedor_direccion',Proveedor.proveedor_direccion));
            tr.appendChild(crear_input('proveedor_telefono',Proveedor.proveedor_telefono));
            tr.appendChild(crear_input('proveedor_correo',Proveedor.proveedor_correo));
            tr.appendChild(crear_input('nombre_proveedor_contacto',Proveedor.nombre_proveedor_contacto));
            tr.appendChild(crear_input('nit',Proveedor.nit));
            tr.appendChild(crear_input('tipo',Proveedor.tipo));



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
