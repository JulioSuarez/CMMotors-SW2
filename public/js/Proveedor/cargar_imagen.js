//cuando se haga clip enun boton
let file_foto = document.getElementById('file_foto_ventas');
let bt_subir_foto = document.getElementById('button_subir_foto');
let imagen = document.getElementById('img_fotoventas');

bt_subir_foto.addEventListener('click',(e)=>{
    e.preventDefault();
    console.log('entre al boton subir foto')
    file_foto.click();

});


//lpara mostrar la imagen qeu se esta cargano
file_foto.addEventListener('change',()=>{

    console.log('se guardo una fpto');
    let url_foto = URL.createObjectURL(file_foto.files[0]);
   // console.log(url_foto);
    imagen.src = url_foto;
});


//boton de buscr en google
  let nom = document.getElementById('cod_oem');
  nom.addEventListener('change',()=>{
       //eliminar los espacios
    //   trim(nom);
        let google = document.getElementById('bt_buscar_google');
        console.log(google);
        google.href = 'https://www.google.com/search?q='+nom.value+'&tbm=isch&ved=2ahUKEwjTtM7fur76AhWnGbkGHdsWBn8Q2-cCegQIABAA&oq=marcador+de+pizarra&gs_lcp=CgNpbWcQAzIECCMQJzIECAAQQzIFCAAQgAQyBQgAEIAEMgUIABCABDIFCAAQgAQyBQgAEIAEMgUIABCABDIFCAAQgAQyBQgAEIAEOgYIABAeEAdQnQ1Y_h1gjCBoAHAAeACAAb0BiAGzBpIBAzAuNZgBAKABAaoBC2d3cy13aXotaW1nwAEB&sclient=img&ei=puU3Y9PJLaez5OUP262Y-Ac&bih=754&biw=1536';
  });
  //---------------- modals

//   let bt_abrir_modal = document.getElementById('bt_crear_proveedorM');
// bt_abrir_modal.addEventListener('click', e => {
//     //prevenir el evnto que viene por efauld
//     e.preventDefault();
//     console.warn('entreeeal boton abrir modal!');
//    document.getElementById('myModal_productos').showModal();
// });

// let bt_cerrar_modal = document.getElementById('bt_cerrar_M_productos');

// bt_cerrar_modal.addEventListener('click', e => {
//     //prevenir el evnto que viene por efauld
//     e.preventDefault();
//     console.warn('entreeeal boton cerrar  modal!');
//     document.getElementById('myModal_productos').close();
// });


// document.getElementById('bt_cancelarM_proveedor').addEventListener('click', e => {
//     //prevenir el evnto que viene por efauld
//     e.preventDefault();
//     console.warn('entreeeal boton cerrar  modal!');
//     document.getElementById('myModal_productos').close();
// });

//-------------------- Poner por defecto el proveedore seleccionado
let bt_guardar = document.getElementById('bt_guardar_proveedoreM');
    bt_guardar.addEventListener('click', e => {
        e.preventDefault();
        let selecct  =document.getElementById('select_proveedor');
        console.log('entre al boton guardar');
        //console.log(selecct);
        let opt = document.createElement('option');
        opt.selected ='selected';
        opt.value = document.getElementById('nit_buscar').value;
        opt.textContent = document.getElementById('empresa_provee').value;
        selecct.appendChild(opt);


        let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        let formulario = new FormData();

        console.warn('llegue a form');
        console.log(document.getElementById('persona_contacto_provee').value);
                formulario.append("nit",document.getElementById('nit_buscar').value );
                formulario.append("empresa", document.getElementById('empresa_provee').value);
                formulario.append("direccion", document.getElementById('direccion_provee').value );
                formulario.append("telefono", document.getElementById('telefono_provee').value );
                formulario.append("correo", document.getElementById('correo_provee').value );
                formulario.append("contacto", document.getElementById('persona_contacto_provee').value );
                formulario.append("tipo", document.getElementById('tipo_provee').value );
                fetch("/inf513/grupo07sa/proyecto2/public/ProveedorStore", {
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                method: "post",
                body: formulario,
            })  .then((dataxd) => dataxd.json())
                .then((data) => {
                    console.log('ya guarde el proveedor')
                    console.log(data);

                })
                .catch(function (error) {
                        console.error("Error: ", error);

                });
            bt_cerrar_modal.click();
    });

//FACTURAS------------------------------------------------------------
let inp_pr = document.getElementById("precio_pp");
let inp_pr_fact = document.getElementById("precio_factura_pp");
let inp_pr_sin_fact = document.getElementById("precio_sin_factura_pp");


    inp_pr.addEventListener('keyup', (e) => {
        console.log( 'escuchando evento');
        //para saber que se esta enviar
        // var numero = parseFloat(e.target.value);
        // numero = Number(numero.toFixed(2));
        // console.log(numero); // Muestra 1.78

        // console.log(typeof e.target.value);
        //  var numero = toString(e.target.value);
        //  console.log(numero);
        //  numero =Number(numero.toFixed(2))
        //  console.log(numero);

      //  inp_pr.value;
        //  console.log( 'llegue xd ');
         let V =parseFloat( e.target.value); //precio input
        //  console.log( 'V='+V);
         let P = 0.13;
         let F = Number((V+(100/100)*V).toFixed(2));
         inp_pr_fact.value = F;
         inp_pr_sin_fact.value = Number((F-(F*P)).toFixed(2));
        //  console.log( 'F*P'+(F*P));
        //  console.log('F'+F)
        //  console.log( '(F-(F*P)='+(F-(F*P)));
        //  console.log( 'termine  ');
    });

//


