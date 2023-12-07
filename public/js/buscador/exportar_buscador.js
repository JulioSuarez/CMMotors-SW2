// aplicarcompreciono minimizacion para codigo de JS
export class buscador {

    constructor(laUrlP, id_inputBuscar, id_list) {
        this.url = laUrlP;  //la url
        this.mysearchp = id_inputBuscar; //la id del input de buscar
        this.ListaP = id_list; //la id donde se aniadira la lista
        this.idli = "mylist"; //???
        this.pcantidad = document.querySelector("#pcantidad"); //cantidad??
        this.contad = 0;
        // this.miEvento = null;
        // this.miEvento2 = null;
        // productos = this.ListaP.querySelectorAll(".bt_buscados");
        // selectedProductoIndex = 0;
    }

    cambiarUrl(url) {
        this.url = url;
    }

    //funcion para buscar el codigo de

    InputSearch() {
        //creando evento para el input de biuscar\
        this.mysearchp.addEventListener("input", (e) => {
            e.preventDefault();
            //limpiar la lista

            // console.log(e.target.value);
            try {
                let token = document.querySelector('meta[name="csrf-token"]')
                            .getAttribute("content");
                let minimo_letras = 0;
                let valor = e.target.value;
             //   console.log(token);
                // console.log('valor: '+valor);

                if (valor.length == 1) {
                    this.ListaP.innerHTML = "";
                }else if (valor.length > minimo_letras) {

                        //creando un formulario
                         let datasearch = new FormData();
                         datasearch.append("valor", valor);
                         fetch(this.url, {
                            headers: {
                                "X-CSRF-TOKEN": token,
                            },
                            method: "post",
                            body: datasearch,
                        })  .then((data) => data.json())
                            .then((data) => {
                           
                             let conf = document.getElementById('verificarVentasCreate');
                                if(conf.value== 'vacio'){
                                    console.log('es vacio no estoy en create ');
                                   this.mostrarArrayProd(data.productos);
                                }else{
                                    console.log('entre a no es vacio estoy en create');
                                    this.mostrarEnVentaCreate(data.productos);
                                }                         
                                // this.ponerEventosTeclado();
                                //actualizar productos_busqueda

                            })
                            .catch(function (error) {
                                 console.error("Error: ", error);
                                //  this.ListaP.innerHTML = "";
                            });
                        // }

                  //      console.log('hola entre a buscar');
                 //      console.log('valor en from: '+datasearch.get('valor'));
                    } else {

                       // console.log('es meonr de 2 ');
                        this.ListaP.innerHTML = "";
                      //  console.log(this.ListaP);
                        //por si no entra que hacer
                    }

            } catch (error) {

            }
        });
    }

