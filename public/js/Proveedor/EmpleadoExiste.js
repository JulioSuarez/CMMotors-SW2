// const inputs = document.querySelectorAll('#formulario input');
// console.log(inputs);

// const _ = require("lodash");

const expresion = {
    ci: /^\d{4,14}$/,
    usuario: /^[a-zA-Z0-9\_\-]{1,25}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,255}$/, // Letras y espacios, pueden llevar acentos.
    pass_escrito: /^.{8,22}$/, // 4 a 12 digitos.
    password: /^.{8,22}$/, // 4 a 12 digitos.
    // correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    // correo: /^[a-zA-Z0-9_.+-]+@[a-z-]+\.[a-z]{2,4}$/,
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]{4,}\.[a-z]{2,4}$/,

    telefono: /^\d{7,14}$/, // 7 a 14 numeros.
};

const expresiones_switch = (inp_nombre, valor) => {
    switch (inp_nombre) {
        case "ci":
            return expresion.ci.test(valor);
        case "usuario":
            return expresion.usuario.test(valor);
        case "nombre":
            return expresion.nombre.test(valor);
        case "pass_escrito":
            return expresion.pass_escrito.test(valor);
        case "password":
            return expresion.password.test(valor);
        case "correo":
            return expresion.correo.test(valor);
        case "telefono":
            return expresion.telefono.test(valor);
    }
};

const errors_mensajes = (inp_nombre) => {
    switch (inp_nombre) {
        case "ci_existe":
            return "*Este CI ya fue registrado";
        case "ci":
            return "*El carnet debe ser minimo de 4 digitos";
        case "usuario_existe":
            return "*El nombre de usuario ya existe";
        case "usuario":
            return "*Solo se permite letras, numeros, guion y guion_bajo";
        case "nombre":
            return "*Solo se permite letras y espacios, pueden llevar acentos.";
        case "pass_escrito":
            return "*Minimo 8 caracteres";
        case "password":
            return "*Minimo 8 caracteres";
        case "password_existe":
            return "*Las contrasenias deben coincidir";
        case "correo_existe":
            return "*Este correo ya se encuentra registrado";
        case "correo":
            return "*Email invalido";
        case "telefono":
            return "*Minimo 7 digitos";
    }
};

const vali = {
    ci: false,
	usuario: false,
	nombre: false,
    // pass_escrito: false,
	password: false,
	correo: false,
	telefono: false,
}

let ventana = document.getElementById('ventana').value;
    if(ventana == 'ventana_edit'){
        // console.log('se cambiarion os datos')
        vali.ci = true;
        vali.usuario = true;
        vali.nombre = true;
        vali.password = true;
        vali.correo = true;
        vali.telefono =true;
        // console.warn(vali)
    }



const setVali = (inp_nombre,valor)=>{
    switch (inp_nombre) {
        case "ci":
            vali.ci = valor;
            break;
		case "usuario":
            vali.usuario = valor;
            break;
		case "nombre":
            vali.nombre = valor;
            break;
		case "pass_escrito":
            vali.pass_escrito = valor;
            break;
		case "password":
            vali.password = valor;
            break;
		case "correo":
            vali.correo = valor;
            break;
		case "telefono":
            vali.telefono = valor;
            break;
	}
};

const getVali = (inp_nombre)=>{
    switch (inp_nombre) {
        case "ci":
            return vali.ci ;

		case "usuario":
            return vali.usuario ;

		case "nombre":
            return vali.nombre ;

		case "pass_escrito":
            return vali.pass_escrito ;

		case "password":
            return vali.password ;

		case "correo":
            return vali.correo ;

		case "telefono":
            return vali.telefono ;

	}
};




const verificarInputs = (imp_nombre, valor) => {
    // console.warn("LLEGAMOS A VERIFICAR IMPUTS");
    // console.log("nombre de la caja:" + imp_nombre);
    let mensaje = document.getElementById("p_" + imp_nombre);

    if (expresiones_switch(imp_nombre, valor)) {
        // console.log('esta bien')
        mensaje.textContent = '';
        // setVali(imp_nombre,true);
    } else {
        // setVali(imp_nombre,false);
        if (valor == '') {
            // console.log('esta vacio')
            mensaje.textContent = '';
            // if(imp_nombre == 'telefono')
                // setVali(imp_nombre,true);

        } else {
            // console.log('esta mal')
            // console.log(mensaje);
            mensaje.textContent = errors_mensajes(imp_nombre);

        }

    }
};

