let button = document.getElementById("buttonApi");
let ban =document.getElementById("bandera");
console.log('bandera:'+ban.value );

button.addEventListener("click", (e) => {
    e.preventDefault();
    fetch("js/backupxd/Json_Cmmotors.json")
        .then((res) => res.json()) //promesa
        .then((data) => {
            //  console.log(data);
            let tabla = document.getElementById("tabla");
          //  console.log(data.Productos.length);
             let len; let j
            if( ban.value == 0){
                len = 400;
                j=0;
            }else{
                j=400;
                len = data.Productos.length
            }
           // console.log('len:'+len );
           // console.log('len:'+j );

             for (let i = j; i < 20; i++) {
               // console.log('entre '+i)
                let Producto = data.Productos[i];
                let tr = document.createElement("tr");
                // EJEMPLO: tr.append(td1,td2,td3);
                tr.append(
                    crear_input("id", Producto.id),
                    crear_input("cod_oem", Producto.cod_oem),
                    crear_input("cod_sustituto", Producto.cod_sustituto),
                    crear_input("nombre", Producto.nombre),
                    crear_input("marca", Producto.marca),
                    crear_input("procedencia", Producto.procedencia),
                    crear_input("origen", Producto.origen),
                    crear_input("descripcion", Producto.descripcion),
                    crear_input("cantidad", Producto.cantidad),
                    crear_input("cant_minima", Producto.cant_minima),
                    crear_input("precio_venta_con_factura",Producto.precio_venta_con_factura),
                    crear_input("precio_venta_sin_factura",Producto.precio_venta_sin_factura),
                    crear_input("precio_compra", Producto.precio_compra),
                    crear_input("foto", Producto.foto),
                    crear_input("fecha_expiracion", Producto.fecha_expiracion),
                    crear_input("tienda", Producto.tienda),
                    crear_input("unidad", Producto.unidad),
                    crear_input("estado", Producto.estado),
                    crear_input("estante", Producto.estante),
                    crear_input("categoria", Producto.categoria),
                    crear_input("id_proveedor", Producto.id_proveedor),
                    );

                //crear input foto
                // let tdF = document.createElement("td");
                // let inpF = document.createElement("input");
                // inpF.className = "w-20 mx-1";
                // inpF.name = "foto" + "[]";
                // inpF.type = "text";
                // inpF.value = Producto.foto;
                // inpF.val = Producto.foto;
                // inpF.file = Producto.foto;
                // inpF.files.names = Producto.foto;
                // inpF.files.all = Producto.foto;
                // inpF.files.values = Producto.foto;
                //   inpF.SetFile = Producto.foto;
                // tdF.appendChild(inpF);

                // tr.appendChild(tdF);

                // /////////////////////   EJEMPLO   //////////////////////////

                // tr.appendChild(crear_input('cod_oem',Cliente.cod_oem));
                // tr.appendChild(crear_input('direccion',Cliente.direccion));
                // tr.appendChild(crear_input('correo',Cliente.correo));
                // tr.appendChild(crear_input('telefono',Cliente.telefono));
                // tr.appendChild(crear_input('direccion',Cliente.direccion));

                // /////////////////////   EJEMPLO   //////////////////////////

                tabla.appendChild(tr);
             }

        }) //end de data
        .catch(() => {
            console.log("entre a error getP");
        });
});

const crear_input = (inp_nombre, valor) => {
    let td = document.createElement("td");
    let inp = document.createElement("input");
    inp.className = "w-20 mx-1";
    inp.name = inp_nombre + "[]";
    inp.value = valor;
    td.appendChild(inp);
    return td;
};

//