    mostrarArrayProd(data) {

  //    this.ListaP.removeEventListener("click", this.miEvento);
  this.ListaP.innerHTML = "";
  // console.log(data.prod);
  // this.vaciarLista()
  

  // let listaProductos = document.getElementById("ListaProductos");
  let productosxd = this.ListaP.querySelectorAll(".bt_buscados");
  productosxd.forEach((element) => {
      this.ListaP.removeChild(element);
  });
//   console.log('se removio los hijos');
//   console.log(this.ListaP);

        //let ListaProductos =document.getElementById('ListaProductos');
        // console.log('enter al MOSTRAR ARRAY hay :' +data.length);
   //     console.log(data);
    //   let i;
    selectedProductoIndex = 0;
    let i ;
      for (  i = 0; i < data.length; i++) {
  //      console.log('entre en:'+i);

        let formulario = document.createElement('form');
        formulario.action = "/Producto/"+data[i].id;
        formulario.method = "GET";

    //    console.log(formulario);

        let bt_buscados = document.createElement('button');
        bt_buscados.className = "bt_buscados text-black text-sm bg-gray-200 rounded  flex items-center  w-56 sm:w-96 p-1  my-0.5 shadow-sm border border-gray-800 ";
        bt_buscados.id = 'bt_buscados'+i;
        bt_buscados.type = 'submit';

    //     bt_buscados.innerHTML = '<img class="m-1 border border-black rounded-sm object-cover h-14 w-14 "
    //     src="{{ asset('img/fotosProductos/1663371486-Majadito.jpg') }}" alt=""
    //    loading="lazy" />';

        let img_foto =  document.createElement('img');
        img_foto.className = 'm-1 border border-black rounded-2xl object-cover h-14 w-14'
        // img_foto.src = "https://dam.muyinteresante.com.mx/wp-content/uploads/2018/05/extranos-pueden-elegir-mejores-fotos-de-perfil.jpg";
        img_foto.src = "/img/fotosProductos/"+data[i]?.foto;
        img_foto.loading = "no hay foto";

        //console.log(img_foto);

        let divA= document.createElement('div');
        divA.className = "flex-col flex justify-center  p-2 w-full ";

        let p_nombre = document.createElement('p');
        p_nombre.className = "font-semibold font-mono";
        p_nombre.textContent =  data[i]?.nombre;

 //     console.log(p_nombre);
        let divB = document.createElement('div');
        divB.className = "flex justify-evenly font-mono px-4 space-x-2";

        let div_code = document.createElement('div');
        div_code.className = "flex flex-col text-xs  w-full text-left space-y-1";

                let p_code = document.createElement('p');
                p_code.className='bg-green-400 rounded-md px-1';
                p_code.textContent='C. PROD: '+ data[i]?.cod_producto;

                let p_oem = document.createElement('p');
                p_oem.className='bg-green-400 rounded-md px-1';
                p_oem.textContent='C. OEM: '+ data[i]?.cod_oem;

        div_code.appendChild(p_code);
        div_code.appendChild(p_oem);


        let div_precios = document.createElement('div');
        div_precios.className = "flex flex-col text-xs  w-full text-right space-y-1";

                let p_cant = document.createElement('p');
                p_cant.className='bg-yellow-300 rounded-md px-1';
                p_cant.textContent='STOCK: '+ data[i]?.cantidad;

                let p_precio = document.createElement('p');
                p_precio.className='bg-yellow-300 rounded-md px-1';
                p_precio.textContent='PRECIO:'+ data[i]?.precio_venta_con_factura +' Bs';
        
        div_precios.appendChild(p_cant);
        div_precios.appendChild(p_precio);



        // divB.appendChild(p_code);
        // divB.appendChild(p_cant);
        // divB.appendChild(p_precio);
        divB.appendChild(div_code);
        divB.appendChild(div_precios);

        divA.appendChild(p_nombre);
        divA.appendChild(divB);

        bt_buscados.appendChild(img_foto);
        bt_buscados.appendChild(divA);

        formulario.appendChild(bt_buscados);
        this.ListaP.appendChild(formulario);
        //console.log('LA id es:'+data[i].id );
        productos = this.ListaP.querySelectorAll(".bt_buscados");
        if(data.length > 0){
            console.warn('hay productos es mayor a 0');
            productos[0].classList.remove("bg-gray-200");
            productos[0].classList.add("bg-gray-400");
        }
        }//end for
    }

