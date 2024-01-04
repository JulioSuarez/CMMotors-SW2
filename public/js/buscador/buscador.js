import {buscador} from './exportar_buscador.js';

let input_buscador = document.getElementById('mysearch');
let id_lista = document.getElementById('ListaProductos');
let myUrl = "/inf513/grupo07sa/proyecto2/public/buscarProducto";
console.log(myUrl);

let buscarProducto = new buscador(myUrl,input_buscador,id_lista);
 buscarProducto.InputSearch();


 //--- al dar clip al boton X del buscador--------------------------
let bt_limpiar = document.getElementById('bt_limpiar');

bt_limpiar.addEventListener("click", (e) => {
    e.preventDefault();
     let xd =document.getElementById('ListaProductos');
    xd.innerHTML = "";
    input_buscador.value ='';
});


// let input_busc = document.getElementById('mysearch2');
// let id_list = document.getElementById('ListaProductos2');
// let Url2 = "/buscarProducto";

// let buscarProd = new buscador(Url2,input_busc,id_list);
//  buscarProd.InputSearch();

let bt_cambiar_busqueda = document.getElementById('bt_cambiar_busqueda');
let busqueda_estado = document.getElementById('busqueda_estado');
bt_cambiar_busqueda.addEventListener("click", (e) => {
    // console.log('click xd xd');
    e.preventDefault();
    bt_limpiar.click();
   if(buscarProducto.url == 'buscarProducto'){
        buscarProducto.cambiarUrl('buscarProductoNombre');
        input_buscador.placeholder = 'Buscar por Nombre';
        busqueda_estado.innerHTML = 'Busqueda por Nombre';
   }else{
        buscarProducto.cambiarUrl('buscarProducto');
        input_buscador.placeholder = 'Buscar por Codigo';
        busqueda_estado.innerHTML = 'Busqueda por Codigo';
   }
//    console.log(buscarProducto.url);
});


// let busqueda_estado = document.getElementById('busqueda_estado');
// Evento cuando el mouse entra en el div
bt_cambiar_busqueda.addEventListener("mouseenter", (e) => {
    // console.log('Entró en el div');
    busqueda_estado.style.display = 'block';
});

// Evento cuando el mouse sale del div
bt_cambiar_busqueda.addEventListener("mouseleave", (e) => {
    // console.log('Salió del div');
    busqueda_estado.style.display = 'none';
});




