@extends('navegador')

@section('Contenido')

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

    @if (session('VentasRegistrada'))
        @if (session('estado') == true)
            <div id="myDiv" class="animate-bounce  fixed z-50  top-12 right-3 py-2 px-3 w-fit rounded-lg bg-lime-500 ">
                <p> {{ session('VentasRegistrada') }} </p>
            </div>
        @else
            <div id="myDiv" class="animate-bounce  fixed z-50  top-12 right-3 py-2 px-3 w-fit rounded-lg bg-yellow-500 ">
                <p> {{ session('VentasRegistrada') }} </p>
            </div>
        @endif
        <script>
            console.log('hola xd xd');
            setTimeout(function() {
                document.getElementById('myDiv').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <p
        class="font-extrabold  text-gray-900 dark:text-gray-200 text-center sm:m-4 m-3 pt-1 text-2xl  sm:text-3xl lg:text-4xl ">
        Consutlas Ventas xd xd
    </p>


    <div
        class="mx-5 my-3 grid xl:grid-cols-7 lg:grid-cols-6 sm:grid-cols-3 grid-cols-1
                    gap-x-5 gap-y-2">

        {{-- <input type="hidden" id="estado" value="{{ $estado }}" name="estado"> --}}

        <div class=" flex items-end sm:col-span-2 xl:col-span-1 xl:row-start-1">
            <a class=" hidden lg:block px-2 py-1 mb-1 mr-2 h-fit w-fit text-center font-medium tracking-wide text-white bg-blue-500 rounded-md
                text-sm sm:text-lg hover:bg-blue-600 focus:bg-blue-600 focus:outline-none whitespace-nowrap"
                id="axd2" href="{{ Route('Venta.create') }}">
                Nueva venta
            </a>
        </div>

        <!-- inputs para busquedas xd xd -->
        {{-- <div class="sm:row-start-2 xl:row-start-1">
            <label for="nro_venta">Nro Venta </label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-400 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" placeholder="Nro Venta" name="nro_venta" value="{{ $nro_venta }}" autocomplete="off">
        </div>

        <div class="sm:row-start-2 xl:row-start-1">
            <label class="" for="cliente">Cliente</label>
            <input
                class="bg-gray-50 border border-gray-300  text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" placeholder="CI o Nombre" name="cliente" value="{{ $cliente }}">

        </div>
        <div class="sm:row-start-2 xl:row-start-1">
            <label for="empleado">Empleado</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="text" placeholder="CI o Nombre" name="empleado" value="{{ $empleado }}">
        </div>


        <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1">
            <label for="fecha_antes"> Creado Desde</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="date" min="2022-06-01" max="{{ date('Y-m-d') }}" name="fecha_antes" value="{{ $fecha_antes }}">
        </div>
        <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1">
            <label for="fecha_hasta"> Creado Hasta</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="date" min="2022-06-01" max="{{ date('Y-m-d') }}" name="fecha_hasta" value="{{ $fecha_hasta }}">
        </div> --}}

{{--
        <div class="flex flex-row-reverse items-end justify-between sm:row-start-3 lg:row-start-2 xl:row-start-1">
            <button class="flex justify-evenly  bg-cyan-700 rounded-xl p-2 h-fit" type="submit">
                <p class="text-white ">Buscar</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-8 pl-2 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div> --}}
    </div>

    <div class=" flex justify-between px-6 font-semibold">
        @php
            $anio_actual = date('Y');
        @endphp


        {{-- <div class="">
            <label for="realizadas_en"> Ventas realizados en:</label>
            <select name="realizadas_en" id="realizadas_en" class="dark:bg-gray-600 border border-black rounded-lg p-1">

                @if ($realizadas_en == 'null')
                    <option selected value="null">todas las ventas</option>
                @else
                    <option value="null">todas las ventas</option>
                @endif

                @if ($realizadas_en == '1')
                    <option selected value="1">ultimo dia</option>
                @else
                    <option value="1">ultimo dia</option>
                @endif

                @if ($realizadas_en == '7')
                    <option selected value="7">ultimos 7 dias</option>
                @else
                    <option value="7">ultimos 7 dias</option>
                @endif

                @if ($realizadas_en == '30')
                    <option selected value="30">ultimo mes</option>
                @else
                    <option value="30">ultimo mes</option>
                @endif

                @if ($realizadas_en == '90')
                    <option selected value="90">ultimo 3 mes</option>
                @else
                    <option value="90">ultimo 3 mes</option>
                @endif

                @for ($i = 2022; $i <= $anio_actual; $i++)
                    @if ($realizadas_en == $i)
                        <option selected value="{{ $i }}">año {{ $i }} </option>
                    @else
                        <option value="{{ $i }}">año {{ $i }} </option>
                    @endif
                @endfor

            </select>
        </div> --}}

        <div class="flex space-x-4 ">
            {{-- <button class="btn-blue mr-7 flex items-center  h-8">
                Subir a TuGerente
                <img class="w-10  ml-1 rounded-lg" src="{{ asset('img/logo-tugerente.png') }}" alt="">
            </button> --}}

            {{-- <div class=" items-center border border-gray-400 bg-white hover:bg-gray-100  px-2 py-1 rounded-lg">
                <a class="flex justify-center" href="{{ Route('Venta.index') }}">Restrablacer
                    <svg class="w-6 h-6 pl-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </a>
            </div> --}}

        </div>
    </div>



    <div class=" my-3 mx-5 overflow-hidden rounded-lg ">
        <!-- reemplace w-full por mx-8 -->
        <div class="  overflow-x-auto">
            <table class=" table-auto w-full overflow-x-auto ">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700 text-gray-300 h-12 bg-gray-800">
                        <!-- dark:text-gray-200 dark:bg-gray-800-->
                        <th class="">Nro. Venta</th>
                        <th class="">Nombre Cliente </th>
                        <th class="">Nombre Empleado </th>
                        <th class="">Fecha y hora</th>
                        <th class="">Monto Total</th>
                        {{-- <th class="">Ubicación</th> --}}

                        <th class="">Ver Detalles</th>
                        <th class="">Estado</th>
                        <th class="">Acciones</th>
                        {{-- <th class="">Proveedor</th>
                        <th class="">Acciones</th> --}}
                    </tr>
                </thead>

                <tbody class=" bg-white divide-2 divide-y divide-gray-300 dark:bg-gray-800">
                    @php
                        $cantidad_ventas = count($ventas);
                        // dd($);
                    @endphp
                    <input type="hidden" id='cantidad_ventas' value="{{ $cantidad_ventas }}">
                    @for ($i = 0; $i < $cantidad_ventas; $i++)
                        {{-- @foreach ($ventasentas as $ventas) --}}
                        <tr
                            class="bg-gray-50 text-center dark:bg-gray-800 hover:bg-gray-100
                        dark:hover:bg-gray-900 text-gray-700 dark:text-gray-200">
                            <td class=" px-2 text-sm">{{ $ventas[$i]->id }}</td>

                            <td class="px-1 py-3 text-sm capitalize">
                                {{ $ventas[$i]->nom_cliente }}
                            </td>
                            <td class="px-1 py-3 text-sm capitalize">
                                {{ $ventas[$i]->nom_empleado }}
                            </td>
                            <td class="px-1 py-3 text-sm flex flex-col">
                               <span class="whitespace-nowrap">  {{ $ventas[$i]->fecha }}</span>
                               <span class="whitespace-nowrap">  {{ $ventas[$i]->hora }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">
                                {{ $ventas[$i]->total_en_bolivianos }} Bs
                            </td>

                            <td>
                                <button id="bt_abrir_modal{{ $i }}" type="button"
                                    class=" text-xs font-medium rounded-lg px-1 py-1 border-2 border-black bg-white hover:bg-black hover:text-white
                                     dark:bg-slate-800 text-black dark:border-white dark:hover:bg-white dark:hover:text-black">
                                    {{-- Ver Detalles --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                      </svg>

                                </button>

                                <dialog id="myModal{{ $i }}"
                                        class=" w-10/12 md:w-2/3 lg:w-1/2 xl:w-5/12 rounded-2xl shadow-2xl border h-fit">

                                        <!--bt_cerrar_modal-->
                                        <button id="bt_cerrar_modal{{ $i }}" type="button"
                                            title="Cerrar ventana"
                                            class="cursor-pointer absolute top-0 right-0 mt-2 mr-4 text-gray-500 hover:text-gray-600 hover:scale-150
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



                                        <div class=" md:flex md:items-center md:justify-center  ">
                                            <div class=" w-full mx-2 rounded-lg  ">
                                                <div class="px-2 mb-2 ">
                                                    <h2 class="text-2xl text-center font-Carter">
                                                        DETALLE DE VENTA
                                                    </h2>
                                                </div>


                                                <div class="grid grid-cols-3 my-2 ">
                                                    <div>
                                                        <p class="text-gray-600 text-left flex items-center font-bold ">
                                                            Nro Venta:
                                                        </p>
                                                        <p class="text-gray-600 text-left flex items-center font-bold  ">
                                                            Cliente:
                                                        </p>
                                                    </div>
                                                    <div class="col-span-2 font-semibold text-gray-800">
                                                        <p class=""> {{ $ventas[$i]->id }} </p>
                                                        <p class="text-sm ">{{ $ventas[$i]->nom_cliente }} </p>
                                                    </div>

                                                </div>

                                                <div
                                                    class=" shadow rounded-lg  max-h-60 xl:max-h-80 2xl:max-h-96  overflow-y-auto">
                                                    <table class="w-full leading-normal  mb-4 ">
                                                        <thead>
                                                            <tr>
                                                                <th
                                                                    class="px-4 py-1 sticky top-0 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                                                    CODIGO OEM
                                                                </th>
                                                                <th
                                                                    class="px-4 py-1 sticky top-0 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                                                    CANT. P.UNIT.
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
                                                                @if ($detalles->id_venta == $ventas[$i]->id)
                                                                    <tr class=" p-2">
                                                                        <td
                                                                            class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-left">
                                                                            <p class="text-gray-600 whitespace-no-wrap">
                                                                                @php
                                                                                    $producto = DB::table('productos')
                                                                                        ->where('id', $detalles->id_producto)
                                                                                        ->first();
                                                                                @endphp
                                                                                {{ $producto->cod_oem }}
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
                                                                                {{ $detalles->detalles }}
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

                                                <div class="grid grid-cols-4 mt-3">
                                                    <div class="">

                                                        <a target="_blank"
                                                            class="bg-lime-500 rounded-lg px-2 py-1 cursor-pointer transition-transform  hover:scale-110"
                                                            href="{{ Route('Venta.pdf', $ventas[$i]->id) }}">
                                                            Ver PDF</a>
                                                    </div>
                                                    <div class="col-start-3 col-span-2 pr-5">
                                                        <table class='table-fixed w-full text-left text-sm text-gray-600'>
                                                            <tbody>
                                                                <tr class=" border-b">
                                                                    <th>
                                                                        Monto Total:
                                                                    </th>
                                                                    <td class="mr-8 text-right">
                                                                        {{ $ventas[$i]->monto_total }}
                                                                    </td>
                                                                </tr>
                                                                <tr class=" border-b">
                                                                    <th>
                                                                        Descuento:
                                                                    </th>
                                                                    <td class="mr-8 text-right ">
                                                                        {{ $ventas[$i]->descuento }} %
                                                                    </td>
                                                                </tr>
                                                                <tr class=" border-b">
                                                                    <th>
                                                                        Total en Bs:
                                                                    </th>
                                                                    <td class="mr-8 text-right">
                                                                        {{ $ventas[$i]->total_en_bolivianos }}
                                                                    </td>
                                                                </tr>
                                                                <tr class=" border-b">
                                                                    <th>
                                                                        Total en $us:
                                                                    </th>
                                                                    <td class="mr-8 text-right">
                                                                        {{ $ventas[$i]->total_en_dolares }}
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
                            <td class=" pr-2">
                                {{-- @dd($ventas[$i]->id ) --}}
                                @if ($ventas[$i]->id_venta == 0)
                                    <form action="{{ route('Venta.Refresh', $ventas[$i]->id) }}" method="post">
                                        @csrf
                                        {{-- <input type="hidden" name="venta" value="{{ $ventas[$i]->id  }}"> --}}
                                        <button type="submit"
                                        onclick="return confirm('Confirmar si en verdad desea facturar la venta: {{ $ventas[$i]->id }}?')"
                                            class="text-sm font-semibold text-black  border  p-1 rounded-lg bg-blue-100 flex items-center justify-center">
                                            <span class="inline-block w-3 h-3 mr-2 rounded-full bg-blue-500"></span>
                                            <span class="whitespace-nowrap mr-1"> Realizar Factura!</span>
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                            </svg> --}}
                                        </button>
                                    </form>
                                @else
                                    <p disabled
                                        class="text-sm font-semibold text-black border px-2 py-1 rounded-lg bg-green-100  mx-2 flex items-center justify-center">
                                        <span class="inline-block w-3 h-3 mr-2 rounded-full bg-green-500"></span>
                                        Facturado
                                    </p>
                                @endif


                            </td>
                            <td class=" py-2 text-xs">
                                <div class=" flex justify-around">
                                    <a target="_blank"
                                        class='flex items-center justify-center text-xs font-medium rounded-lg px-1 py-1  space-x-1 border-2 border-black bg-white hover:bg-black hover:text-white  dark:bg-slate-800 text-black dark:border-white dark:hover:bg-white dark:hover:text-black'
                                        href="{{ Route('Venta.pdf', $ventas[$i]->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                          </svg>

                                    </a>
                                    @can('ventas.edit')
                                        {{-- <a class="btn-blue" href="{{ Route('Venta.edit', $ventas[$i]->id) }}">
                                            EDITAR
                                        </a> --}}
                                        <div class="flex justify-center ">
                                            <a title="EDITAR"  href='{{  Route('Venta.edit', $ventas[$i]->id)  }}'
                                                class="  bg-blue-600 hover:bg-gray-900 rounded-lg w-fit p-2 mx-2 text-white
                                            hover:scale-105 transition-transform delay-75">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endcan

                                    @can('ventas.destroy')
                                        {{-- <button type="button"
                                            class="mr-3 mx-1 text-sm bg-red-700 hover:bg-blue-700 text-white px-2 py-1 rounded focus:outline-none focus:shadow-outline">
                                            <form action="{{ Route('Venta.destroy', $ventas[$i]->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="ELIMINAR" class=""
                                                    onclick="return confirm('Desea Eliminar?')">
                                            </form>
                                        </button> --}}
                                        <div>
                                            <form action="{{ Route('Venta.destroy', $ventas[$i]->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="ELIMINAR"
                                                    class="w-fit p-2 bg-red-600 hover:bg-gray-900  rounded-lg text-white
                                                     dark:hover:text-black hover:scale-105 transition-transform delay-75"
                                                    onclick="return confirm('En verdad deseas eliminar?')">
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

                                </div>
                                {{-- <button type="button"
                                    class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                    <a href="{{ Route('Producto.show', $p->id) }}">
                                        Ver
                                    </a></button>

                                <button type="button"
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    <a href="{{ Route('Producto.edit', $p->id) }}">
                                        EDITAR
                                    </a></button>

                                <button type="button"
                                    class="mr-3 text-sm bg-red-700 hover:bg-blue-700 text-white px-2 py-1 rounded focus:outline-none focus:shadow-outline">
                                    <form action="{{ Route('Producto.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="ELIMINAR" class=""
                                            onclick="return confirm('Desea Eliminar?')">
                                    </form>
                                </button> --}}
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            {{-- <div   class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <!-- Pagination -->
                <span class="flex col-span-0 mt-0 sm:mt-auto sm:justify-center">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">
                            {{ $ventasentas->links() }}
                        </ul>
                    </nav>
                </span>
            </div> --}}

        </div>
    </div>


    <script src="{{ asset('js/Autocompletes/modals.js') }}"></script>

    {{-- <script src="{{ asset('js/oscar.js') }}"></script> --}}
    <input type="hidden" id="pantalla" value="venta">

@endsection
