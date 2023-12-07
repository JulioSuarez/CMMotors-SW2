let agregar = document.getElementById('button_adicionar');
let eliminados = [];
let monto1 = 0; //monto toal
let i = document.getElementById('len_detalles').value;
console.warn('LEN LLEGO COMO'+i);


// crearEventListeners(1);
for (let x = 1; x <= i; x++) {
    crearEventListeners(x);
    let precio = parseFloat(document.getElementById('subtotal' + x).value);
    monto1 = Number((monto1 + precio).toFixed(2));
    document.getElementById('monto_total').value = monto1;
    arrayMonto[x - 1] = precio;
    // console.log('monot totla:' +monto1);
}


//caundo se haga un clink en el boton
agregar.addEventListener('click', e => {
    //prevenir el evnto que viene por efauld
    e.preventDefault();
    let tabla = document.getElementById('tabla')

    i++;

    //gtr
    let tr = document.createElement('tr');
    tr.className = "trtr "
    tr.id = 'tr' + i;

    //item
    let td1 = document.createElement('td');
    td1.className = "border border-gray-300 lg:w-20 xl:w-28 ";

    //ocde oem
    let td2 = document.createElement('td');
    td2.className ="border border-gray-300";
    td2.id = 'td_code_'+ i;

    //detalles
    let td3 = document.createElement('td');
    td3.className = "border border-gray-300";

    //ver producto
    let td4 = document.createElement('td');
    td4.className = "border border-gray-300 h-11 w-full flex justify-center ";

    //cantidad
    let td5 = document.createElement('td');
    td5.className = "border border-gray-300";
    td5.id = 'td_cantidad_'+ i;

    //precio
    let td6 = document.createElement('td');
    td6.className = "border border-gray-300";
    td6.id = 'td_precio_'+ i;

    //subtotal
    let td7 = document.createElement('td');
    td7.className = "border border-gray-300";

    //eliminar
    let td8 = document.createElement('td');
    td8.className = "border border-gray-300 text-center  ";

    //unidad
    let td10 = document.createElement('td');
    td10.className = "border border-gray-300  ";

    //costo de producto y tiempo de entrega estan mas abajo!!


    let inp_item = document.createElement('input');
    inp_item.className = "outline-none text-center font-medium text-black w-full ";
    inp_item.id = 'item' + i;
    inp_item.autocomplete = 'off';
    inp_item.setAttribute('disabled', '');
    // inp_item.disabled;

    let inp_cod = document.createElement('input');
    inp_cod.className = " outline-none text-center text-xs uppercase font-bold text-black w-16 lg:w-28 xl:w-36 h-full py-2";
    inp_cod.placeholder = 'buscar...';
    inp_cod.id = 'cod_oem' + i;
    inp_cod.name = 'cod_oem[]';
    inp_cod.type = 'text';
    inp_cod.autocomplete="off";



    let inp_unidad = document.createElement('input');
    inp_unidad.className = "outline-none text-center text-xs uppercase font-bold text-black w-16 h-full py-2";
    inp_unidad.value= 'PZA';
    inp_unidad.id = 'unidad_co' + i;
    inp_unidad.name = 'unidad_co[]';
    inp_unidad.type = 'text';
    inp_unidad.autocomplete="off";

    let inp_detalle = document.createElement('input');
    inp_detalle.className = "outline-none text-left font-medium text-black w-52  sm:w-72  lg:w-96 h-full p-2  text-xs";
    inp_detalle.placeholder = 'Detalle';
    inp_detalle.id = 'detalles' + i;
    inp_detalle.name = 'detalles[]';
    inp_detalle.autocomplete="off";

    //boton ver producto
    let bt_ver = document.createElement('button');
    bt_ver.className = 'outline-none py-0.5 px-1 m-1 xl:px-3   bg-blue-600 text-white justify-center rounded-lg leading-tight shadow-xl text-xs hover:bg-blue-500';
    bt_ver.id="bt_abrir_modal"+i;
    bt_ver.type="button";
    bt_ver.textContent = 'Ver Producto';

        //adicionar con el metodo innerjtml para cerrar
        let div_modal =  document.createElement('dialog');
        div_modal.id="myModal"+i;
        div_modal.className ='h-1/1 w-80 lg:w-96  p-3 rounded-2xl ';

        let bt_cerrar_modal = document.createElement('button');
        bt_cerrar_modal.id = 'bt_cerrar_modal'+i;
        bt_cerrar_modal.type = 'button';
        bt_cerrar_modal.className = 'cursor-pointer absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600';
        bt_cerrar_modal.innerHTML+=' <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" /> <line x1="18" y1="6" x2="6" y2="18" /> <line x1="6" y1="6" x2="18" y2="18" /> </svg>'



        let div_principal =  document.createElement('div');
        div_principal.className =" h-auto lg:px-4  px-2";

        let p_nombre =  document.createElement('p');
        p_nombre.className = "text-base font-extrabold  uppercase font-serif text-center py-1 pr-2";
        p_nombre.textContent = 'NOMBRE DE PRODUCTO';
        p_nombre.id = 'p_nombre_prod'+i;

        let div_img_flex = document.createElement('div');
        div_img_flex.className = 'flex justify-around aspect-w-4 aspect-h-5 sm sm:rounded-lg lg:aspect-w-3 lg:aspect-h-4'

            let img_foto =  document.createElement('img');
            img_foto.className = ' flex justify-around aspect-w-4 aspect-h-5 sm sm:rounded-lg lg:aspect-w-3 lg:aspect-h-4 '
            // img_foto.src = "https://dam.muyinteresante.com.mx/wp-content/uploads/2018/05/extranos-pueden-elegir-mejores-fotos-de-perfil.jpg";
            img_foto.src = "/img/fotosProductos/default.png";
            img_foto.loading = "no hay foto";
            img_foto.width ='80';
            img_foto.id = 'img_producto_venta'+i;


            let div_importantes = document.createElement('div');
            div_importantes.className = 'w-full flex flex-col justify-around ml-1 px-2 sm:px-4 font-bold text-sm';

            let div_precios = document.createElement('div');
            div_precios.className = 'flex justify-between py-1 border-b border-gray-300';
                let p_precio =  document.createElement('p');
                p_precio.textContent='Precio C/F: ';
                let p_resp_precio =  document.createElement('p');
                p_resp_precio.className = 'text-gray-500 pr-2'
                p_resp_precio.id='p_precio_fact_prod'+i;
                div_precios.append(p_precio,p_resp_precio);

            let div_ubicacion = document.createElement('div');
            div_ubicacion.className = 'flex justify-between py-1 border-b border-gray-300';
                let p_estante =  document.createElement('p');
                p_estante.textContent='Estante: ';
                let p_resp_estante =  document.createElement('p');
                p_resp_estante.id='p_estante_prod'+i;
                p_resp_estante.className='text-gray-500 pr-2';
                div_ubicacion.append(p_estante,p_resp_estante);

            let div_stock = document.createElement('div');
            div_stock.className = 'flex justify-between py-1 border-b border-gray-300';
                let p_cantidad =  document.createElement('p');
                p_cantidad.textContent='Cantidad: ';
                let p_resp_cantidad =  document.createElement('p');
                p_resp_cantidad.id='p_cantidad_prod'+i;
                p_resp_cantidad.className='text-gray-500 pr-2';
                div_stock.append(p_cantidad,p_resp_cantidad);

            div_importantes.append(div_precios,div_ubicacion,div_stock)
            div_img_flex.append(img_foto,div_importantes);

            let div_descripcion = document.createElement('div');
            div_descripcion.className =" mx-2 mt-4 mb-0";

            let p_descripcion =  document.createElement('p');
            p_descripcion.className = "text-sm mb-2 font-medium text-gray-900";
            p_descripcion.textContent='Descripcion';

            let ul =  document.createElement('ul');
            ul.className ="list-disc space-y-2 pl-4 mb-2 text-sm";

            //crear funcoin que te cre la li
            ul.append(crearLI(i,'pro','Codigo Producto: '));
            ul.append(crearLI(i,'alt','Codigo OEM: '));
            ul.append(crearLI(i,'precio_comp','Precio Compra: '));
            ul.append(crearLI(i,'precio_sin_fact','Precio S/Factura:'));
            ul.append(crearLI(i,'marca','Marca: '));
            ul.append(crearLI(i,'procedencia','Procedencia: '));
            ul.append(crearLI(i,'origen','Origen:'));
            ul.append(crearLI(i,'stock_min','Cant Minima: '));
            ul.append(crearLI(i,'vence','Vence: '));
            ul.append(crearLI(i,'proveedor','Proveedor: '));

            // ul.append(li1,li11,li12,li2,li3,li4,li5,li6,li7);
            div_descripcion.append(p_descripcion,ul);
            div_principal.append(p_nombre,div_img_flex,div_descripcion);

            div_modal.append(bt_cerrar_modal,div_principal);


    let div_cantidad = document.createElement('div');
    div_cantidad.className = "flex  justify-center w-full h-full items-center";

    let inp_cantidad = document.createElement('input');
    inp_cantidad.className = "outline-none  text-center font-medium w-10 px-1 text-black";
    inp_cantidad.value = 1;
    inp_cantidad.id = 'cantidad' + i;
    inp_cantidad.name = 'cantidad[]';
    inp_cantidad.type = 'number';
    inp_cantidad.min = '1';

    // let div_cantidad_icons = document.createElement('div');
    // div_cantidad_icons.className = "flex items-center mr-0.5  justify-between"

    let bt_sumar = document.createElement('button');
    bt_sumar.id = 'button_sumar'+i;

    let svg_sumar = document.createElementNS('http://www.w3.org/2000/svg','svg');
    svg_sumar.setAttribute('class','w-4 h-4 text-gray-800 ');
    svg_sumar.style.fill="none";
    svg_sumar.style.stroke="currentColor";
    svg_sumar.style.strokeWidth = "3.5";
    svg_sumar.setAttribute('viewBox','0 0 24 24');

    let path_sumar = document.createElementNS('http://www.w3.org/2000/svg','path');
    path_sumar.style.strokeLinecap = "round";
    path_sumar.style.strokeLinejoin = "round";
    path_sumar.setAttribute('d',"M12 4.5v15m7.5-7.5h-15");

    let bt_restar = document.createElement('button');
    bt_restar.id = 'button_restar'+i;

    let svg_restar = document.createElementNS('http://www.w3.org/2000/svg','svg');
    svg_restar.setAttribute('class','w-4 h-4 text-gray-800');
    svg_restar.style.fill="none";
    svg_restar.style.stroke="currentColor";
    svg_restar.style.strokeWidth = "3.5";
    svg_restar.setAttribute('viewBox','0 0 24 24');

    let path_restar = document.createElementNS('http://www.w3.org/2000/svg','path');
    path_restar.style.strokeLinecap = "round";
    path_restar.style.strokeLinejoin = "round";
    path_restar.setAttribute('d',"M19.5 12h-15");

    svg_sumar.appendChild(path_sumar);
    svg_restar.appendChild(path_restar);
    bt_sumar.appendChild(svg_sumar);
    bt_restar.appendChild(svg_restar);
    div_cantidad.appendChild(bt_restar);
    div_cantidad.appendChild(inp_cantidad);
    div_cantidad.appendChild(bt_sumar);


    let inp_precio = document.createElement('input');
    inp_precio.className = "outline-none  text-center font-medium text-black w-20 xl:w-28  p-1";
    inp_precio.type = 'number';
    inp_precio.step = '0.01';
    inp_precio.value = 0;
    inp_precio.id = 'precio' + i;
    inp_precio.name = 'precio[]';

    let inp_subtotal = document.createElement('input');
    inp_subtotal.className ="outline-none text-center font-medium text-black w-24 xl:w-28 p-1";
    inp_subtotal.type = 'number';
    inp_subtotal.step = '0.01';
    inp_subtotal.value = 0;
    inp_subtotal.id = 'subtotal' + i;
    inp_subtotal.name = 'subtotal[]';
    inp_subtotal.setAttribute('readOnly', '');


    let bt_eliminar = document.createElement('button');
    bt_eliminar.id = "button_eliminar" + i;
    bt_eliminar.name = "button_eliminar" + i;
    //bt_eliminar.innerHTML = "Eli";
    bt_eliminar.className ="font-medium text-black";


    let svg_button = document.createElementNS('http://www.w3.org/2000/svg','svg');
    svg_button.setAttribute('class','w-6 h-6 text-black  hover:text-white rounded-full hover:bg-red-500');
    svg_button.style.fill="none";
    svg_button.style.stroke="currentColor";
    svg_button.viewBox="0 0 24 24";

    let path_button = document.createElementNS('http://www.w3.org/2000/svg','path');
    path_button.style.strokeLinecap = "round";
    path_button.style.stroke = "round";
    path_button.style.strokeWidth = "2"
    path_button.setAttribute('d',"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16");


     svg_button.appendChild(path_button);
     bt_eliminar.appendChild(svg_button);

    tr.append(td1,td2,td10,td3,td4);

    //crar el input de tiempo de entrega solo si, se esta en en la vista cotizacion
    let conf_cotizacion = document.getElementById('verificar_solo_vista_Cotizacion');
    // console.warn(conf_cotizacion)
    if(conf_cotizacion.value == 'si esta en cotizacoin'){
        console.warn('entre a editr!!')
        //crear input de teinpo de entrega
        let inp_tiempo_ent = document.createElement('input');
        inp_tiempo_ent.className = 'outline-none w-24   text-center';
        inp_tiempo_ent.name = "tiempo_entrega[]";
        inp_tiempo_ent.type = 'text';
        inp_tiempo_ent.placeholder = '---';


        let td9 = document.createElement('td');
        td9.className = "border border-gray-300 text-black text-center";

        td9.appendChild(inp_tiempo_ent);
        tr.append(td9,td5); //se adiciono el campo tiempo de entrga y cantidad

    }else{
        console.log('estoy en la vista create!!')
        //se creara el campo conto de prodcuto
        let inp_costop = document.createElement('input');
        inp_costop.className ="outline-none text-center font-medium text-black w-20 xl:w-28 p-1";
        inp_costop.type = 'number';
        inp_costop.step = '0.01';
        inp_costop.value = 0;
        inp_costop.id = 'costop' + i;
        inp_costop.name = 'costop[]';

        let td11 = document.createElement('td');
        td11.className = "border border-gray-300 text-center";

        td11.appendChild(inp_costop);
        // console.log(td11)
        tr.append(td5,td11);  //se adiciono el campo cantidad y tiempo de entrega
    //    console.log(tr)
        console.log('sali!! de la vista create!!')
    }

    tr.append(td6,td7,td8);

    td1.appendChild(inp_item);
    td2.appendChild(inp_cod);
    td3.appendChild(inp_detalle);
    td4.appendChild(div_modal);
    td4.appendChild(bt_ver);
    td5.appendChild(div_cantidad);
    td6.appendChild(inp_precio);
    td7.appendChild(inp_subtotal);
    td8.appendChild(bt_eliminar);
    td10.appendChild(inp_unidad);


    tabla.appendChild(tr);
    // console.log(tabla);
    disminuir_item();//para ordenar los items
    crearEventListeners(i);


}); //fin del boton adicoinar



