let button = document.getElementById("buttonApi");
console.log(button);

button.addEventListener("click", (e) => {
    e.preventDefault();

    fetch("js/backupxd/Json_Cmmotors.json")
        .then((res) => res.json()) //promesa
        .then((data) => {
            //
            console.log(data);
            let tabla = document.getElementById("tabla");
            data.Clientes.forEach((Cliente) => {
                let tr = document.createElement("tr");
                // EJEMPLO: tr.append(td1,td2,td3);
                tr.append(
                    crear_input("ci", Cliente.ci),
                    crear_input("nombre", Cliente.nombre),
                    crear_input("empresa", Cliente.empresa),
                    crear_input("nit", Cliente.nit),
                    crear_input("correo", Cliente.correo),
                    crear_input("telefono", Cliente.telefono),
                    crear_input("direccion", Cliente.direccion)
                );

                ///////////////////////   EJEMPLO   //////////////////////////
                //
                // tr.appendChild(crear_input('cod_oem',Cliente.cod_oem));
                // tr.appendChild(crear_input('direccion',Cliente.direccion));
                // tr.appendChild(crear_input('correo',Cliente.correo));
                // tr.appendChild(crear_input('telefono',Cliente.telefono));
                // tr.appendChild(crear_input('direccion',Cliente.direccion));
                //
                ///////////////////////   EJEMPLO   //////////////////////////

                tabla.appendChild(tr);
            });
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
