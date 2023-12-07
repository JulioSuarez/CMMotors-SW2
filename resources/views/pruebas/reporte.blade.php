@extends('navegador')

@section('Contenido')


<div class="lg:bg-blue-500 md:bg-red-300 xl:bg-yellow-400 2xl:bg-purple-600 sm:bg-black bg-gray-400">
    <label>
        celu = plomo,
        sm 640px = black ,
        md 768px = rojo ,
        lg 1024px = azul ,
        xl 1280px = amariilo ,
        2xl 1536px = purpura ,
    </label>
</div>





    @php
        $l = count($ventas);
        $inversion = 0;
        $monto = 0;
        $utilidad = 0;
        $p = 0;
    @endphp
    @foreach($productos as $pro)
        <input class="hidden" type="number" value="{{$p += $pro->cantidad}}">
    @endforeach
    @for ($i = 0; $i < $l; $i++)
    <input class="hidden" value="{{ $suma_pu[$i] }}">
    <input class="hidden" value="{{ $ventas[$i]->total_en_bolivianos }}">
    <input class="hidden" value="{{ $utilidades[$i] }}">
    <input class="hidden" value="{{ $inversion += $suma_pu[$i] }}">
    <input class="hidden" value="{{ $monto += $ventas[$i]->total_en_bolivianos  }}">
    <input class="hidden" value="{{ $utilidad += $utilidades[$i] }}">
    @endfor
    {{-- @dd($ventas) --}}
    <div class="flex  justify-center pt-2 ">
        <h2 class="text-3xl font-extrabold text-gray-600 dark:text-white">
            REPORTES EN GENERAL</h2>
    </div>
    <div class=" mx-4 pt-2 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4  2xl:grid-cols-6 gap-4 mb-2"  >
            <a href="{{ Route('ventas.utilidades') }}" target="blank"
            class=" bg-blue-600 text-gray-200 w-40 h-8 text-center p-1 hover:bg-blue-500 rounded-lg"
            type="button">Ventas Utilidades</a>

            <a href="{{ Route('ListaProductos') }}" target="blank"
            class=" bg-blue-600 text-gray-200 w-40 h-8 text-center p-1 hover:bg-blue-500 rounded-lg"
            type="button">Lista de Productos</a>

            <a href="{{ Route('ListaProductosi') }}" target="blank"
                class=" bg-blue-600 text-gray-200 w-40 h-8 text-center p-1 hover:bg-blue-500 rounded-lg"
                type="button">Productos Impuestos</a>

            <a href="{{ Route('cliente_pdf') }}" target="blank"
                class=" bg-blue-600 text-gray-200 w-40 h-8 text-center p-1 hover:bg-blue-500 rounded-lg"
                type="button">Listado de Clientes</a>

            <a href="{{ Route('empleado_pdf') }}" target="blank"
                class=" bg-blue-600 text-gray-200 w-48 h-8 text-center p-1 hover:bg-blue-500 rounded-lg"
                type="button">Listado de Empleados</a>

            <a href="{{ Route('proveedor_pdf') }}" target="blank"
                class=" bg-blue-600 text-gray-200 w-48 h-8 text-center p-1 hover:bg-blue-500 rounded-lg"
                type="button">Listado de Proveedores</a>