//----------------------------------------------metodos!!!-----------------------------------------------------------

// let li1 =  document.createElement('li');
// let span_1 =document.createElement('span');
// span_1.className="text-gray-600";
// span_1.textContent = 'Code Alternativo: '
// span_1.id='p_alt'+i;
// li1.appendChild(span_1);
const crearLI = (i,name,mensaje) =>{
    // console.log('LLEGUE!!!!!!!')
    let li =  document.createElement('li');
    li.className = 'mb-3 ';
    let div = document.createElement('div');
    div.className = 'flex justify-between border-b border-gray-300';
    let p = document.createElement('p');
    p.className = 'font-semibold';
    p.textContent = mensaje;
    let p2 = document.createElement('p');
    p2.className = 'pr-4';
    p2.id = 'p_'+name+i;
    // console.log(p2);

    // console.log(p2.id);
    // padre.append(li.append(div.append(p,p2)));
    div.append(p,p2);
    li.append(div);


    // console.log('ME SALI!!!!!!!')
    return li;
}


const ulitmaPos = () => {
    for (let x = i; x > 0; x--) {
        if (!esta_eliminados(x)) {
            //devuelve eso
            return x;
        }
    }
    return 0;
}


const esta_eliminados = (k) => {
    for (let x = 0; x < eliminados.length; x++) {
        if (k == eliminados[x]) {
            return true;
        }
    }
    return false;
}