    //c es la posicion en donde se mostrara el c
    mostrarEnVentaCreate(data){

  //    this.ListaP.removeEventListener("click", this.miEvento);
        this.ListaP.innerHTML = "";
        // console.log(data.prod);
        // this.vaciarLista()
        

        // let listaProductos = document.getElementById("ListaProductos");
        let productosxd = this.ListaP.querySelectorAll(".bt_buscados");
        productosxd.forEach((element) => {
            this.ListaP.removeChild(element);
        });
        // console.log('se removio los hijos');
        // console.log(this.ListaP);


    //    console.warn('LLEGUE AL MOSTRAR EN VENTA');
    // restablecer el posicionamiento
        selectedProductoIndex = 0;

        for ( let i = 0; i < data.length; i++) {
        //    console.log(formulario);
            let bt_buscados = document.createElement('button');
            bt_buscados.className = "bt_buscados text-black text-sm bg-gray-200 rounded  flex items-center  w-56 sm:w-96 p-1  my-0.5 shadow-sm border border-gray-800 ";
            bt_buscados.id = 'bt_buscados'+i;
            bt_buscados.type = 'button';

            //crear el evento de caundo se de clip

            let img_foto =  document.createElement('img');
            img_foto.className = 'm-1 border border-black rounded-2xl object-cover h-14 w-14'
            // img_foto.src = "https://dam.muyinteresante.com.mx/wp-content/uploads/2018/05/extranos-pueden-elegir-mejores-fotos-de-perfil.jpg";
            img_foto.src = "/img/fotosProductos/"+data[i]?.foto;
            img_foto.loading = "no hay foto";

    //      console.log(img_foto);

            let divA= document.createElement('div');
            divA.className = "flex-col flex justify-center p-2 w-full ";

            let p_nombre = document.createElement('p');
            p_nombre.className = "font-semibold font-mono";
            p_nombre.textContent =  data[i]?.nombre;

    //       console.log(p_nombre);

            let divB = document.createElement('div');
            divB.className = "flex justify-evenly font-mono px-4 space-x-2";

            let div_code = document.createElement('div');
        div_code.className = "flex flex-col text-xs  w-full text-left space-y-1";

                let p_code = document.createElement('p');
                p_code.className='bg-green-400 rounded-md px-1';
                p_code.textContent='C. PROD: '+ data[i]?.cod_producto;

                let p_oem = document.createElement('p');
                p_oem.className='bg-green-400 rounded-md px-1';
                p_oem.textContent='C. OEM: '+ data[i]?.cod_oem;

        div_code.appendChild(p_code);
        div_code.appendChild(p_oem);


        let div_precios = document.createElement('div');
        div_precios.className = "flex flex-col text-xs  w-full text-right space-y-1";

                let p_cant = document.createElement('p');
                p_cant.className='bg-yellow-300 rounded-md px-1';
                p_cant.textContent='STOCK: '+ data[i]?.cantidad;

                let p_precio = document.createElement('p');
                p_precio.className='bg-yellow-300 rounded-md px-1';
                p_precio.textContent='PRECIO:'+ data[i]?.precio_venta_con_factura +' Bs';
        
        div_precios.appendChild(p_cant);
        div_precios.appendChild(p_precio);
    
        // divB.appendChild(p_code);
        // divB.appendChild(p_cant);
        // divB.appendChild(p_precio);
        divB.appendChild(div_code);
        divB.appendChild(div_precios);
        divA.appendChild(p_nombre);
        divA.appendChild(divB);

        bt_buscados.appendChild(img_foto);
        bt_buscados.appendChild(divA);

        this.ListaP.appendChild(bt_buscados);

            


            //crear evento al momento de dar clip al boton \
            bt_buscados.addEventListener('click',(e)=>{
                e.preventDefault();
                crearEventoClick(data[i]);
            } );

        };

        productos = this.ListaP.querySelectorAll(".bt_buscados");  
            if(data.length > 0){
                console.warn('hay productos es mayor a 0');
                productos[0].classList.remove("bg-gray-200");
                productos[0].classList.add("bg-gray-400");
        }
        console.log('cant pridutos:'+data.length);


    }

    //metodo para hacer eventos a los botones de la busqueda
    // ponerEventosTeclado(){

    //     let selectedProductoIndex = 0;
    //     let productos = this.ListaP.querySelectorAll(".bt_buscados");

    //     console.log('seleccionado:'+selectedProductoIndex);
    //     console.log(productos);
        
    //     productos[selectedProductoIndex].classList.remove("bg-gray-200");
    //     productos[selectedProductoIndex].classList.add("bg-gray-400");

    //     //cada que pase se debe eliminar este evento.
    //     this.mysearchp.addEventListener("keydown", function(e) {
    //         // e.preventDefault();
    //         console.log('se presiono una tecla');

