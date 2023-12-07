let password = document.getElementById('password');
let pass_escrito = document.getElementById('password1'); //pass antes
// let len = 0;
// pass_escrito.addEventListener('input', (e) => {
//     e.preventDefault();
//    // console.log('que onda puto!!');
//     //contar len 
//     console.log(e.target.value);
//     // contra1 =e.target.value;
//     // let len = e.target.value.length
//     if( e.target.value.length <= 8){
//         let pp = document.getElementById('pass_minimo_requerido');
//         pp.className = 'flex text-red-500 items-end text-sm sm:text-sm px-1 sm:px-2   sm:pr-3 font-semibold rounded-xl  w-max';
//         pp.textContent = 'Minimo 8 caracteres ';
//     }
    
//     // console.log(contra1);
// })

password.addEventListener('input', (e) => {
    e.preventDefault();
   console.log('entre a pass 2');
    //contar len 
    console.log(pass_escrito.value);
    let len = pass_escrito.value.length
    
    console.log(len);

    // if( e.target.value.length == len){
        if(pass_escrito.value == e.target.value){
            console.log('son iguales');
            let pp = document.getElementById('pass_no_es_misma');
            pp.className = 'flex text-green-500 items-end text-sm sm:text-sm px-1 sm:px-2   sm:pr-3 font-semibold rounded-xl  w-max';
            pp.textContent = 'Las contraseñas coinciden';
        }else{
            let pp = document.getElementById('pass_no_es_misma');
            pp.className = 'flex text-red-500 items-end text-sm sm:text-sm px-1 sm:px-2   sm:pr-3 font-semibold rounded-xl  w-max';
            pp.textContent = 'Las contraseñas no coinciden';
        }
    // }
})