//l es la id del tr
const disminuir_item = () => {
    let xx = 0; //contador de iteam
    for (let x = 1; x <= i; x++) {
        if (esta_eliminados(x) == false) {
            xx++;
            //        console.log('entree con'+x)
            //  let table = document.getElementById('tabla');
            let item = document.getElementById('item' + x);
        //    console.log('estando en disminuoir:'+item);
            item.value = xx;

        } else {// console.log('elimadno la fila:' + x)
                 //if()
           //     console.warn('contador Item: '+contadorItem);
                }
        contadorItem = xx;

    //console.warn('El contador termino en: '+contadorItem);
        // console.warn('contador XX: '+contadorItem);
        // console.warn('se uso una i de : '+i);

    }
}



//retorna el precio si es que hubo un movimiento
const precio_totalxd = (k) => {
    // console.warn('LLEGUE A PRECIO');
    // console.warn('K = ' + k);
    let inp_precio = (document.getElementById('precio' + k));
    //HUBO ALGUN MOVIENOT
    if (esta_eliminados(k) == false) {
        //console.log(inp_precio);
        inp_precio.addEventListener('keyup', e => {

            e.preventDefault();
            // console.log('entre');
            // console.log(inp_precio);
            return inp_precio.value;
        });
        // console.log('no entre');
    }
    // console.log('esty devolciendo' + 5);
    return 5;
}


