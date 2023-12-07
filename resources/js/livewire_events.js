
console.log('livewire_events.js cargado');
Livewire.on('autorellenarCliente', cliente => {
    console.log('le di click desde livewire');
    // $('#cliente_id').val(response.id);
    document.getElementById('cliente').value= cliente.nombre;
    document.getElementById('ci_autocomplete').value = cliente.ci;
    document.getElementById('telefono').value = cliente.telefono; 
    
    //limpiar busqueda o cerrar busqueda
    document.getElementById('div_busqueda_cliente').classList.add('hidden');
           
});


let div_busqueda_cliente = document.getElementById('div_busqueda_cliente');
let bt_abrir_busqueda_clientes = document.getElementById('bt_abrir_busqueda_clientes');
let input_cliente = document.getElementById('cliente');


bt_abrir_busqueda_clientes.addEventListener('click', (e) => {
    e.preventDefault();
    div_busqueda_cliente.classList.toggle('hidden');
    Livewire.emit('event_modal_busqueda');
    
});

//cerrar busqueda 
document.addEventListener('click',(e)=>{

    // console.log(e.target == input_cliente );
    let bt_svg = document.getElementById('bt_svg');
    let bt_path = document.getElementById('bt_path');
    if(!( e.target == div_busqueda_cliente || e.target == bt_svg || e.target == bt_path || e.target == input_cliente ) ){
        if(!div_busqueda_cliente.classList.contains('hidden')){
            div_busqueda_cliente.classList.add('hidden');
            Livewire.emit('event_cerrar_modal');
        }
    }

});


//evento para cuando se este escribien en el input de busqueda
input_cliente.addEventListener('keyup', (e) => {
    console.log('escribiendo');
    // let valor = e.target.value;
    //poner el spinner loading
    document.getElementById('div_spinner').innerHTML = `
    <svg class=" h-5 w-5 animate-spin text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
    `;
    //difuminar y deshabilitar todos bontoes de table 
    let bt_table = document.querySelectorAll('.busqueda');
    bt_table.forEach((bt) => {
        bt.classList.add('text-gray-300');
        bt.classList.add('cursor-progress');

    });

    Livewire.emit('event_abrir_modal');
});

