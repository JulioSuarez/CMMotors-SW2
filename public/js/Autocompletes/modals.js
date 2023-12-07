


//necesito saber la cantidad cotara
$cantidad_ventas = document.getElementById('cantidad_ventas').value;
// console.log($cantidad_ventas );

for (let i = 0; i < $cantidad_ventas; i++) {
    let bt_abrir_modal = document.getElementById('bt_abrir_modal'+i);
    // console.log(document.getElementById('myModal'+i));
    bt_abrir_modal.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();
        console.warn('entreeeal boton abrir modal!');
       document.getElementById('myModal'+i).showModal();
    });


    let bt_cerrar_modal = document.getElementById('bt_cerrar_modal'+i);
    bt_cerrar_modal.addEventListener('click', e => {
        //prevenir el evnto que viene por efauld
        e.preventDefault();
        console.warn('entreeeal boton cerrar  modal!');
        document.getElementById('myModal'+i).close();
    });
}
///


// let form = document.getElementById('form');
// console.log(form)
// let axd = document.getElementById('axd');
// console.log(axd)
let div_form = document.getElementById('form');
let abrir_busquedas = document.getElementById('abrir_busquedas');
let estado =document.getElementById('estado');
// console.log(estado);
// let estado_bt_abrir = false;
abrir_busquedas.addEventListener('click',(e)=>{
    e.preventDefault();
    console.log('le di click!1')
    div_form.classList.toggle('hidden')
    if(estado.value == 'true'){
        estado.value  = 'false';
        abrir_busquedas.innerHTML = 'Realizar busquedas <svg id="svg_datos_general" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-6  "> <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25" /> </svg>';
    }else{
        estado.value = 'true';
        abrir_busquedas.innerHTML = 'Realizar busquedas <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12" /> </svg>'

    }

})





//modal para regular 