    //         if (e.key === "Enter") {
    //             e.preventDefault();
    //             console.log('se presiono enter en ', 'i='+selectedProductoIndex);
    //             if (selectedProductoIndex >= 0) {
    //                 // Hacer clic en el producto seleccionado
    //                 productos[selectedProductoIndex].click();
    //                 //limpiar la lista de productos
    //                 // productos = listaProductos.querySelectorAll(".bt_buscados");
    //             }
    //         } else if (e.key === "ArrowDown") {
    //             e.preventDefault();
    //             console.log('se presiono abajo', 'i='+selectedProductoIndex);
    //             if (selectedProductoIndex < productos.length - 1) {
    //                 // Mover al siguiente producto en la lista
    //                 productos[selectedProductoIndex].classList.remove("bg-gray-400");
    //                 productos[selectedProductoIndex].classList.add("bg-gray-200");
    //                 selectedProductoIndex++;
    //                 productos[selectedProductoIndex].classList.remove("bg-gray-200");
    //                 productos[selectedProductoIndex].classList.add("bg-gray-400");
    //                 // productos[selectedProductoIndex].classList.add("selected");
    //                 console.log('se presiono abajo', 'i='+selectedProductoIndex);
    //             }else{
    //                 console.log('no entre', 'i='+selectedProductoIndex);
    //             }



    //         } else if (e.key === "ArrowUp") {
    //             e.preventDefault();
    //             console.log('se presiono arriba');
    //             if (selectedProductoIndex > 0) {
    //                 // Mover al producto anterior en la lista
    //                 productos[selectedProductoIndex].classList.remove("bg-gray-400");
    //                 productos[selectedProductoIndex].classList.add("bg-gray-200");
    //                 selectedProductoIndex--;
    //                 productos[selectedProductoIndex].classList.remove("bg-gray-200");
    //                 productos[selectedProductoIndex].classList.add("bg-gray-400");
    //                 console.log('se presiono arriba', 'i='+selectedProductoIndex);
    //             }
    //         }
    //     });


    // }

    // evento_teclado = (e) => {
    //     if (e.key === "Enter") {
    //         e.preventDefault();
    //         console.log('se presiono enter en ', 'i='+selectedProductoIndex);
    //         if (selectedProductoIndex >= 0) {
    //             // Hacer clic en el producto seleccionado
    //             productos[selectedProductoIndex].click();
    //             //limpiar la lista de productos
    //             // productos = listaProductos.querySelectorAll(".bt_buscados");
    //         }
    //     } else if (e.key === "ArrowDown") {
    //         e.preventDefault();
    //         // console.log('se presiono abajo', 'i='+i);
    //         if (this.electedProductoIndex < productos.length - 1) {
    //             // Mover al siguiente producto en la lista
    //             productos[selectedProductoIndex].classList.remove("bg-gray-400");
    //             productos[selectedProductoIndex].classList.add("bg-gray-200");
    //             selectedProductoIndex++;
    //             productos[selectedProductoIndex].classList.remove("bg-gray-200");
    //             productos[selectedProductoIndex].classList.add("bg-gray-400");
    //             // productos[selectedProductoIndex].classList.add("selected");
    //             console.log('se presiono abajo', 'i='+selectedProductoIndex);
    //         }
    //     } else if (e.key === "ArrowUp") {
    //         e.preventDefault();
    //         // console.log('se presiono arriba');
    //         if (selectedProductoIndex > 0) {
    //             // Mover al producto anterior en la lista
    //             productos[selectedProductoIndex].classList.remove("bg-gray-400");
    //             productos[selectedProductoIndex].classList.add("bg-gray-200");
    //             selectedProductoIndex--;
    //             productos[selectedProductoIndex].classList.remove("bg-gray-200");
    //             productos[selectedProductoIndex].classList.add("bg-gray-400");
    //             console.log('se presiono arriba', 'i='+selectedProductoIndex);
    //         }
    //     }
    // };


}

