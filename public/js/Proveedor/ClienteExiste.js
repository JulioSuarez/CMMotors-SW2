(()=>{


const expresion = {
    ci: /^\d{4,20}$/,
    // nit: /^\d{5,30}$/,
    // usuario: /^[a-zA-Z0-9\_\-]{1,16}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ0-9\s\-_.,]{1,255}$/, // Letras y espacios, pueden llevar acentos.
    empresa: /^[a-zA-Z0-9-ÿ\s\_\-.,]{1,255}$/,
    direccion: /^[a-zA-Z0-9-ÿ\s\_\-\#\/]{1,255}$/,
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/, // 7 a 14 numeros.
};

const errors_mensajes = {
    ci: "*El carnet debe ser minimo de 4 digitos",
    // nit: /^\d{5,30}$/,
    // usuario: /^[a-zA-Z0-9\_\-]{1,16}$/, // Letras, numeros, guion y guion_bajo
    nombre: "*Solo se permite letras, numeros y espacios, pueden llevar acentos, guiones,puntos y comas.", // Letras y espacios, pueden llevar acentos.
    empresa: "Solo se permite letras, numeros, guion y espacios",
    direccion: "Letras, numeros, guion, guion_bajo, corchetes",
    correo: "*Email invalido",
    telefono: "*Solo numeros, minimo 7 digitos", // 7 a 14 numeros.
};


// console.log(ventana.value);
const vali = {
    ci: false,
    nombre: false,
    empresa: true,
    direccion: true,
    correo: true,
    telefono: true,
}

let ventana = document.getElementById('ventana').value;
    if(ventana == 'ventana_edit'){
        vali.ci = true;
        vali.nombre = true;
    }



const ExisteCliente=(valor,input,mensaje)=>{
        // let nombre_imp = e.target.name;
        // console.log('llegue a existre cliente xd xd');
        let token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        // let valor = e.target.value;
        let minimo_letras = 3;
        let ipventana = document.getElementById('ventana').value;
        let valor_antes = document.getElementById('valor_antes').value;

        if (valor.length > minimo_letras) {
            //creando un formulario
            let Formulario = new FormData();
            Formulario.append("valor", valor);
            Formulario.append("ventana", ipventana);
            Formulario.append("valor_antes", valor_antes);
            //si estamos en edut no entar cuando sea lo mismo 
            if(!(ipventana == 'ventana_edit' && valor == valor_antes)){
                console.log('entre al fecth son diferentes');
                console.log(valor, valor_antes);
                console.log(ipventana );
                //no hace falta hacer la consutla 
                fetch("/Existe_Cliente", {
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    method: "post",
                    body: Formulario,
                })
                    .then((data) => data.json())
                    .then((data) => {
                        console.log('FECTH DEVUEL: '+data.result);
                        if(data.result){
                            input.className = 'outline-none w-full px-2 py-2 dark:bg-gray-700 border-2 border-red-600 capitalize ';
                            mensaje.textContent = 'Este CI/NIT ya se encuentra registrado';
                            vali.ci=false;
                        }
                    })
                    .catch(function (error) {
                        console.log("entre a catch,no se leyo la api o ruta");
                    });
            }else{
                console.log('es igual no se entro al fecth');
            }
        } else {
            console.log("es meonr de 1 ");
            // verificar(nombre_imp, false, true);
        }

}

const verificarInputs = (inp_nombre,inp_valor)=>{
    //verificar si esta bien escrito
    let input = document.getElementById(inp_nombre+'_input');
    let mensaje = document.getElementById(inp_nombre+'_pp');
    if(inp_valor == ''){
        if( inp_nombre == 'ci' || inp_nombre == 'nombre'){
            input.classList.remove( 'border-gray-300','focus:border-blue-700' );
            input.classList.add( 'border-red-600', );
            mensaje.textContent = 'Obligatorio';
            vali[inp_nombre]=false;
        }else{
            console.log('es vacio xd');
            input.classList.remove('border-red-600' );
            input.classList.add( 'border-gray-300','focus:border-blue-700'  );
            mensaje.textContent = '';
            vali[inp_nombre]=true;
        }
    }else{
            if (expresion[inp_nombre].test(inp_valor)){
                //cambair el border a normal gray
                console.log('BIEN ESCRTIO');
                input.classList.remove( 'border-red-600' );
                input.classList.add( 'border-gray-300','focus:border-blue-700' );
                mensaje.textContent = '';
                vali[inp_nombre]=true;
                // pregunto si es ci
                if(inp_nombre == 'ci')
                    ExisteCliente(inp_valor,input,mensaje);


            }else{
                console.log('MAL ESCRITO');
                // console.log(input);
                // input.className = 'outline-none w-full px-2 py-2 dark:bg-gray-700 border-2 border-red-600 ';
                input.classList.remove('border-gray-300','focus:border-blue-700');
                input.classList.add( 'border-red-600' );
                mensaje.textContent = errors_mensajes[inp_nombre];
                vali[inp_nombre]=false;
                }
        }
}


const forms_inputs = document.querySelectorAll("#form_cliente input");
// console.log(forms_inputs);
forms_inputs.forEach((input) => {
    if (input.name != "_token" && input.name != "_method" ) {
        // console.log(input.name);
        input.addEventListener("keyup", (e) => {
            // console.log('estoy escribiendo e :' + input.name );
            verificarInputs(e.target.name,e.target.value)

        });
    }
});



let form = document.getElementById('form_cliente');
form.addEventListener('submit',(e)=>{
    // e.preventDefault();
    let div_error = document.getElementById('error_validacion');

    if(vali.ci == false || vali.empresa == false || vali.direccion == false
        || vali.correo == false || vali.nombre == false || vali.telefono == false){
              e.preventDefault();
            console.log('enter a false xd');
            div_error.innerHTML+='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 23 23" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-red-600"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /> </svg> <p class="px-1 uppercase  text-red-600 font-semibold text-center"> Verifique bien los campos </p>';
            setTimeout(() => {
                div_error.innerHTML = '';
            }, 3000);
        }
});

})();
//
