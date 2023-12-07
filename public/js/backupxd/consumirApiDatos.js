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
        data.DatosGenerales.forEach(Dastos => {
            let tr = document.createElement('tr');
            tr.appendChild(crear_input('id',Dastos.id));
            tr.appendChild(crear_input('tipo_de_cambio',Dastos.tipo_de_cambio));
            tr.appendChild(crear_input('forma_pago',Dastos.forma_pago));
            tr.appendChild(crear_input('cheque',Dastos.cheque));
            tr.appendChild(crear_input('cuenta_bancaria',Dastos.cuenta_bancaria));
            tr.appendChild(crear_input('entrega',Dastos.entrega));
            tr.appendChild(crear_input('nota',Dastos.nota));


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