const crearEventoClick =(data) => {
    let input_code = document.getElementById('cod_oem' + ulitmaPos());
//  //       input_code.value = data[i]?.cod_oem;
    console.warn('evento click en el boton');
    // console.log(data);
    // console.log(input_code);
     if(input_code != null){
             if(input_code.value == ''){
                    console.log('el input es vacio');
                     input_code.value = data?.cod_producto;
                    buscarCod(input_code.value,  ulitmaPos());
            }else{
                //darle clip al boton adicionar
                    console.log('el input no es vacio');
                    //se le da click al boton adicionar
                    document.getElementById('button_adicionar').click();
                    let input_code_xd = document.getElementById('cod_oem' + ulitmaPos());
              //       console.log(input_code_xd);
                    input_code_xd.value = data?.cod_producto;
                 //   console.log('se va buscar en'+ ulitmaPos());
                    buscarCod(input_code_xd.value,  ulitmaPos());
            }
     }else{
        document.getElementById('button_adicionar').click();
            let input_code_xd = document.getElementById('cod_oem' + ulitmaPos());
            // // console.log(input_code_xd);
            input_code_xd.value = data?.cod_producto;
            console.log('se va buscar en'+ ulitmaPos());
            buscarCod(input_code_xd.value,  ulitmaPos());
     }

    document.getElementById('ListaProductos').innerHTML = "";
    document.getElementById('mysearch').value ='';
}

// let desactivarEvento = document.getElementById('holaxd');
// console.log(desactivarEvento);
// desactivarEvento.addEventListener('click', (e) => {
//     e.preventDefault();
//     console.log('se desactivo el evento');
//     let listaP = document.getElementById('ListaProductos');
//     let productos = listaP.querySelectorAll(".bt_buscados");
//     console.log(productos);
    

//     productos.forEach(element => {
//         // element.removeEventListener('click',crearEventoClick);
//         element.removeEventListener('click',(e)=>{
//             e.preventDefault();
//             // crearEventoClick(data[i]);
//         } );
//     });
//     // this.mysearchp.removeEventListener("keydown", this.evento_teclado );
// });


//  //metodo para hacer eventos a los botones de la busqueda

    let selectedProductoIndex = 0;
    const ListaProd = document.getElementById('ListaProductos'); 
    let productos = ListaProd.querySelectorAll(".bt_buscados");
    const input_buscar = document.getElementById('mysearch');

    console.log('seleccionado:'+selectedProductoIndex);
    // console.log('productos:'+ productos);
    

    //cada que pase se debe eliminar este evento.
    input_buscar.addEventListener("keydown", function(e) {
        // e.preventDefault();
        console.log('se presiono una tecla');
        // console.log( productos );

        if (e.key === "Enter") {
            e.preventDefault();
            console.log('se presiono enter en ', 'i='+selectedProductoIndex);
            if (selectedProductoIndex >= 0) {
                // Hacer clic en el producto seleccionado
                productos[selectedProductoIndex].click();
                //limpiar la lista de productos
                // productos = listaProductos.querySelectorAll(".bt_buscados");
            }
        } else if (e.key === "ArrowDown") {
            e.preventDefault();
            console.log('se presiono abajo', 'i='+selectedProductoIndex);
            if (selectedProductoIndex < productos.length - 1) {
                // Mover al siguiente producto en la lista
                productos[selectedProductoIndex].classList.remove("bg-gray-400");
                productos[selectedProductoIndex].classList.add("bg-gray-200");
                selectedProductoIndex++;
                productos[selectedProductoIndex].classList.remove("bg-gray-200");
                productos[selectedProductoIndex].classList.add("bg-gray-400");
                // productos[selectedProductoIndex].classList.add("selected");
                console.log('se presiono abajo', 'i='+selectedProductoIndex);
            }else{
                console.log('no entre', 'i='+selectedProductoIndex);
            }



        } else if (e.key === "ArrowUp") {
            e.preventDefault();
            console.log('se presiono arriba');
            if (selectedProductoIndex > 0) {
                // Mover al producto anterior en la lista
                productos[selectedProductoIndex].classList.remove("bg-gray-400");
                productos[selectedProductoIndex].classList.add("bg-gray-200");
                selectedProductoIndex--;
                productos[selectedProductoIndex].classList.remove("bg-gray-200");
                productos[selectedProductoIndex].classList.add("bg-gray-400");
                console.log('se presiono arriba', 'i='+selectedProductoIndex);
            }
        }
    });