{{--
                <div>
                    <form action="{{Route('reporte.fecha')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="dias">Selecciones la fecha del reporte de ventas</label>
                            <select name="dias" id="dias">
                                {{-- <option selected>Select one</option>
                                <option selected value="1">Un Día</option>
                                <option value="7">Una Semana</option>
                                <option value="30">Un Mes</option>
                                <option value="90">Un Trimestre</option>
                                <option value="180">Un Semestre</option>
                                <option value="365">Un Año</option>
                            </select>
                        </div>
                        <button type="submit">Generar Reporte</button>
                    </form>
                </div> --}}



                @php
                $anio_actual = date('Y');
                // $fecha_acutal = date('Y-m-d');
                // dd( $fecha_acutal);
            @endphp

                {{-- Selecciones la fecha del reporte de ventas: --}}
            <form action="{{Route('reporte.fecha')}}" method="post" class="  sm:col-span-2  sm:flex  items-center">
                @csrf
                    <label class="font-semibold" for="realizadas_en"> Ventas realizados en:</label>
                    <div class="flex">

                    <select name="dias" id="dias" class="dark:bg-gray-600 border border-black rounded-lg p-1 sm:ml-1">
                             <option selected value="0" >Todas las ventas</option>
                            <option value="1">Ultimo dia</option>
                            <option value="7">Ultimos 7 dias</option>
                            <option value="30">Ultimo mes</option>
                            <option value="90">Ultimos 3 meses</option>
                            <option value="180">Ultimos 6 meses</option>
                            @for ($i = 2022; $i <= $anio_actual; $i++)
                                <option value="{{ $i }}">año {{ $i }} </option>
                            @endfor
                    </select>


                    {{-- // class="h-6 w-8 pl-2 text-gray-400 --}}
                        <button class="flex justify-evenly  bg-cyan-700 rounded-xl p-2 h-fit ml-2" type="submit">
                            <p class="hidden text-white sm:block">IMPRIMIR</p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-1 text-gray-400 ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                              </svg>

                        </button>
                    </div>


            </form>



    </div>


    {{-- TARJETAS AZULES --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
        <div
            class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div
                class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </div>
            <div class="text-right">
                <p class="text-2xl">Bs.- {{ $utilidad }}</p>
                <p>Utilidad bruta</p>
            </div>
        </div>

        <div
            class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div
                class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
            <div class="text-right">
                @if (is_null($suma_xd))
                    $ventas_dia = 0;
                    <p class="text-2xl">Bs.- {{ $ventas_dia }}</p>
                    <p>Ventas realizadas</p>
                @else
                    <p class="text-2xl">{{ $l }}</p>
                    <p>Ventas realizadas</p>
                @endif
            </div>
        </div>

        <div
            class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div
                class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div class="text-right">
                <p class="text-2xl">Bs.- {{$monto}}</p>
                <p>Monto vendido</p>
            </div>
        </div>

        <div
            class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div
                class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div class="text-right">
                <p class="text-2xl">Bs.- {{$inversion}}</p>
                <p>Inversion General</p>
            </div>
        </div>
    </div>
    {{-- FIN DE TARJETAS AZULES --}}


    {{-- tabla --}}
    <div class="my-4 mx-3 overflow-hidden rounded-lg shadow-xs">
        <!-- reemplace w-full por mx-8 -->
        <div class="w-full overflow-x-auto ">
            <table class="w-full ">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700 text-gray-300 h-12 bg-gray-800">
                        <th class=" py-3">Nro. Venta</th>
                        <th class=" py-3">Fecha </th>
                        <th class=" py-3">Costo Total </th>
                        <th class=" py-3">Monto Total</th>
                        <th class=" py-3">Utilidad</th>
                    </tr>
                </thead>
                <tbody class=" divide-y divide-gray-700 bg-gray-800">
                    @php
                        $l = count($ventas);
                    @endphp
                    @for ($i = 0; $i < $l; $i++)
                        <tr class=" bg-gray-800 hover:bg-gray-900 text-gray-400 divide-y divide-gray-700 ">
                            <td class=" text-center text-xs">{{ $ventas[$i]->id }}</td>
                            <td class="text-center text-xs">{{ $ventas[$i]->fecha }}</td>
                            <td class="text-center text-sm">{{ $suma_pu[$i] }}</td>
                            <td class="text-center text-xs">{{ $ventas[$i]->total_en_bolivianos }}</td>
                            <td class="text-center text-xs">{{ $utilidades[$i] }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>

        </div>
    </div>

    <input type="hidden" id="pantalla" value="reporte">
@endsection
