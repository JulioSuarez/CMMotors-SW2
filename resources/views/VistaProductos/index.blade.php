@extends('navegador')

@section('Contenido')
@vite('resources/js/loading.js')
    <div id="loadingScreen" class="loading-screen">
        <div class="loader"></div>
    </div>

    {{--
    <h2 class="bg-red-400 sm:bg-green-600 md:bg-purple-700 lg:bg-blue-600 xl:bg-yellow-500 2xl:bg-white
    text-3xl font-extrabold text-gray-200 text-center m-2
    md:text-4xl">
        LISTA DE PRODUCTOS
        sm = 640px = verde;
        md = 768px = violeta;
        lg = 1024px = azul;
        xl = 1280px = amariilo;
        2xl = 1536px = blanco;
    </h2> --}}

    <p
        class="font-extrabold  text-gray-900 dark:text-gray-200 text-center sm:m-4 m-3 pt-1 text-2xl  sm:text-3xl lg:text-4xl ">
        LISTA DE PRODUCTOS
    </p>

    <div class=" flex justify-between items-center mx-5">
        {{-- //todo esto se puede meter en un nombre y emitir otro mensaje --}}
        @if (session('RegistroProducto'))
            <div class="  py-2 px-3
            {{ session('estado') }} w-fit rounded-lg ">
                <p> {{ session('RegistroProducto') }} </p>
            </div>
        @endif

        {{-- @if ($errors->has('RegistroProducto'))
        <div class="  py-2 px-3
        {{$errors->first('color') }} w-fit rounded-lg ">
            <p> {{ $errors->first('mensaje') }} </p>
        </div>
        @endif --}}

        @error('EroorHomologacion')
            <div class="  py-2 px-3 bg-red-500 w-full rounded-lg ">
                <p>  {{ $message }} </p>
            </div>
        @enderror


        {{-- hay que usar un solo session --}}
        @if (session('UpdateProducto'))
            <p class="text-white w-fit py-2 px-4 bg-lime-500 text-sm text-center rounded-xl  h-full sm:w-fit mt-4">
                {{ session('UpdateProducto') }}
            </p>
        @endif
        @if (session('DeleteProducto'))
            {{-- <p class="text-white w-fit py-2 px-4 bg-red-700 text-sm text-center rounded-xl  h-full sm:w-fit mt-4">
                {{ session('DeleteProducto') }}
            </p> --}}

            <div class="bg-green-200 border-l-4 border-green-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm leading-5 font-medium text-green-700">
                            {{ session('DeleteProducto') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>





    <div class=" px-5 py-2 flex flex-col sm:flex-row ">
        <a class="py-1 px-2 mb-2 mr-2 h-fit w-fit text-center font-medium tracking-wide text-white bg-blue-500 rounded-md
                text-sm sm:text-lg hover:bg-blue-600 focus:bg-blue-600 focus:outline-none "
            href="{{ Route('Producto.create') }}">
            Crear Producto
        </a>
        @can('productos.destroy')
            <a class="py-1 px-2 mb-1 mr-3 h-fit w-fit text-center font-medium tracking-wide text-white bg-blue-500 rounded-md
                text-sm sm:text-lg hover:bg-blue-600 focus:bg-blue-600 focus:outline-none "
                href="{{ Route('producto.deshabilitado') }}">
                Lista de Deshabilitados
            </a>
        @endcan
         {{-- <a href="{{ route('exportar.producto.view') }}" id="exportButton" class="py-1 px-2 mb-1 mr-3 h-fit w-fit text-center font-medium tracking-wide text-white bg-blue-500 rounded-md text-sm sm:text-lg hover:bg-blue-600 focus:bg-blue-600 focus:outline-none">
                Exporta Excel
            </a> --}}
            <button id="exportButton"
                class="py-1 px-2 mb-1 mr-3 h-fit w-fit text-center font-medium tracking-wide text-white bg-green-500 rounded-md text-sm sm:text-lg hover:bg-green-600 focus:bg-green-600 focus:outline-none">
                Exportar Excel
            </button>
    </div>

    <form action="" method="GET">
        <div
            class="mx-5 mb-3 grid xl:grid-cols-7 lg:grid-cols-6 sm:grid-cols-3 grid-cols-1
                    gap-x-5 gap-y-2">

            {{-- <div class="flex items-end sm:col-span-2 xl:col-span-1 xl:row-start-1">
                <a class="px-2 mb-1 mr-2 h-fit w-fit text-center font-medium tracking-wide text-white bg-blue-500 rounded-md
                text-sm sm:text-lg hover:bg-blue-600 focus:bg-blue-600 focus:outline-none "
                    href="{{ Route('Producto.create') }}">
                    Crear Producto
                </a>
                <a class="px-2 mb-1 mr-2 h-fit w-fit text-center font-medium tracking-wide text-white bg-blue-500 rounded-md
                text-sm sm:text-lg hover:bg-blue-600 focus:bg-blue-600 focus:outline-none "
                    href="{{ Route('producto.deshabilitado') }}">
                    Lista de Deshabilitados
                </a>
            </div> --}}

            <div class="sm:row-start-2 xl:row-start-1">
                <label for="code_prod">Codigo Producto </label>
                <input id="code_prod"
                    class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-400 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 uppercase"
                    type="text" placeholder="Codigo Producto" name="code_prod" value="{{ $code_prod }}"
                    autocomplete="off">
            </div>
            <div class="sm:row-start-2 xl:row-start-1">
                <label for="nombre_prod" class="whitespace-nowrap">
                    Nombre Producto
                </label>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-400 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 uppercase"
                    type="text" placeholder="Nombre" id="nombre_prod" name="nombre_prod" value="{{ $nombre_prod }}"
                    autocomplete="off">
            </div>

            <div class="sm:row-start-2 xl:row-start-1">
                <label class="" for="proveedor">Proveedor</label>
                <input
                    class="bg-gray-50 border border-gray-300  text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 uppercase"
                    type="text" placeholder="NIT o Nombre" name="proveedor" value="{{ $proveedor }}"
                    autocomplete="off">

            </div>
            <div class="sm:row-start-2 xl:row-start-1">
                <label for="ubicacion">Ubicacion</label>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2 uppercase
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" placeholder="Ubicacion" name="ubicacion" value="{{ $ubicacion }}" autocomplete="off">
            </div>
            <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1">
                <label for="tienda">Tienda</label>
                {{-- <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="text" placeholder="tienda" name="tienda" value="{{$tienda}}" > --}}
                <select
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                    dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 uppercase"
                    name="tienda" id="">

                    @if ($tienda == 'null')
                        <option selected value="null">Todas</option>
                    @else
                        <option value="null"> Todas</option>
                    @endif
                    @if ($tienda == 'repuestos')
                        <option selected value="repuestos"> Repuestos</option>
                    @else
                        <option value="repuestos"> Repuestos</option>
                    @endif
                    @if ($tienda == 'ferreteria')
                        <option selected value="ferreteria"> Ferreteria</option>
                    @else
                        <option value="ferreteria"> Ferreteria</option>
                    @endif
                    @if ($tienda == 'deposito taller')
                        <option selected value="deposito taller"> Deposito Taller</option>
                    @else
                        <option value="deposito taller"> Deposito Taller</option>
                    @endif
                    @if ($tienda == 'deposito ferreteria')
                        <option selected value="deposito ferreteria"> Deposito Ferreteria</option>
                    @else
                        <option value="deposito ferreteria"> Deposito Ferreteria</option>
                    @endif
                </select>
            </div>
            <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1">
                <label for="marca">Marca</label>
                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 uppercase"
                    type="text" placeholder="Marca o Procedencia" name="marca" value="{{ $marca }}"
                    autocomplete="off">
            </div>
            {{-- <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1">
                <label for="fecha_antes"> Creado Desde</label>
                    <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="date" min="2022-06-01" max="{{date('Y-m-d')}}" name="fecha_antes"  value="{{$fecha_antes}}"  >
            </div>
            <div class="sm:row-start-3 lg:row-start-2 xl:row-start-1">
                <label for="fecha_hasta"> Creado Hasta</label>
                    <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-2 p-2
                     dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="date"  min="2022-06-01" max="{{date('Y-m-d')}}" name="fecha_hasta" value="{{$fecha_hasta}}" >
            </div> --}}
            <div class="flex flex-row-reverse items-end justify-between sm:row-start-3 lg:row-start-2 xl:row-start-1">
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

        <div class=" flex justify-between px-6 font-semibold">
            {{-- @php
                $anio_actual = date('Y');
                $fecha_acutal = date('Y-m-d');
               // dd( $fecha_acutal);
            @endphp --}}

            {{-- <div class="">
                <label for="fecha">Fecha creacion</label>
                <select name="" id="" class="dark:bg-gray-600 border border-black rounded-lg p-1">
                    <option value="">ultimos 30 dias  </option>
                    <option value="">ultimo 3 meses </option>
                    @for ($i = 2019; $i < $anio_actual; $i++)
                        <option value="">{{$i}} </option>
                    @endfor
                </select>
            </div> --}}
            {{-- @dd($stock_menores) --}}
            {{-- <p>stok:{{$stock_menores}}</p> --}}
            <div class="">
                <label for="stock_menores">Stock menores a</label>
                <select name="stock_menores" id="" class="dark:bg-gray-600 border border-black rounded-lg p-1">
                    @if ($stock_menores == 'null')
                        <option selected value="null">mostrar todo</option>
                    @else
                        <option value="null">mostrar todo</option>
                    @endif
                    @if ($stock_menores == '5')
                        <option selected value="5">menores a 5 </option>
                    @else
                        <option value="5">menores a 5 </option>
                    @endif
                    @if ($stock_menores == '20')
                        <option selected value="20">menores a 20</option>
                    @else
                        <option value="20">menores a 20</option>
                    @endif

                </select>
            </div>


            <div class="flex  items-center  space-x-8">
                <div class="">
                    <label for="mostrar_por" class="">Mostrar por</label>
                    <select name="mostrar_por" id="mostrar_por" 
                    class="dark:bg-gray-600 border border-black rounded-lg p-1 ">


                        
                            {{-- <option selected value="null" class="py-3">Creados recientemente</option>
                
                            <option  value="1">Registrado en TG </option>
                        
                            <option value="2" class="py-3">No Registrados en TG </option>
                     
                            <option  value="3">Sin nombre</option>
                       
                            <option value="4">Sin precio</option> --}}
                            @php
                            $selectedValue = $mostrar_por ?? 'null';
                            $opciones = [
                                'null' => 'Creados recientemente',
                                '1' => 'Registrado en TG',
                                '2' => 'No Registrados en TG',
                                '3' => 'Sin nombre',
                                '4' => 'Sin precio'
                            ];
                        @endphp

                        @foreach ($opciones as $value => $label)
                            <option value="{{ $value }}" {{ $value == $selectedValue ? 'selected' : '' }} class="{{ $value == 'null' ? 'py-3' : '' }}">
                                {{ $label }}
                            </option>
                        @endforeach
                </select>
                </div>
           
                <a class="flex justify-center  border border-gray-200 hover:bg-gray-300 p-1 rounded-lg" href="{{ Route('Producto.index') }}">Restrablacer
                    <svg class="w-6 h-6 pl-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </a>
            </div>
    </form>
    </div>

    <div class=" my-2 mx-5 overflow-hidden ">
        <!-- reemplace w-full por mx-8 -->
        <div class="  overflow-x-auto border border-gray-600  rounded-lg pb-2 bg-white ">
            <table class="w-full overflow-x-auto  ">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700 text-gray-300 h-12 bg-gray-800">
                        <!-- dark:text-gray-200 dark:bg-gray-800-->
                        @php
                            $cantidad_de_productos = count($productos);
                        @endphp
                        <th class="">
                            <span>Codigo Prod.</span>
                            <span class="text-xs font-normal">Codigo Oem</span>
                        </th>
                        <th class="">Productos ( {{ $cantidad_de_productos }} )</th>
                        <th class="p-1">Precios </th> <!-- capitalize -->
                        {{-- <th class="">Precio Sin Factura</th>
                        <th class="">Precio de Costo</th> --}}

                        <th class="">Ubicación/ Tienda</th>
                        {{-- <th class="">Tienda</th> --}}
                        {{-- <th class="">Tienda</th> --}}
                        {{-- <th class="">Fecha de Expiración</th> --}}
                        <th class="">Proveedor</th>
                        <th class="">TuGerente</th>
                        <th class="">Acciones</th>
                    </tr>
                </thead>

                <tbody class=" bg-white divide-2 divide-gray-300 dark:bg-gray-800">

                    @foreach ($productos as $p)
                        @if ($p->estado == 'HABILITADO')
                            <tr
                                class=" bg-white text-center dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-800 dark:text-gray-400">
                                {{-- <td class=" px-2 text-sm font-semibold flex flex-col justify-center items-center bg-red-300">
                                    <p class="whitespace-nowrap font-semibold">{{ $p->cod_producto }}</p>
                                    <p class="whitespace-nowrap text-xs">{{ $p->cod_oem }}</p>
                                
                                </td> --}}
                                <td>
                                    <a href="{{ route('Producto.show', $p->id) }}" class=" text-sm flex flex-col ">
                                        <span class="whitespace-nowrap font-semibold">
                                            {{ $p->cod_producto }}
                                        </span>
                                        <span class="whitespace-nowrap text-xs text-gray-600 dark:text-gray-400">
                                            {{ $p->cod_oem }}
                                        </span>
                                    </a>

                                </td>


                                <td class="px-2 py-1">
                                    <a href="{{ route('Producto.show', $p->id) }}">
                                        <div
                                            class="flex items-center text-sm py-1 px-1  bg-gray-50 rounded-lg 
                                        hover:shadow hover:shadow-gray-300  hover:border hover:border-gray-300 ">
                                            <div class=" hidden md:block w-2/12 h-full rounded-lg">
                                                <img class="object-cover w-10 h-10 rounded-xl"
                                                    src="{{ asset('img/fotosProductos/' . $p->foto) }}" alt="" />

                                            </div>
                                            <div class=" w-10/12  ml-1 ">
                                                <p class="font-semibold text-left">{{ $p->nombre }}</p>
                                                <p class="text-xs text-gray-800 dark:text-gray-400 text-left font-bold">
                                                    {{-- //si la cantidad es minima mostrar en rojo --}}
                                                    @if ($p->cantidad <= $p->cant_minima)
                                                        <span class="text-red-500">Stock: {{ $p->cantidad }}</span>
                                                    @else
                                                        Stock:{{ $p->cantidad }}
                                                    @endif

                                                </p>
                                                @if (!is_null($p->fecha_expiracion))
                                                    @if ($p->fecha_expiracion != '2100-09-26')
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 text-left">
                                                            Fecha de Expitacion: {{ $p->fecha_expiracion }}
                                                        </p>
                                                    @else
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                {{-- <td class="px-4 py-2 text-sm">
                                    {{ $p->precio_venta_con_factura }} Bs</td>
                                <td class="px-4 py-2 text-sm">
                                    {{ $p->precio_venta_sin_factura }} Bs</td>
                                <td class="px-4 py-2 text-sm">
                                    {{ $p->precio_compra }} Bs</td> --}}
                                <td class="px-4 py-1 text-sm  ">
                                    <div class="flex flex-col">
                                        <p class="whitespace-nowrap flex justify-between space-x-1">
                                            <span class="font-semibold">Compra:</span>
                                            <span> {{ $p->precio_compra }} Bs</span>
                                        </p>
                                        <p class="whitespace-nowrap  flex justify-between space-x-1">
                                            <span class="font-semibold">Sin factura:</span>
                                            <span> {{ $p->precio_venta_sin_factura }} Bs </span>
                                        </p>
                                        <p class="whitespace-nowrap flex justify-between space-x-1">
                                            <span class="font-semibold">Con factura:</span>
                                            <span>{{ $p->precio_venta_con_factura }} Bs </span>
                                        </p>
                                    </div>
                                </td>

                                {{-- <td class=" py-2 text-sm">
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-lime-800 bg-lime-400 rounded-lg dark:bg-lime-500 dark:text-black ">
                                        {{ $p->estante }} </span>
                                </td> --}}
                                <td class="text-sm ">
                                    <div class="flex flex-col bg-green-200  p-1 rounded-lg   ">
                                        <span
                                            class="font-semibold leading-tight text-green-700  rounded-full dark:bg-green-700 dark:text-green-100">
                                            {{ $p->tienda }}
                                        </span>
                                        <span
                                            class="font-semibold leading-tight mt-1 text-lime-800 bg-lime-400 rounded-lg dark:bg-lime-500 dark:text-black ">
                                            {{ $p->estante }}
                                        </span>
                                    </div>
                                </td>
                                {{-- <td class="px-4 py-3 text-xs">
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                {{ $p->estado }} </span>
                        </td> --}}
                                {{-- <td class="px-4 py-3 text-sm">{{ $p->fecha_expiracion }}</td> --}}
                                <td>
                                    <div class="px-4 text-sm flex flex-col ">
                                        <span class="whitespace-nowrap font-semibold">
                                            {{ $p->nombre_proveedor }}
                                        </span>
                                        <span class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $p->nombre_proveedor_contacto }}
                                        </span>
                                    </div>

                                </td>

                                <td>
                                    @if ($p->id_tugerente == 0)
                                        {{-- <p disabled
                                            class="whitespace-nowrap text-sm font-semibold text-black border  p-1 rounded-lg bg-red-100 flex items-center justify-center">
                                            <span class=" inline-block w-3 h-3 mr-2 rounded-full bg-red-500"></span>
                                            No Homologado
                                        </p> --}}
                                        <form action="{{ route('homologarProducto') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="prod_id" value="{{ $p->id  }}">
                                            <button type="submit"
                                            onclick="return confirm('Confirmar si en verdad desea homologar el producto: {{ $p->cod_producto }}?')"
                                            class="whitespace-nowrap text-sm font-semibold text-black border  p-1 rounded-lg bg-red-100 flex items-center justify-center">
                                            <span class=" inline-block w-3 h-3 mr-2 rounded-full bg-red-500"></span>
                                                <span class="whitespace-nowrap mr-1"> No Registrado!</span>
                                            </button>
                                        </form>
                                    @else
                                        <p disabled
                                            class="text-sm font-semibold text-black border  p-1 rounded-lg bg-blue-100 flex items-center justify-center">
                                            <span class="inline-block w-3 h-3 mr-2 rounded-full bg-blue-500"></span>
                                            Registrado 
                                             <img class="w-7  ml-1 rounded-lg" src="{{ asset('img/logo-tugerente.png') }}" alt="">
           
                                        </p>
                                    @endif
                                </td>

                                <td class="px-4 py-2 text-xs">
                                    <div class=" flex justify-around">

                                        {{-- <a href="{{ Route('Descargar', $p->id) }}"
                                                class="px-2 py-1 mx-1 font-semibold leading-tight text-yellow-900 bg-yellow-100 rounded-lg dark:bg-yellow-700 dark:text-yellow-100">
                                                Descar Imagen
                                            </a> --}}

                                        {{-- <button type="button"
                                            class="px-2 py-1 mx-1 font-semibold leading-tight text-yellow-900 bg-yellow-100 rounded-lg dark:bg-yellow-700 dark:text-yellow-100">
                                            <a href="{{ Route('Producto.show', $p->id) }}">
                                                Ver
                                            </a>
                                        </button> --}}

                                        @can('productos.edit')
                                            {{-- <button type="button"
                                                class="px-2 py-1 mx-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-lg dark:bg-green-700 dark:text-green-100">
                                                <a href="{{ Route('Producto.edit', $p->id) }}">
                                                    EDITAR
                                                </a></button> --}}
                                            <div class="flex justify-center ">
                                                <a href="{{ Route('Producto.edit', $p->id) }}" title="EDITAR"
                                                    class="  bg-blue-500 hover:bg-blue-500 rounded-lg w-fit p-2 mx-2 text-white
                                                        hover:scale-125 transition-transform delay-75">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </a>

                                            </div>
                                        @endcan

                                        @can('productos.destroy')
                                            <button type="button"
                                                class="mr-3 mx-1 text-sm bg-red-700 hover:bg-blue-700 text-white px-2 py-1 rounded focus:outline-none focus:shadow-outline">
                                                <form action="{{ Route('Producto.destroy', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Deshabilitar" class=""
                                                        onclick="return confirm('Desea Deshabilitar este Producto??')">
                                                </form>
                                            </button>
                                        @endcan
                                        @can('admin')
                                            <button type="button"
                                                class="mr-3 mx-1 text-sm bg-red-700 hover:bg-blue-700 text-white px-2 py-1 rounded focus:outline-none focus:shadow-outline">
                                                <form action="{{ Route('Producto.destroy', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Eliminar" class=""
                                                        onclick="return confirm('Desea Eliminar este Producto??')">
                                                </form>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="mt-4 mb-2">
            <!-- Pagination -->
            {{ $productos->appends([
                'productos' => $productos,
                'code_prod' => $code_prod,
                'proveedor' => $proveedor,
                'ubicacion' => $ubicacion,
                'tienda' => $tienda,
                'marca' => $marca,
                'stock_menores' => $stock_menores,
                'nombre_prod' => $nombre_prod,
            ]) }}
        </div>
    </div>
    <input type="hidden" id="pantalla" value="producto">
@endsection