const enQuePosicionEstoy = (code_id) => {
    // console.warn('sacar el numero de'+ code_id);
    code_id = sacarNum(code_id);
    // console.warn('el numeor a verificar es :'+ code_id);
    let cc = 0; //si devuelve cero significa que no se encontro el code_id
    for (let x = 1; x <= i; x++) {
        if(!esta_eliminados(x)){
            cc++;
            if (x == code_id)
                return cc
        }

    }
    return 0;
}


//funcion que solo saco los numeros de un caracter
const sacarNum = (code_id) => {
    let num = 0;
    for (let i = 0; i <code_id.length; i++) {
        if (!isNaN(code_id[i])) {
            // console.log(code_id[i])
            num = num*10+parseInt(code_id[i]);
        }

    }
    return num;
}




let bt_abrir_general = document.getElementById('boton_abrir');
let div_menu = document.getElementById('div_menu');
// let svg_datos_general = document.getElementById('svg_datos_general');
let estado_bt_abrir = false;

bt_abrir_general.addEventListener('click',(e)=>{
    e.preventDefault();
    // console.log('le di click');
    div_menu.classList.toggle('hidden')
    if(estado_bt_abrir){
        estado_bt_abrir = false;
        bt_abrir_general.innerHTML = 'DATOS GENERALES <svg id="svg_datos_general" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-6  "> <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25" /> </svg>';
    }else{
         estado_bt_abrir = true;
        bt_abrir_general.innerHTML = 'DATOS GENERALES <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-6"> <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h5.25m5.25-.75L17.25 9m0 0L21 12.75M17.25 9v12" /> </svg>'

    }

})

