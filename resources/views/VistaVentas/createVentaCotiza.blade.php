@extends('navegador')

@section('Contenido')
@vite(['resources/js/livewire_events.js'])
    <link rel="stylesheet" href="{{ asset('css/desabilitarInputNumber.css') }}" />

    <style>
        dialog[open] {
            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
        }

        dialog::backdrop {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
            backdrop-filter: blur(3px);
        }


        @keyframes appear {
            from {
                opacity: 0;
                transform: translateX(-3rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    {{-- <div class="lg:bg-blue-500 md:bg-red-300 xl:bg-yellow-400 2xl:bg-purple-600 sm:bg-black bg-gray-400">
    <label>
        celu11 = plomo,
        sm 640px = black ,
        md 768px = rojo ,
        lg 1024px = azul ,
        xl 1280px = amariilo ,
        2xl 1536px = purpura ,
    </label>
</div> --}}

{{-- @dd('llegamos a detalles') --}}

<div class="grid grid-cols-1 sm:grid-cols-4 p-4 px-6  ">
    <h1 class="dark:text-gray-100 sm:text-base text-lg  text-center text-gray-900 font-semibold tracking-normal leading-tight sm:col-span-3">
        PASAR DE COTIZACION A VENTA
    </h1>
    <div class=" text-left sm:text-right items-center  mt-4 sm:mt-0">
        <form action="{{Route('Venta.volverCotizacion',$id_cot)}}" method="POST">
            @csrf
            @method('PUT')
             <button type="submit" class="text-gray-100 bg-red-600 text-xs font-semibold rounded-lg py-1 px-2" >
                Cancelar Venta
             </button>
        </form>
    </div>
</div>


    <form id="form"  action="{{ Route('Venta.store') }}" method="post">
        @csrf
        @method('POST')
        <div class=" w-full xl:px-4 ">
            <!--container max-w-lg-->

            <div class="py-1 px-6 max-w-full mx-5 bg-white rounded-xl ">
                <!--container max-w-lg -->

                <p class=" text-gray-500 font-bold mt-2 " for="">Empleado: {{ $venta->nombre }}
                    {{ $venta->apellido }} </p>

                <input type="number" name="ci_empleado" id="" value="{{ $venta->ci }}" hidden>
                <input type="number" name="id_venta" id="" value="{{ $venta->id }}" hidden>
                <input type="text" name="ventana" id="" value="edit_ventas" hidden>


                <div class="flex justify-between">
                    <label for="ci_autocomplete" class="text-gray-800  text-sm font-bold leading-tight tracking-normal">
                        NIT/CI/CEX/P:
                    </label>
                    <p id="ci_cliente_error" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>

                <div class="relative mt-0 mb-1">
                    <div class="absolute text-gray-600 flex items-center px-4 border-r h-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <rect x="3" y="5" width="18" height="14" rx="3" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                            <line x1="7" y1="15" x2="7.01" y2="15" />
                            <line x1="11" y1="15" x2="13" y2="15" />
                        </svg>
                    </div>
                    <input
                        class="text-gray-500 focus:outline-none pl-16  text-sm border-gray-300 rounded border
                     focus:border focus:border-blue-900  font-normal w-full h-8 flex items-center "
                        id="ci_autocomplete" name="ci_cliente" type="number" autofocus="true" autocomplete="off"
                        value="{{ old('ci_cliente', $cliente->ci) }}" />
                </div>

                <div class="relative">
                <div class="flex justify-between">
                    <label for="cliente" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Señor(es):
                    </label>
                    <p id="cliente_error" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>
                @livewire('autorelleno-cliente',['cliente' => $cliente->nombre,])
            </div>


                <div class="flex justify-between">
                    <label for="telefono"
                        class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Telefono:</label>
                        <p id="telefono_error" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>
                <input id="telefono"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="telefono" type="number" autocomplete="off" value="{{ old('telefono', $cliente->telefono) }}" />
            </div>
        </div>

        <div id="div_prod_no_encontrado"
            class=" lg:flex lg:justify-between lg:flex-row-reverse   mt-5 mx-6 text-xs sm:text-sm xl:px-4">
            <p>*Nota: puede usar el buscador de arriba por si no recuerda el codigo exacto de algun producto</p>
            <p id="p_no_encontrado" class="text-red-400 ">
                @foreach ( $mensaje as $m)
                {{$m}}
                <input type="hidden" class="men"  value="{{$m}}">
                @endforeach
            </p>
            <input type="hidden" id="pruebxd"  value="{{$mensaje[0]}}">
        </div>

        <div class=" max-w-full  xl:mx-9 mx-5 rounded-lg  bg-white shadow-lg border-black border-2 ">
            <div class="overflow-x-auto w-full rounded-t-lg ">
                <table class="table-fixed border-gray-300 border">
                    <thead class="text-xs  font-semibold uppercase text-gray-600 bg-gray-300">
                        <tr>
                            <th class="p-2 xl:px-5 ">
                                <div class="font-semibold text-center">Nro item</div>
                            </th>
                            <th class="p-2 xl:px-5 ">
                                <div class="font-semibold text-center ">Codigo Producto</div>
                            </th>
                            <th class="p-1 ">
                                <div class="font-semibold text-center ">Unidad </div>
                            </th>
                            <th class="px-8  xl:px-5 ">
                                <div class="font-semibold text-left">Detalles</div>
                            </th>
                            <th class="px-1 xl:px-5">
                                <div class="font-semibold text-center">Ver Producto</div>
                            </th>
                            <th class=" px-3">
                                <div class="font-semibold text-center">Cantidad</div>
                            </th>
                            <th class="p-2 xl:px-2">
                                <div class="font-semibold text-center">Costo Producto</div>
                            </th>
                            <th class="p-2 2xl:px-5">
                                <div class="font-semibold text-center">Precio Venta</div>
                            </th>
                            <th class="p-2 xl:px-5">
                                <div class="font-semibold text-center">Sub Total</div>
                            </th>
                            <th class="p-2 2xl:px-5">
                                <div class="font-semibold text-center">Eliminar</div>
                            </th>
                        </tr>
                    </thead>

                    <tbody id="tabla" class="text-base ">
                        <!-----------=----------sadfasfasfasf-----------------------asdff----------------------------------->

                        @php  $len = count($detalles);  @endphp
                        <input type="hidden" id="len_detalles" value="{{ $len }}">
                        @for ($i = 1; $i <= $len; $i++)
                            {{-- @dd($detalles[$i]->detalle) --}}
                            <tr class="trtr  " id="tr{{ $i }}">
                                <td class=" border border-gray-300    lg:w-20 xl:w-28">
                                    <input type="number" class=" text-center font-medium text-black w-full "
                                        id="item{{ $i }}" value="{{ $i }}" autocomplete="off"
                                        disabled>
                                </td>
                                <td class="border border-gray-300" id="td_code_{{ $i }}">
                                    <input type="text"
                                        class="outline-none text-center text-xs uppercase font-bold text-black w-16 lg:w-28 xl:w-36 h-full py-2 "
                                        name="cod_oem[]" placeholder="buscar...'" id="cod_oem{{ $i }}"
                                        autocomplete="off" value="{{ $detalles[$i - 1]->cod_producto }}">

                                </td>
                                <td class="border border-gray-300 " >
                                    <input type="text"
                                        class=" outline-none text-center text-xs uppercase font-bold text-black w-16 h-full py-2 "
                                        name="unidad_co[]" value="{{ $detalles[$i - 1]->unidad_co }}" id="unidad_co{{ $i }}" autocomplete="off"  >

                                </td>
                                <td class="border border-gray-300 ">
                                    <input type="text"
                                        class="outline-none text-left font-medium text-black w-52  sm:w-72  lg:w-96 h-full p-2  text-xs "
                                        name="detalles[]" placeholder="Detalle" id="detalles{{ $i }}"
                                        autocomplete="off" value="{{ $detalles[$i - 1]->detalle }}">
                                </td>


                                {{-- botono para ver prodcutos --}}
                                <td class="border border-gray-300 h-11 w-full flex justify-center">
                                    @include('VistaVentas.modelProductosEdit')

                                    <button id="bt_abrir_modal{{ $i }}" type="button"
                                        class="py-0.5 px-1 m-1 xl:px-3   bg-blue-600 text-white justify-center rounded-lg leading-tight shadow-xl text-xs
                                         hover:bg-blue-500">
                                        Ver Producto
                                    </button>
                                    {{-- <p class="text-black">hola</p> --}}
                                </td>


                                <td class="border border-gray-300"  id="td_cantidad_{{ $i }}">
                                    <div class="flex  justify-center w-full h-full items-center">
                                        <!-- w-full h-full -->
                                        <button id="button_restar{{ $i }}">
                                            <svg class="w-4 h-4 text-gray-800 " xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="3.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </button>

                                        <input type="number" class="outline-none  text-center font-medium w-10 px-1 text-black "
                                            name="cantidad[]" id="cantidad{{ $i }}"
                                            value="{{ $detalles[$i - 1]->cantidad_venta }}" min="1">

                                        <button id="button_sumar{{ $i }}" class="">
                                            <svg class="w-4 h-4 text-gray-800 " xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="3.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>

                                </td>

                                {{-- adicionado// COSTO PRODUCTO --}}
                                <td class="border border-gray-300 text-center ">
                                    <input class="outline-none text-center font-medium text-black w-20 xl:w-28 p-1"
                                        name="costop[]" id="costop1" value="{{ $detalles[$i - 1]->precio_compra }}"
                                        type="number" step="0.01" min="0" >
                                </td>

                                <td class="border border-gray-300" id="td_precio_{{ $i }}">
                                    <input class="outline-none text-center font-medium text-black w-20 xl:w-28   p-1"
                                        name="precio[]" id="precio{{ $i }}"
                                        value="{{ $detalles[$i - 1]->precio_producto_unitario }}" type="number"
                                        step="0.01" min="0">
                                </td>
                                <td class="border border-gray-300">
                                    <input class="outline-none text-center  font-medium text-black w-24 xl:w-28  p-1"
                                        name="subtotal[]" id="subtotal{{ $i }}"
                                        value="{{ $detalles[$i - 1]->precio }}" type="number" step="0.01" readonly
                                        min="0">
                                </td>

                                {{-- botono de elimniar --}}
                                <td class="border border-gray-300 text-center ">
                                    {{-- <div class="flex justify-center"> --}}
                                    <button id="button_eliminar{{ $i }}" class=" font-medium text-black    ">
                                        <svg class="w-6 h-6 text-black  hover:text-white rounded-full hover:bg-red-500 "
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>


                                </td>
                            </tr>
                        @endfor

                        <!-----------=----------sadfasfasfasf-----------------------asdff----------------------------------->


                </table>
            </div>



            <div class="flex justify-between pt-1 px-1">
                <div class="flex-initial ml-1 ">
                    <button type="submit" id="button_adicionar"
                        class="flex items-center px-1 py-2 font-medium tracking-wide text-white capitalize   hover:text-green-900  focus:outline-none transition duration-300 transform active:scale-95 ease-in-out text-sm  ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class=" sr-only sm:not-sr-only text-xs sm:text-sm ml-1  text-green-700">Adicionar</span>
                    </button>

                </div>

                <div class="border rounded hover:bg-gray-200 flex  items-center h-9 px-1">
                    <a href="{{Route('Producto.create')}}" class="text-black font-semibold flex  ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6 pr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                          </svg>
                          Crear
                          <p class="sm:pl-1 sr-only sm:not-sr-only ">Producto</p>
                    </a>
                </div>


                <div class=" m-2 xl:mr-5 sm:mr-3 text-sm  ">
                    <label class="font-semibold  text-black  ">Monto total:</label>
                    <input class="w-28 h-7 bg-gray-300 text-black text-center  border-2 rounded-lg  border-gray-400"
                        type="number" name="monto_total" id="monto_total" value="{{ $venta->monto_total }}" readonly
                        step="0.01">

                    <label class="text-black "></label>

                </div>
            </div>



            <div class="grid grid-cols-1 sm:grid-cols-2">
                <div class="flex flex-col ml-3 ">
                    <label for="nota" class=" text-sm text-black font-semibold">NOTA:</label>
                    {{-- <input type="text" name="nota" value="DONDE INDIQUE EL CLIENTE"
                    class="border-b border-gray-900 text-xs text-gray-300 max-w-full mx-5  mb-3  outline-none"> --}}
                    <textarea name="nota"
                     class="p-1 border border-gray-700 text-xs text-black  mx-5  mb-3  h-16 outline-none "> Al momento de emitir su Orden de Compra, favor de adjutar la presente cotización.</textarea>
                </div>



                <div class=" p-2  ">
                    <button id="boton_abrir"  type="button" class="flex justify-center w-full bg-cyan-800 text-gray-200 py-1 pl-3 border border-black rounded">
                        DATOS GENERALES
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-6  ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25" />
                          </svg>
                    </button>

                    <div id="div_menu" class="hidden bg-white  mt-1 py-2 px-4 border border-black rounded">
                        <div class="flex flex-col">
                            <label for="fpago" class=" text-sm text-black font-semibold">FORMA DE PAGO:</label>
                            <input type="text" name="fpago" value="CREDITO 30 DIAS DESPUES DE LA FACTURACION"
                            class="border-b border-gray-900 text-xs text-black max-w-full mr-5 pl-5   mb-3  outline-none">
                        </div>

                        <div class="flex flex-col">
                            <label for="cheque" class=" text-sm text-black font-semibold">CHUEQUE A NOMBRE DE:</label>
                            <input type="text" name="cheque" value="ERNESTO EDIL CLAROS MELGAR"
                            class="border-b border-gray-900 text-xs text-black max-w-full mr-5 pl-5   mb-3  outline-none">
                        </div>

                        <div class="flex flex-col">
                            <label for="cuenta" class=" text-sm text-black font-semibold">NRO DE CUENTA:</label>
                            <input type="text" name="cuenta" value="NRO DE CUENTA BS. 2000121455 BANCO NACIONAL DE BOLIVIA (BNB) "
                            class="border-b border-gray-900 text-xs text-black max-w-full mr-5 pl-5   mb-3  outline-none">
                        </div>

                        <div class="flex flex-col">
                            <label for="entrega" class=" text-sm text-black font-semibold">LUGAR DE ENTREGA:</label>
                            <input type="text" name="entrega" value="DONDE INDIQUE EL CLIENTE"
                            class="border-b border-gray-900 text-xs text-black max-w-full mr-5 pl-5  mb-3  outline-none">
                        </div>


                        <div class="flex flex-col ">
                            <div class="flex justify-between">
                                <label for="tc" class=" text-sm text-black font-semibold">TIPO DE CAMBIO:</label>
                                <p id="tipo_cambio_error" class="text-xs pt-0.5 text-red-400  font-semibold dark:font-normal mr-5 "> </p>
                            </div>
                            <input type="text" name="tc" value="6.96" id="tipo_cambio" autocomplete="off"
                            class="border-b p-1  border-gray-900  rounded text-xs text-center text-black mr-5   mb-3  outline-none">
                        </div>

                    </div>
                </div>

                <!--columna derecha-->
                <div class=" row-start-1 sm:col-start-2  row-span-3">
                    <div class="flex flex-col">
                        <div class="flex justify-end m-1 mr-5">
                            <label class="text-black" for="">Descuento: %
                                <input class="h-6 w-24 sm:w-28 text-center border-b border-gray-400" type="number"
                                    value="{{ $venta->descuento }}" id="bt_descuento" min="0" name="descuento">

                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end m-1 mr-5">
                        <label class="text-black" for="">Monto Total: Bs
                            <input class="h-6 w-24 sm:w-28 text-center border-b border-gray-400" id="totalBs"
                                type="number" value="{{ $venta->total_en_bolivianos }}" name="total_en_bolivianos"
                                step="0.01">

                        </label>
                    </div>

                    <div class="flex justify-end m-1 mr-5">
                        <label class="text-black" for="">Monto Total: $us
                            {{-- <input type="hidden" id="tipo_cambio" value="{{$p->tipo_de_cambio}}"> --}}

                            <input class="h-6 w-24 sm:w-28 text-center border-b border-gray-400" id="totalSus"
                                type="number" value="{{ $venta->total_en_dolares }}" name="total_en_dolares"
                                step="0.01">
                        </label>
                    </div>

                    <div id="error_validacion" class="flex flex-col">

                    </div>

                    <div class="flex flex-row-reverse py-2   rounded-b-lg">
                        <div class="flex-initial pr-2 sm:pr-5">
                            <button type="submit"
                                class="flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize  bg-gray-700 rounded-md hover:bg-gray-500   focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out text-sm  ml-4 ">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#FFFFFF">
                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                    <path
                                        d="M5 5v14h14V7.83L16.17 5H5zm7 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-8H6V6h9v4z"
                                        opacity=".3"></path>
                                    <path
                                        d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zM6 6h9v4H6z">
                                    </path>
                                </svg>
                                <span class="pl-2 mx-1 ">Guardar</span>
                            </button>
                        </div>
                        <div class="flex-initial">
                            {{-- <form action="{{Route('Venta.volverCotizacion',$id_cot)}}" method="POST">
                                @csrf
                                @method('PUT')
                                 <button type="submit" class="flex items-center px-2 py-2 font-medium tracking-wide text-red-700 capitalize border-4 border-red-600 rounded-md hover:bg-red-500 hover:fill-current hover:text-white  focus:outline-none  transition duration-300 transform active:scale-95 ease-in-out text-base h-10" >
                                    Cancelar
                                 </button>
                            </form> --}}
                        </div>
                    </div>
                </div> <!-- end de flex derecho-->
            </div> <!-- end de grid-->


            <input type="hidden" id="verificar_solo_vista_Cotizacion" value="vacio">


        </div>
    </form>

    <script src="{{ asset('js/Autocompletes/cliente_ventas.js') }}"></script>

    <script src="{{ asset('js/Autocompletes/adicionarProducto.js') }}"></script>
 <script src="{{ asset('js/Autocompletes/validacionVentas.js') }}"></script>

 <input type="hidden" id="pantalla" value="venta">
@endsection
