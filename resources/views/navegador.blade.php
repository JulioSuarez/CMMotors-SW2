<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CM Motor's Import Export</title>
    @vite('resources/css/app.css')
    @livewireStyles()
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="scrollbar-xd">

    {{-- contador de visitas por pagina --}}
    <div x-data="{ Configuraciones: false }">
        <div class="fixed bottom-4 right-4 z-50">
            <button @click="Configuraciones = !Configuraciones"
                class="flex items-center bg-gray-200 hover:bg-gray-300 text-white font-bold py-2 px-4 rounded">
                <span>
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M1 5h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 1 0 0-2H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2Zm18 4h-1.424a3.228 3.228 0 0 0-6.152 0H1a1 1 0 1 0 0 2h10.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Zm0 6H8.576a3.228 3.228 0 0 0-6.152 0H1a1 1 0 0 0 0 2h1.424a3.228 3.228 0 0 0 6.152 0H19a1 1 0 0 0 0-2Z" />
                    </svg>
                </span>
            </button>

        </div>

        <div x-show="Configuraciones" class="fixed bottom-16 right-4 z-50">
            <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300"
                role="alert">
                <span class="font-medium">Visitas en {{ $rutaActual }}: </span>{{ session($contadorKey) }}
            </div>
        </div>
    </div>
    {{-- FIN contador de visitas por pagina --}}



    <!-- component -->
    <style>
        /* Compiled dark classes from Tailwind */
        .dark .dark\:divide-gray-700> :not([hidden])~ :not([hidden]) {
            border-color: rgba(55, 65, 81);
        }

        .dark .dark\:bg-gray-50 {
            background-color: rgba(249, 250, 251);
        }

        .dark .dark\:bg-gray-100 {
            background-color: rgba(243, 244, 246);
        }

        .dark .dark\:bg-gray-600 {
            background-color: rgba(75, 85, 99);
        }

        .dark .dark\:bg-gray-700 {
            background-color: rgba(55, 65, 81);
        }

        .dark .dark\:bg-gray-800 {
            background-color: rgba(31, 41, 55);
        }

        .dark .dark\:bg-gray-900 {
            background-color: rgba(17, 24, 39);
        }

        .dark .dark\:bg-red-700 {
            background-color: rgba(185, 28, 28);
        }

        .dark .dark\:bg-green-700 {
            background-color: rgba(4, 120, 87);
        }

        .dark .dark\:hover\:bg-gray-200:hover {
            background-color: rgba(229, 231, 235);
        }

        .dark .dark\:hover\:bg-gray-600:hover {
            background-color: rgba(75, 85, 99);
        }

        .dark .dark\:hover\:bg-gray-700:hover {
            background-color: rgba(55, 65, 81);
        }

        .dark .dark\:hover\:bg-gray-900:hover {
            background-color: rgba(17, 24, 39);
        }

        .dark .dark\:border-gray-100 {
            border-color: rgba(243, 244, 246);
        }

        .dark .dark\:border-gray-400 {
            border-color: rgba(156, 163, 175);
        }

        .dark .dark\:border-gray-500 {
            border-color: rgba(107, 114, 128);
        }

        .dark .dark\:border-gray-600 {
            border-color: rgba(75, 85, 99);
        }

        .dark .dark\:border-gray-700 {
            border-color: rgba(55, 65, 81);
        }

        .dark .dark\:border-gray-900 {
            border-color: rgba(17, 24, 39);
        }

        .dark .dark\:hover\:border-gray-800:hover {
            border-color: rgba(31, 41, 55);
        }

        .dark .dark\:text-white {
            color: rgba(255, 255, 255);
        }

        .dark .dark\:text-gray-50 {
            color: rgba(249, 250, 251);
        }

        .dark .dark\:text-gray-100 {
            color: rgba(243, 244, 246);
        }

        .dark .dark\:text-gray-200 {
            color: rgba(229, 231, 235);
        }

        .dark .dark\:text-gray-400 {
            color: rgba(156, 163, 175);
        }

        .dark .dark\:text-gray-500 {
            color: rgba(107, 114, 128);
        }

        .dark .dark\:text-gray-700 {
            color: rgba(55, 65, 81);
        }

        .dark .dark\:text-gray-800 {
            color: rgba(31, 41, 55);
        }

        .dark .dark\:text-red-100 {
            color: rgba(254, 226, 226);
        }

        .dark .dark\:text-green-100 {
            color: rgba(209, 250, 229);
        }

        .dark .dark\:text-blue-400 {
            color: rgba(96, 165, 250);
        }

        .dark .group:hover .dark\:group-hover\:text-gray-500 {
            color: rgba(107, 114, 128);
        }

        .dark .group:focus .dark\:group-focus\:text-gray-700 {
            color: rgba(55, 65, 81);
        }

        .dark .dark\:hover\:text-gray-100:hover {
            color: rgba(243, 244, 246);
        }

        .dark .dark\:hover\:text-blue-500:hover {
            color: rgba(59, 130, 246);
        }

        /* Custom style */
        .header-right {
            width: calc(100% - 3.5rem);
        }

        .sidebar:hover {
            width: 16rem;
        }

        @media only screen and (min-width: 768px) {
            .header-right {
                width: calc(100% - 16rem);
            }
        }
    </style>

    <div x-data="setup()" :class="{ 'dark': isDark }" ">
        <div class="h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-100 dark:bg-gray-700 text-black dark:text-white">

            <!-- Header// barra de arriba, el el buscador la extrella y el logout  -->
            <div class="fixed w-full flex items-center justify-between h-14 text-white z-10 ">
                <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-blue-800 dark:bg-gray-800 border-none">
                    <a href="{{ Route('Dashboard') }}">
                        <img class="w-100 h-2 md:w-100 md:h-10 mr-2 rounded-md overflow-hidden"
                        src="{{ asset('img/logo-cm.gif') }}" />
                    </a>
                </div>
                <div class=" flex justify-between  h-14 dark:bg-gray-800 bg-blue-800 header-right ">
                    <div class="flex relative ">
                        <button id="bt_cambiar_busqueda" class="p-1 text-center flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d=" M10.5 6h9.75M10.5 6a1.5 1.5 0
        11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75
        0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
    </svg>

    </button>
    <div id="busqueda_estado" class="hidden absolute top-12  z-40 bg-gray-900 text-white px-2 py-1 rounded-lg">
        Busqueda por Codigo
    </div>

    <ul id="" class="flex flex-col m-1">
        <li class=" ">
            <!-- boton de buscar -->
            <div class="flex bg-gray-200 border border-gray-200 rounded   w-56 sm:w-72   mr-2 my-0.5 p-2 shadow-sm ">
                <div class="  ">
                    <svg class="w-5 text-gray-600 h-full " fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div class="search w-56">
                    <i class="fas fa-search icon"></i>
                    <input type="text" id="mysearch"
                        class=" w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent"
                        placeholder="Buscar por Codigo" autocomplete="off">

                </div>

                <button
                    class=" cursor-pointer top-0 right-0 text-gray-600 hover:text-gray-900 hover:ring-gray-900 hover:ring-2 transition duration-150 ease-in-out rounded "
                    id="bt_limpiar" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20"
                        height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>

            </div> <!-- end de boton de buscar-->
        </li>
        <input type="text" id="verificarVentasCreate" value="vacio" hidden>
        <li id="ListaProductos">

            {{-- <button class="text-black text-sm bg-gray-200 rounded  flex items-center w-56 sm:w-96  my-0.5 p-1 shadow-sm border border-gray-800">
                                <img src="" alt="" class="'m-1 ml-1 border border-black rounded-2xl object-cover h-14 w-14">
                                <div class="flex-col flex justify-center p-2 w-full ">
                                    <p class="font-semibold font-mono  uppercase "> onmbre xd  shfdfsfsdhf shdff gdhdfhdfh deewdwwdew dsafdasfdsafdsf sadfsadfdsafds asdf sdfsadfsdfs asdf sadf sadf </p>
                                    <div class="flex justify-evenly font-mono px-4 space-x-2 ">
                                        <div class="flex flex-col text-xs  w-full text-left space-y-1 ">
                                            <span class="bg-green-400 rounded-md px-1"> COD PROD: 8882367 </span>
                                            <span class="bg-green-400 rounded-md px-1"> COD OEM: 8882367 </span>
                                        </div>
                                        <div class="flex flex-col text-xs  w-full text-right space-y-1">
                                            <p class="bg-yellow-300 rounded-md px-1" > PRECIO: 134893 bs </p>
                                            <p class="bg-yellow-300 rounded-md px-1"> STOCK: 99 </p>
                                        </div>
                                    </div>
                                    </div>
                                </button> --}}
            {{--
                                <button class="bt_buscados text-black text-sm bg-gray-200 rounded  flex items-center  w-56 sm:w-96 p-1  my-0.5 shadow-sm border border-gray-800">
                                    <img src="" alt="" class="'m-1 ml-1 border border-black rounded-2xl object-cover h-14 w-14">
                                    <div class="flex-col flex justify-center  p-2 w-full">
                                        <p class="font-semibold font-mono "> onmbre xd  shfdfsfsdhf shdf shfsk f skdhf ksf</p>

                                        <div class="grid grid-cols-2 sm:grid-cols-4 text-xs gap-0 ">
                                           <div class="flex flex-col col-span-2 ">
                                                <p class=""> PRO: 88823673332 </p>
                                                <p class=""> OEM: 88823673332 </p>
                                           </div>
                                            <div class="flex flex-col col-span-2">
                                                <p class=""> Cant: 99 </p>
                                                <p class=""> 13893.00 bs </p>
                                            </div>
                                        </div>

                                    </div>
                                </button> --}}


        </li>
    </ul>
    </div>

    <ul class="flex items-center">
        <!-- boton de cambio de modo noche o claro -->
        {{-- <li>
                            <button id="holaxd" type="button"> hola xd </button>
                        </li> --}}
        <li class="">
            <button aria-hidden="true" @click="toggleTheme"
                class="group p-2 transition-colors duration-200 rounded-full shadow-md bg-blue-200 hover:bg-blue-200 dark:bg-gray-50 dark:hover:bg-gray-200 text-gray-900 focus:outline-none">
                <svg x-show="isDark" width="24" height="24"
                    class="fill-current text-gray-700 group-hover:text-gray-500 group-focus:text-gray-700 dark:text-gray-700 dark:group-hover:text-gray-500 dark:group-focus:text-gray-700"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                <svg x-show="!isDark" width="24" height="24"
                    class="fill-current text-gray-700 group-hover:text-gray-500 group-focus:text-gray-700 dark:text-gray-700 dark:group-hover:text-gray-500 dark:group-focus:text-gray-700"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </li>

        <!-- lines recta -->
        <li>
            <div class="block w-px h-6 mx-3 bg-gray-400 dark:bg-gray-700">
            </div>
        </li>

        <!-- Boton de cierre de seccion -->
        <li>
            <form action="{{ Route('Logout') }}" method="POST" class="flex items-center mr-4 hover:text-blue-100">
                @csrf
                <span class="inline-flex mr-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                </span>
                <button type="submit">
                    Logout
                </button>
            </form>
        </li>
    </ul>
    </div>
    </div>

    <!-- end Header// de la barra de arriba -->

    <!-- para verifcar si esta abireto el nav -->
    <input type="hidden" id="boolean_div_menu" value="true">

    <!-- Sidebar // barrera lateral  // navegador -->
    <div id="div_menu_nav"
        class="fixed flex flex-col top-14 bottom-0  w-14 xl:w-64 bg-blue-900 dark:bg-gray-900  text-white transition-all duration-300 border-none z-10 ">
        <!-- md:w-64 hover:w-64 -->

        <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow   " id="div_navegador">
            <!-- BOTONES DEL NAVEGADOR -->
            <ul class="flex flex-col py-2 space-y-1">

                <li>
                    <button id="bt_menu"
                        class="relative   flex w-full items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">
                            MENU
                        </span>
                    </button>
                </li>
                @can('dashboard.index')
                    @php
                        //metodo para sacar la cantidad de productos con cantidad minima "c"
                        $productos = DB::table('productos')->get();
                        $c = 0;
                        foreach ($productos as $p) {
                            if ($p->estado == 'HABILITADO' && $p->cantidad <= $p->cant_minima) {
                                $c = $c + 1;
                            }
                        }
                    @endphp
                    <li>
                        <a href="{{ Route('Dashboard') }}" id="a_dashboard"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">
                                Dashboard
                            </span>
                            <span id="notificacion"
                                class="hidden  xl:block px-2 py-0.5 ml-auto text-xs font-medium
                                        tracking-wide text-red-500 bg-red-50 rounded-full">
                                {{ $c }}
                            </span>
                        </a>
                    </li>
                @endcan



                @can('productos.index')
                    <li>
                        <a href="{{ Route('Producto.index') }}" id="a_producto"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">
                                Productos
                            </span>

                        </a>
                    </li>
                @endcan
                @can('proveedores.index')
                    <li>
                        <a href="{{ Route('Proveedor.index') }}" id="a_proveedor"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">
                                Proveedores
                            </span>
                        </a>
                    </li>
                @endcan
                @can('ventas.index')
                    <li>
                        <a href="{{ Route('Venta.index') }}" id="a_venta"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>

                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Ventas</span>
                        </a>
                    </li>
                @endcan

                @can('cotizacion.index')
                    <li>
                        <a href="{{ Route('Cotizar.index') }}" id="a_cotizacion"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">
                                Cotizaciones
                            </span>
                        </a>
                    </li>
                @endcan


                @can('empleados.index')
                    <li>
                        <a href="{{ Route('Empleado.index') }}" id="a_empleado"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">
                                Empleados
                            </span>
                        </a>
                    </li>
                @endcan

                @can('cliente.index')
                    <li>
                        <a href="{{ Route('Cliente.index') }}" id="a_cliente"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Clientes</span>
                        </a>
                    </li>
                @endcan

                @can('reportes.index')
                    <li>
                        <a href="{{ Route('reporte') }}" id="a_reporte"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">
                                Reportes
                            </span>
                        </a>
                    </li>
                @endcan

                @can('roles.index')
                    <li>
                        <a href="{{ Route('Rol.index') }}" id="a_rol"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">
                                Roles y permisos
                            </span>
                        </a>
                    </li>
                @endcan
                @can('roles.index')
                    <li>
                        <a href="{{ Route('TallerGrado') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-800 dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-r-2 border-gray-800 hover:border-blue-500 dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">
                                Taller de Grado
                            </span>
                        </a>
                    </li>
                @endcan
            </ul>
            <p class="px-5 py-3 hidden md:block text-center text-xs">CM Motor´s @2022</p>

        </div>
    </div>

    <!-- ./Sidebar -->
    <!-- CONTENDIO CENTRAL -->
    <div id="div_contenido" class=" ml-14  xl:ml-64 mt-14 h-full bg-gray-100 dark:bg-gray-700 ">

        <!-- aqui podemos poner el cuerpo -->
        @yield('Contenido')

    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    <script>
        const setup = () => {
            const getTheme = () => {
                if (window.localStorage.getItem('dark')) {
                    return JSON.parse(window.localStorage.getItem('dark'))
                }
                return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
            }

            const setTheme = (value) => {
                window.localStorage.setItem('dark', value)
            }

            return {
                loading: true,
                isDark: getTheme(),
                toggleTheme() {
                    this.isDark = !this.isDark
                    setTheme(this.isDark)
                },
            }
        }
    </script>
    {{-- <script src="{{ asset('js/buscador/search.js') }}" type="module"></script> --}}

    <script src="{{ asset('js/buscador/buscador.js') }}" type="module"></script>
    <script src="{{ asset('js/buscador/navegador.js') }}"></script>


</body>
@livewireScripts()

</html>
