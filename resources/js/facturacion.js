console.log("hola mundo");	

for (let i = 0; i < cantidad_ventas; i++) {
    let btnFacturar = document.getElementById('btn_facturar'+i);
    // console.log(btnFacturar);
    if(btnFacturar){
        btnFacturar.addEventListener('click', function(){
            console.log('le di click!! xd xd ');
            console.log(btnFacturar);
            let id_venta = document.getElementById('venta_id'+i).value;
            console.log(id_venta);
            const confirmacion = confirm(`¿Confirmar si en verdad desea facturar la venta nro:${id_venta}?`);

            if(confirmacion){ 
                let difuminar_vista = document.getElementById('difuminar_vista');
                console.log('entree!');
                difuminar_vista.classList.remove('hidden');

                //realizar la peticion ajax
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                console.warn('token: '+token);
                const class_error = "animate-bounce fixed z-50 top-12 right-3 py-2 px-3 text-white w-fit  rounded-lg";
                let div_error = document.getElementById('div_error');
                fetch('/Venta/Create/RefreshXD/' + id_venta , {
                    headers: {
                        "X-CSRF-TOKEN": token,
                    },
                    method: "POST",
                    // body: datasearch,
                })  .then((res) => res.json()) //promesa
                    .then((data) => {
                        // console.warn('encontre code en la posicion:' + i);
                        console.log(data);
                        // console.log(data.);
                        difuminar_vista.classList.add('hidden');
                        //verificar si esta la class hidden en el div de error 
                        if(data.estado == 'error'){
                            div_error.className = class_error + " bg-red-500";
                            div_error.textContent = data.mensaje;

                        }else{
                            div_error.className = class_error + " bg-green-500";
                            div_error.textContent = data.mensaje;

                            //actualizar disenio 
                            btnFacturar.className = 'text-sm whitespace-nowrap cursor-default font-semibold text-black border px-2 py-1 rounded-lg bg-green-100  mx-2 flex items-center justify-center';
                            btnFacturar.innerHTML = `
                            <span class="inline-block  w-3 h-3 mr-2 rounded-full bg-green-500"></span>
                            Facturado #${data.nro_factura}
                            `;
                            btnFacturar.disabled = true;


                        }

                }).catch((e) => {
                    console.warn('error:', e);
                    difuminar_vista.classList.add('hidden');

            
                    // div_error.classList.remove('hidden');
                    div_error.className = "animate-bounce fixed z-50 top-12 right-3 py-2 px-3 text-white w-fit  rounded-lg bg-red-500";
                    div_error.textContent = 'Error en el servidor de TuGerente, verifique si se homologo los productos o contacte con el desarrollador';
                });
                console.log('fin de la peticion ajax');
                setTimeout(function() {  
                    div_error.classList.add('hidden');
                }, 30000);
            }
        });
    }
}



//para eliminar ventas 
for (let i = 0; i < cantidad_ventas; i++) {
    let bt_eliminar = document.getElementById('bt_eliminar'+i);
    bt_eliminar.addEventListener('click', function(){
        console.log('le di click!! xd xd ');
        let modal_eliminar = document.getElementById('modal_eliminar'+i);
        modal_eliminar.classList.toggle('hidden');
        
    });
};
