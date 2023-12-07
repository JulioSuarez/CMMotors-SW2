@extends('navegador')

@section('Contenido')
    <div
        class="font-extrabold  text-gray-900 dark:text-gray-200 text-center sm:m-4 m-3 pt-1 text-2xl  sm:text-3xl lg:text-4xl">
        <h2>
            REGISTRO DE COTIZACIONES
    </div>
    {{-- menu de busqueda cris --}}
    {{-- <div class="lg:bg-blue-500 md:bg-red-300 xl:bg-yellow-400 2xl:bg-purple-600 sm:bg-black bg-gray-400">
        <label>
            celu = plomo,
            sm 640px = black ,
            md 768px = rojo ,
            lg 1024px = azul ,
            xl 1280px = amariilo ,
            2xl 1536px = purpura ,
        </label>
    </div> --}}

    {{-- @dd('hola') --}}
    {{-- Realizar una cotizaicon  --}}
    <div class=" lg:hidden flex flex-col sm:flex-row justify-between mx-7 ">
        <a class=" px-3  py-1 my-1 h-fit w-full sm:w-fit  text-center font-medium tracking-wide text-white bg-blue-500 rounded-md
    hover:bg-blue-600 focus:bg-blue-600 focus:outline-none "
            id="axd1" href="{{ Route('Cotizar.create') }}" title="putoo">
            Realizar una Cotizacion
        </a>

        <button id="abrir_busquedas"
            class="flex items-center justify-center lg:hidden bg-blue-500 text-white  font-medium
        x-2 py-1 px-3 my-1 w-full sm:w-fit rounded-md">Realizar
            busquedas
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 ml-2 pt-0.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0l-3.75-3.75M17.25 21L21 17.25" />
            </svg>
        </button>
    </div>

    @if ($estado == 'true')
        <form action="" id="form" class=" lg:block" method="GET">
        @else
            <form action="" id="form" class="hidden lg:block" method="GET">
    @endif

    {{-- <form action="" id="form" class="hidden lg:block"  method="GET"> --}}
    <div class="mx-5 my-3 grid lg:grid-cols-6 sm:grid-cols-3 grid-cols-1
                gap-x-5 gap-y-2 lg:gap-y-0">

        <input type="hidden" id="estado" value="{{ $estado }}" name="estado">

        <div class=" flex items-end sm:col-span-2 lg:col-span-1 lg:row-start-1">
            {{-- @dd('esty anderot') --}}
            <a class=" hidden lg:block px-2 mb-1 mr-2 h-fit w-fit text-center font-medium tracking-wide text-white bg-blue-500 rounded-md
            text-sm sm:text-lg hover:bg-blue-600 focus:bg-blue-600 focus:outline-none "
                id="axd2" href="{{ Route('Cotizar.create') }}">
                Realizar una Cotizacion
            </a>
        </div>

        <!-- inputs para busquedas xd xd -->
        <div class="sm:row-start-2 lg:row-start-1 row-start-1 ">
            <label for="nro_coti">Nro Cotizacion </label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-400 text-sm rounded-lg block w-full pl-2 p-2
                 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" placeholder="Nro Cotizacion" name="nro_coti" value="{{ $nro_coti }}" autocomplete="off">
        </div>

        <div class="sm:row-start-2 lg:row-start-1">
            <label class="" for="cliente">Cliente</label>
            <input
                class="bg-gray-50 border border-gray-300  text-sm rounded-lg block w-full pl-2 p-2
                 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" placeholder="CI o Nombre" name="cliente" value="{{ $cliente }}">

        </div>
        <div class="sm:row-start-2 lg:row-start-1">
            <label for="empleado">Empleado</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" placeholder="CI o Nombre" name="empleado" value="{{ $empleado }}">
        </div>


        <div class="sm:row-start-3  lg:row-start-1">
            <label for="fecha_antes"> Creado Desde</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="date" min="2022-06-01" max="{{ date('Y-m-d') }}" name="fecha_antes" value="{{ $fecha_antes }}">
        </div>
        <div class="sm:row-start-3 lg:row-start-1">
            <label for="fecha_hasta"> Creado Hasta</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="date" min="2022-06-01" max="{{ date('Y-m-d') }}" name="fecha_hasta" value="{{ $fecha_hasta }}">
        </div>

        <div class="sm:row-start-4 col-span-1 sm:col-span-2 lg:col-span-3">
            <label for="referencia">Referencia</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" placeholder="Referencia..." name="referencia" value="{{ $referencia }}">
        </div>

        <div
            class="flex justify-between lg:items-end px-2 sm:row-start-5 sm:col-span-2 lg:col-start-5 sm:mt-2 lg:row-start-4 lg:mt-0 p-1">
            <div class=" border border-gray-200 hover:bg-gray-300 p-1 rounded-lg  h-10">
                <a class="flex justify-center" href="{{ Route('Cotizar.index') }}">Restrablacer
                    <svg class="w-6 h-6 pl-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="flex flex-row-reverse items-end justify-between ">
                <!--sm:row-start-3 lg:row-start-2 xl:row-start-1-->
                <button class="flex justify-evenly  bg-cyan-700 rounded-xl p-2 h-fit" type="submit">
                    <p class="text-white ">Buscar</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-8 pl-2 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
        {{-- </div> --}}


        {{-- <div class=" flex justify-between px-6 font-semibold"> --}}
        {{-- @php
        $anio_actual = date('Y');
        // $fecha_acutal = date('Y-m-d');
        // dd( $fecha_acutal);
    @endphp --}}



        {{-- <div class=" items-center border border-gray-200 hover:bg-gray-300 p-1 rounded-lg">
        <a class="flex justify-center" href="{{ Route('Cotizar.index') }}">Restrablacer
            <svg class="w-6 h-6 pl-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                </path>
            </svg>
        </a>



    </div> --}}
        </form>
    </div>

    {{-- fin del menu de busquedas cris --}}



    {{-- Seccion de Mensajes --}}

    <div class=" flex justify-between items-center mx-5">
        @if (session('venta_cancelada'))
            <p class="text-white py-2 px-4 bg-lime-500 text-sm text-center rounded-xl  w-full h-full sm:w-fit m-2">
                {{ session('venta_cancelada') }}
            </p>
        @endif

        @if (session('CotizacionEliminado'))
            <p class="text-white bg-lime-500 p-2 text-sm rounded-xl mx-8">
                Cotizacion Nro: {{ session('CotizacionEliminado') }} Eliminada correctamente
            </p>
        @endif

        @if (session('CotizacionStore'))
            <p class="text-white py-2 px-4 bg-lime-500 text-sm text-center rounded-xl  w-full h-full sm:w-fit   m-2">
                {{ session('CotizacionStore') }}
            </p>
        @endif

        @if (session('CotizacionUpdate'))
            <p class="text-white bg-lime-500 p-2 text-sm rounded-xl mx-8">
                {{ session('CotizacionUpdate') }}
            </p>
        @endif



    </div>
    {{-- fun de la seccion de mensajes --}}

    <!-- boton de registrar by Julico -->
    {{-- <div class="flex flex-wrap items-center px-4 py-2">
        <div class="relative w-full max-w-full flex-grow flex-1 text-left">
            <a href="{{ Route('Cotizar.create') }}"
                class="md:w-60  w-60 bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg my-1 hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-linear duration-300"
                type="button">NUEVA CONTIZACION</a>
            <!-- class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" -->
        </div>
        <div class="relative w-full max-w-full flex-grow flex-1">
            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">

            </h3>
        </div>
    </div> --}}
    <div class="my-4 mx-4 shadow-xs">
        <!-- reemplace w-full por mx-8 -->
        <div class="w-full overflow-x-auto rounded-lg border border-gray-600 ">
            <table class="w-full">
                <thead>
                    <tr
                        class="text-xs  text-center font-semibold tracking-wide text-white uppercase border-b dark:border-gray-700 bg-gray-500  dark:bg-gray-800 ">
                        <th class="py-3 ">Nro Coti.</th>
                        <th class="">Cliente</th>
                        <th class="px-4 py-3">Asesor de Venta</th>
                        <th class="py-1 text-xs ">
                            <p class="whitespace-nowrap mb-1">Fecha Realizada</p> 
                            <p class="whitespace-nowrap">Fecha de Validez</p>
                        </th>
                        {{-- <th class=" py-3">Fecha de Validez</th> --}}
                        <th class="pl-2 py-3">Monto Total </th>
                        <th class="px-3 py-3">Ver Detalles </th>
                        {{-- <th class="px-4 py-3 text-center">Ver Productps </th> --}}
                        <th class="px-8 py-3">Acciones </th>
                    </tr>
                </thead>

                <tbody class=" divide-y dark:divide-gray-700 ">
                    @php
                        $cantidad_ventas = count($cotizaciones);
                    @endphp
                    <input type="hidden" id='cantidad_ventas' value="{{ $cantidad_ventas }}">
                    @for ($i = 0; $i < $cantidad_ventas; $i++)
                        <tr
                            class=" bg-gray-50 text-gray-700 hover:bg-gray-200  mx-5
                             dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-gray-100">
                            <td>
                                <p class=" text-normal text-center">{{ $cotizaciones[$i]->nro_coti }}</p>
                            </td>
                            <td class="px-2 py-3 text-sm ">{{ $cotizaciones[$i]->name_cliente }}</td>
                            <td class="px-4 py-3 text-sm ">{{ $cotizaciones[$i]->name_empleado }}
                                {{ $cotizaciones[$i]->apellido_empleado }}</td>
                            <td class="px-4 py-3 text-sm flex flex-col ">
                               <p class="whitespace-nowrap"> {{ $cotizaciones[$i]->fecha_realizada }}</p>
                                <p class="whitespace-nowrap">{{ $cotizaciones[$i]->fecha_validez }}</p>
                            </td>
                            {{-- <td class="px-4 py-3 text-xs ">{{ $cotizaciones[$i]->fecha_validez }}</td> --}}
                            <td class="px-2 py-3 text-right text-sm whitespace-nowrap ">{{ $cotizaciones[$i]->total_en_bolivianos }} Bs</td>

                            <td>
                                <button id="bt_abrir_modal{{ $i }}" type="button"
                                    class=" text-xs font-medium rounded-lg p-2 border-2 border-black bg-white hover:bg-black hover:text-white
                                     dark:bg-gray-200 text-black dark:border-white dark:hover:bg-white dark:hover:text-black
                                     cursor-pointer hover:scale-105 transition-transform delay-75 ">
                                    Ver Detalles
                                </button>

                                <dialog id="myModal{{ $i }}"
                                    class=" w-10/12 md:w-2/3 lg:w-1/2 xl:w-5/12 rounded-2xl shadow-2xl border h-fit">

                                    <!--bt_cerrar_modal-->
                                    <button id="bt_cerrar_modal{{ $i }}" type="button"
                                        title="Cerrar ventana"
                                        class="cursor-pointer absolute top-0 right-0 mt-4 mr-4 text-gray-500 hover:text-gray-600 hover:scale-150
                                         transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                            width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <line x1="18" y1="6" x2="6" y2="18" />
                                            <line x1="6" y1="6" x2="18" y2="18" />
                                        </svg>
                                    </button>



                                    <div class=" md:flex md:items-center md:justify-center ">
                                        <div class=" w-full mx-5 rounded-lg  ">
                                            <div class="p-2 mb-2 ">
                                                <h2 class="text-2xl text-center font-Carter">
                                                    DETALLE DE RECIBO
                                                </h2>
                                            </div>


                                            <div class="grid grid-cols-3 my-3 ">
                                                <div>
                                                    <p class="text-gray-600 text-left flex items-center font-bold ">
                                                        Nro Cotizacion:
                                                    </p>
                                                    <p class="text-gray-600 text-left flex items-center font-bold  ">
                                                        Cliente:
                                                    </p>
                                                </div>
                                                <div class="col-span-2 font-semibold text-gray-800">
                                                    <p> {{ $cotizaciones[$i]->nro_coti }} </p>
                                                    <p class="text-sm ">{{ $cotizaciones[$i]->name_cliente }} </p>
                                                </div>

                                            </div>

                                            <div
                                                class=" shadow rounded-lg  max-h-60 xl:max-h-80 2xl:max-h-96  overflow-y-auto">
                                                <table class="w-full leading-normal  mb-4 ">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class=" p-1 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                                                COD. PRODUCTO
                                                            </th>
                                                            <th
                                                                class="px-4 py-1 sticky top-0 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                                                CANT.
                                                            </th>
                                                            <th
                                                                class="px-4 py-1 sticky top-0 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                                                DETALLE
                                                            </th>

                                                            <th
                                                                class="px-4 py-1 sticky top-0 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                                                SUBTOTAL
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($detalles_venta as $detalles)
                                
                                                            @if ($detalles->id_cotizacion == $cotizaciones[$i]->id)
                                                                <tr class=" p-2">
                                                                    <td
                                                                    class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                                                                    <p class="text-gray-600 whitespace-no-wrap">
                                                                        @php
                                                                        $producto = DB::table('productos')
                                                                            ->where('id', $detalles->id_producto)
                                                                            ->first();
                                                                    @endphp
                                                                    {{ $producto->cod_producto }}
                                                                    </p>
                                                                </td>
                                                                    <td
                                                                        class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                                                                        <p class="text-gray-600 whitespace-no-wrap">
                                                                            {{ $detalles->cantidad }}
                                                                        </p>
                                                                    </td>
                                                                    <td
                                                                        class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                                                                        <p class="text-gray-600 whitespace-no-wrap">
                                                                            {{ $detalles->detalle_co }}
                                                                        </p>
                                                                    </td>

                                                                    <td
                                                                        class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                                                                        <p class="text-gray-600 whitespace-no-wrap">
                                                                            {{ $detalles->precio }}
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="grid grid-cols-4 mt-5">
                                                <div class="">

                                                    <a target="_blank"
                                                        class="bg-lime-500 rounded-lg px-2 py-1 cursor-pointer transition-transform  hover:scale-110"
                                                        href="{{ Route('Cotizar.pdf', $cotizaciones[$i]->id) }}">Ver
                                                        PDF</a>
                                                </div>
                                                <div class="col-start-3 col-span-2 pr-5">
                                                    <table class='table-fixed w-full text-left text-sm text-gray-600'>
                                                        <tbody>
                                                            <tr class=" border-b">
                                                                <th>
                                                                    Monto Total:
                                                                </th>
                                                                <td class="mr-8 text-right">
                                                                    {{ $cotizaciones[$i]->monto_total }}
                                                                </td>
                                                            </tr>
                                                            <tr class=" border-b">
                                                                <th>
                                                                    Descuento:
                                                                </th>
                                                                <td class="mr-8 text-right ">
                                                                    {{ $cotizaciones[$i]->descuento }}
                                                                    %
                                                                </td>
                                                            </tr>
                                                            <tr class=" border-b">
                                                                <th>
                                                                    Total en Bs:
                                                                </th>
                                                                <td class="mr-8 text-right">
                                                                    {{ $cotizaciones[$i]->total_en_bolivianos }}
                                                                </td>
                                                            </tr>
                                                            <tr class=" border-b">
                                                                <th>
                                                                    Total en $us:
                                                                </th>
                                                                <td class="mr-8 text-right">
                                                                    {{ $cotizaciones[$i]->total_en_dolares }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        </div>


                                    </div>
                                </dialog>
                            </td>


                            <td class="text-center">
                                <div class="flex justify-around items-center text-center">
                                    {{-- svg Imprimir --}}
                                    <div
                                        class="flex justify-center bg-cyan-700 hover:bg-gray-900 w-fit p-2 rounded-lg cursor-pointer
                                    hover:scale-105 transition-transform delay-75">
                                        <a target="_blank" href="{{ Route('Cotizar.pdf', $cotizaciones[$i]->id) }}"
                                            title="IMPRIMIR">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class=" h-6 w-6 text-gray-200">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                            </svg>
                                        </a>
                                    </div>
                                    @can('cotizacion.edit')
                                        <div class="flex justify-center ">
                                            <button title="EDITAR" type="button"
                                                onclick="window.location.href='{{ Route('Cotizar.edit', $cotizaciones[$i]->id) }}'"
                                                class="  bg-blue-600 hover:bg-gray-900 rounded-lg w-fit p-2 mx-2 text-white
                                            hover:scale-105 transition-transform delay-75">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </button>

                                        </div>
                                    @endcan
                                    @can('cotizacion.destroy')
                                        <div>
                                            <form action="{{ Route('Cotizar.delete', $cotizaciones[$i]->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" name="id" class="hidden"
                                                    value="{{ $cotizaciones[$i]->id }}">
                                                {{-- <input type="submit" value="ELIMINAR" class=""
                                                    onclick="return confirm('Desea Eliminar?')"> --}}
                                                <button type="submit" title="ELIMINAR"
                                                    class="w-fit p-2 bg-red-600 hover:bg-gray-900  rounded-lg text-white
                                                     dark:hover:text-black hover:scale-105 transition-transform delay-75"
                                                    onclick="return confirm('Desea Eliminar?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endcan
                                    <a class="flex flex-col w-fit mx-2 px-2 py-1 leading-4 text-white text-sm bg-green-600 hover:bg-gray-900 rounded-lg
                                    hover:scale-105 transition-transform delay-75"
                                        href="{{ Route('Venta.createVentaCoti', $cotizaciones[$i]->id) }}">
                                        <span>Realizar </span>
                                        <span>Venta</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="">
            <!-- Pagination -->
            {{ $cotizaciones->appends([
                'cotizaciones' => $cotizaciones,
                'nro_coti'  => $nro_coti,
                'empleado'  => $empleado,
                'cliente'  => $cliente,
                'fecha_antes' =>  $fecha_antes ,
                'fecha_hasta'  => $fecha_hasta,
                'referencia'  => $referencia,
                'estado' => $estado

            ]) }}

        </div>
    </div>

    <script src="{{ asset('js/Autocompletes/modals.js') }}"></script>

    <input type="hidden" id="pantalla" value="cotizacion">
@endsection