//nombre caja, bool, bool
const verificar = (imp_nombre, result, vacio) => {
    // console.warn("LLEGAMOS A VERIFICAR");
    // console.log("nombre de la caja:" + imp_nombre);
    let mensaje = document.getElementById("p_" + imp_nombre + "_existe");
    let titulo = document.getElementById(imp_nombre + "_label");
    let div_caja = document.getElementById(imp_nombre + "_div");
    let div_svg = document.getElementById(imp_nombre + "_svg");

    // console.log(div_caja)/
    //antes de mostrar el mensaje //verificar si esta bien escrito

    if (result) {
        mensaje.textContent = errors_mensajes(imp_nombre + '_existe');
        titulo.className = "font-semibold text-red-600";
        div_caja.className = "flex items-center border-2 border-red-600";
        div_svg.innerHTML =
            ' <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-red-600"> <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /> </svg>';
        setVali(imp_nombre,false);
    } else {
        mensaje.innerHTML = "";
        titulo.className = "font-semibold text-black dark:text-gray-100";
        // // e.target.className = 'bg-white border-2 border-gray-300 focus:border-blue-400 outline-none w-full px-2 py-2 ';
        div_caja.className = "flex items-center border-2 border-blue-500";
        setVali(imp_nombre,true);
        // if(vali.usuario){
                if (vacio) {
                    //lo de vacio es para mostrar el icono
                    // console.log("entre a mostrar vacio");
                    div_svg.innerHTML = "";
                        if(imp_nombre != 'telefono')
                            setVali(imp_nombre,false);
                } else {
                    // console.log("entre a mostrar con el check");
                    div_svg.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"class="w-7 h-7 text-green-700 "><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
                }
        // }else{ //por si hay datos pero
        //     titulo.className = "font-semibold text-red-600";
        //     div_caja.className = "flex items-center border-2 border-red-600 px-1";
        //     div_svg.innerHTML =
        //         ' <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-red-600"> <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /> </svg>';
        // }
    }
    return;
};


//metodo para verificar si existe el usuario
const validacionInpExiste = (e) => {
    e.preventDefault();
    //  console.log(e.target.value);
    let nombre_imp = e.target.name;
      console.log(nombre_imp);
    let token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    let valor = e.target.value;
    let minimo_letras = 3;
    // let ventana = document.getElementById('ventana').value;
    let valor_antes;
    if(document.getElementById('valor_edit')){
        console.log('estamos en edit');
        valor_antes =document.getElementById('valor_edit').value;
    }else{
        console.log('no estmaoso en edit valor 0');
        valor_antes = 0;
    }
console.log(valor_antes);

    if (valor.length > minimo_letras) {
        //creando un formulario
        let Formulario = new FormData();
        Formulario.append("valor", valor);
        Formulario.append("id_edit",valor_antes);
        //aqui se puede aniadir mas datos como el nobre de la caja
        fetch("/inf513/grupo07sa/proyecto2/public/Existe_" + nombre_imp, {
            headers: {
                "X-CSRF-TOKEN": token,
            },
            method: "post",
            body: Formulario,
        })
            .then((data) => data.json())
            .then((data) => {
                console.warn(data.result)
               verificar(nombre_imp, data.result, false);
            })
            .catch(function (error) {
                console.log("entre a catch,no se leyo la api o ruta");
            });
    } else {
        console.log("es meonr de 1 ");
        verificar(nombre_imp, false, true);
    }
};

let ci_emp = document.getElementById("ci_emp");
let usuario_inp = document.getElementById("usuario_inp");
let correo_inp = document.getElementById("correo_inp");
ci_emp.addEventListener("keyup", validacionInpExiste);
usuario_inp.addEventListener("keyup", validacionInpExiste);
correo_inp.addEventListener("keyup", validacionInpExiste);

//hacer evento para todos los inputs xd
// let form = document.getElementById('formularioxd');
// console.log(form);


