
let pantalla_nav = document.getElementById('pantalla');
// console.log(pantalla_nav.value)

let div_pantalla = document.querySelectorAll('#div_navegador a')

//esto alumbra el icono en el nav, en la ventana que se encuetra
div_pantalla.forEach(e => {
    // console.log(e.id)
    if(e.id == ('a_'+pantalla_nav.value)){
      //  console.log('sii, estoy en la pantalla ')
        // console.log(e)
        e.classList.add('bg-blue-700','dark:bg-gray-700');
    }else{
        e.classList.remove('bg-blue-700','dark:bg-gray-700');
    }

});



//agrandart y disminur la pantalla
let bt_menu = document.getElementById('bt_menu'); //boton menu del nav
let div_menu_nav = document.getElementById('div_menu_nav'); // este es el div del na
let boolean = document.getElementById('boolean_div_menu'); //si esta biaero o cerardo
let div_contenido = document.getElementById('div_contenido'); //div del contenmido
let notificacion = document.getElementById('notificacion'); // es un span

// console.log( 'este es el by menu')
// console.log('estoy entrando de fabrica como :'+boolean.value)
// console.log( div_contenido )
bt_menu.addEventListener('click',(e)=>{
    e.preventDefault();
  //  console.log('le di click!!')
    notificacion.classList.toggle('hidden')  //bien
    if(boolean.value == 'true'){
//cuadno este abierto
      //  console.log('entre como true')
            boolean.value = 'false'
        div_menu_nav.classList.remove('w-14');
        div_menu_nav.classList.add('w-44');
        // div_menu_nav.className = 'fixed flex flex-col top-14 left-0 w-64 xl:w-64 bg-blue-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10';
        // div_contenido.classList.remove('ml-14');
        // div_contenido.classList.add('ml-64');
        div_contenido.className = 'h-full ml-44  xl:ml-64 mt-14 mb-10';
    }else{
      //  console.log('entre como false')
        boolean.value = 'true'
        div_menu_nav.classList.remove('w-44');
        div_menu_nav.classList.add('w-14');
        // div_menu_nav.className = 'fixed flex flex-col top-14 left-0 w-14 xl:w-64 bg-blue-900 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10';
        // div_contenido.classList.remove('ml-64');
        // div_contenido.classList.add('ml-14');
        div_contenido.className = 'h-full ml-14  xl:ml-64 mt-14 mb-10';
    }

    // console.log(div_menu_nav);
  //  console.log(div_contenido);
    // console.log(notificacion);

})




//para realizar el backup
 const hacerBackup = () =>{
    let token = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
    // let Formulario = new FormData();

    fetch("/HacerBackup", {
        headers: {
            "X-CSRF-TOKEN": token,
        },
        method: "post",
        body: new FormData(),
    })
        .then((data) => data.json())
        .then((data) => {
           console.log('llegue' + data.result);
        })
        .catch(()=> {
            console.log("entre a catch");
        });
 };


//  const logicaBackup = () =>{
//     dif = document.getElementById('diferencia_xd').value;
//     hh = document.getElementById('hora_xd').value;
//     console.log(hh)
//     console.log(dif)
//     if((dif != 0) && (hh >= 6)){
//         console.log('enter hacer el lbackup!!')
//         ///ahcer el backup
//         // hacerBackup();
//     }else{
//         console.log('no enter hacer el lbackup!!')
//     }

//  };


//  logicaBackup();



//