const crearFocus = (inp_nombre) => {
    // console.log('ENTRE xd xdx');
    let div = document.getElementById(inp_nombre+'_div');
    // console.log(div);
    div.addEventListener('focus', (e) => {
        e.preventDefault();
        console.log('le di click');
        div.className = 'flex items-center border-2 border-blue-500 px-1';
    }, true);

    div.addEventListener('blur', (e) => {
        e.preventDefault();
        console.log('le di blur');
        div.className = 'flex items-center border-2 border-gray-300 px-1';
    }, true);
};

const forms_inputs = document.querySelectorAll("#formularioxd input");
// console.log(forms_inputs);
forms_inputs.forEach((input) => {
    // input.addEventListener('keyup', validarFormulario);
    // input.addEventListener('blur', validarFormulario);
    // console.log(input.name);
    if (input.name != "_token" && input.name != "_method" && input.name != "roles[]"
        && input.name != "nombre" && input.name != "telefono" && input.name != "ventana" ) {
            crearFocus(input.name);
    }

    if (input.name != "_token" && input.name != "_method" && input.name != "roles[]"
    && input.name != "ventana" ) {
        // console.log(input.name);
        input.addEventListener("keyup", (e) => {
            // verificarInputs(input.name)
            //preguntar si esta bine escrito
            verificarInputs(e.target.name, e.target.value);
        });
    }
});

const verificarVali = ()=>{
// console.log('enter a verificar valiii');
    forms_inputs.forEach((input) => {
        // input.addEventListener('keyup', validarFormulario);
        // input.addEventListener('blur', validarFormulario);
        // console.log(input.name);
        if (input.name != "_token" && input.name != "_method" && input.name != "roles[]"
                    && input.name != "ventana") {
console.log('enter con el input'+input.name);
            if (expresiones_switch(input.name, input.value)){
console.log('ESTA BIEN ESCRITO');
                if (getVali(input.name)==false){
                    if (input.name == 'nombre' || input.name == 'telefono'){
                        setVali(input.name,true);
                    }else{setVali(input.name,false);}
                }
            }else{
                console.log('ESTA MAL ESCRITO');
                // setVali(input.name,false);
            }
        }
    });
};



let form = document.getElementById('formularioxd');
form.addEventListener('submit',(e)=>{
    // e.preventDefault();
    let div_error = document.getElementById('error_validacion');
    //funcion para verificar los inputs
    verificarVali();
    console.log(vali);
    if(vali.ci == false || vali.usuario == false || vali.password == false
        || vali.correo == false || vali.nombre == false || vali.telefono == false){
            //falto hace con el telefon, igual es innecesario
            e.preventDefault();
            console.log('enter a false xd');
            div_error.innerHTML+='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 23 23" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-red-600"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /> </svg> <p class="px-1 uppercase text-red-600 font-semibold text-center"> Verifique bien los campos </p>';
            setTimeout(() => {
                div_error.innerHTML = '';
            }, 3000);
        }else{
            console.log('enter a true xd');
        }

})




let pass_escrito = document.getElementById("pass_escrito"); //pass antes
let password = document.getElementById("password"); //vuelve a escribir contra
// let len = 0;
pass_escrito.addEventListener("input", (e) => {
    e.preventDefault();
    console.log("entre!!");
    if (password.value != "") {
        //motrar poner bien las contrasenas y que no coincide con el otro
        if (password.value == e.target.value) {
            console.log("son iguales");
            // if(pass_escrito.value.length>4)
            verificar(password.name, false, false);

        } else {
            console.log("no son iguales");
            verificar(password.name, true, false);
        }
    } else {
        //es vacio, no mostrar nigun error, solo la de poner bien las contrasenas
        console.log("esta vacio");
    }
});

password.addEventListener("input", (e) => {
    e.preventDefault();
    //    console.log( e.target.value);
    //contar len
    console.log(pass_escrito.value);
    // let len = pass_escrito.value.length

    // console.log(len);

    // // if( e.target.value.length == len){
    if (e.target.value != "") {
        if (pass_escrito.value == e.target.value) {
            console.log("son iguales");
            // if(pass_escrito.value.length>4)
            verificar(e.target.name, false, false);
        } else {
            verificar(e.target.name, true, false);
        }
    } else {
        console.log("esta vaio");
        verificar(e.target.name, false, true);
    }
});



