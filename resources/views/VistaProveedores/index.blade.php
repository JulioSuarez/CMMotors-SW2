@extends('navegador')

@section('Contenido')
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

    <div class="mt-4 mx-4">

         <h2 class="font-extrabold  text-gray-900 dark:text-gray-200 text-center sm:m-4 m-3 pt-1 text-2xl  sm:text-3xl lg:text-4xl">
                LISTA DE PROVEEDORES</h2>

        @if (session('ProveedorRegistrado'))
            <p class="text-white bg-lime-500 p-2 text-sm rounded-xl mx-8 w-max">
                {{ session('ProveedorRegistrado') }}
            </p>
        @endif

        <div class=" w-full flex  space-x-3">
            <a href="{{ Route('Proveedor.create') }}"
                class="p-2 bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase rounded outline-none focus:outline-none ease-linear transition-all duration-150">
                Registrar Proveedor
            </a>
            @can('proveedores.destroy')
                <a href="{{ Route('proveedor.deshabilitado') }}"
                    class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase p-2 rounded outline-none focus:outline-none ease-linear transition-all duration-150">
                    Deshabilitados
                </a>
            @endcan

            {{-- <div>
                <input id="ip_buscar"
                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 bg-white border-gray-400 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" wire:model="search" wire:input="cerrarModal"
                    placeholder="Buscar por {{ $buscar_por }}.."
                >
            </div> --}}

            <div class="relative h-full">
                {{-- wire:click='abrirModal()' --}}
                <div id="bt_buscar"
                    class="ml-1 h-full cursor-pointer flex justify-center items-center text-gray-600 border border-gray-400 bg-white shadow rounded-md px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                    </svg>
                </div>

                {{-- <div id="div_buscar"
                    class="fixed {{ $modal_buscar ? '' : 'hidden' }} w-60 mt-1 rounded-md shadow-md  border border-gray-400 bg-white text-left">
                    <div class="flex flex-col px-2 py-3  text-gray-800 ">
                        <div class="flex  space-x-1 px-1  hover:text-blue-500  ">
                            <input id="ip_nombre" type="checkbox" name="buscar_select" checked
                                wire:click='actualizarBuscar("nombre")'>
                            <label for="ip_nombre" class=" cursor-pointer py-1 ">
                                Nombre o Razon Social
                            </label>
                        </div>

                        <div class="flex   space-x-1 px-1 hover:text-blue-500  ">
                            <input id="ip_ci" type="checkbox" name="order_select"
                                wire:click='actualizarBuscar("ci")'>
                            <label for="ip_ci" class=" cursor-pointer py-1 ">
                                CI o NIT
                            </label>
                        </div>

                        <div class="flex   space-x-1 px-1 hover:text-blue-500  ">
                            <input id="ip_telefono" type="checkbox" name="order_select"
                                wire:click='actualizarBuscar("telefono")'>
                            <label for="ip_telefono" class=" cursor-pointer py-1 ">
                                Telefono
                            </label>
                        </div>

                        <div class="flex space-x-1 px-1 hover:text-blue-500  ">
                            <input id="ip_correo" type="checkbox" name="order_select"
                                wire:click='actualizarBuscar("correo")'>
                            <label for="ip_correo" class=" cursor-pointer py-1 ">
                                Correo
                            </label>
                        </div>

                    </div>
                </div> --}}
            </div>

        </div>


        <div class="mt-4 mx-4">
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700 text-gray-300 h-12 bg-gray-800">
                                <th class="px-4 py-3">Nro</th>
                                <th class="px-4 py-3">Nombre/Razon Social</th>
                                <th class="px-4 py-3">CI/NIT</th>
                                <th class="px-4 py-3">Contacto</th>
                                <th class="px-4 py-3">Telefono</th>
                                <th class="px-4 py-3">Dirección y Correo</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @php
                                $cont = 0;
                            @endphp
                            @foreach ($proveedores as $p)
                                <tr
                                    class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                    <td class="px-4 text-sm">
                                        {{ ++$cont }}</td>
                                    <td class="px-4 py-1 ">
                                        <div class="flex items-center text-sm">
                                            {{-- <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                                    alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                                </div>
                                            </div> --}}
                                            <div>
                                                <p class="font-semibold">{{ $p->nombre_proveedor }}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $p->tipo }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 text-sm">
                                        {{ $p->nit }}</td>
                                    <td class="px-4  text-xs">
                                        <p>{{ $p->nombre_proveedor_contacto }}</p>
                                    </td>
                                    <td class="px-4 text-xs">
                                        <p>{{ $p->proveedor_telefono }}</p>
                                    </td>
                                    <td class="px-4 text-xs w-48">
                                        <p>{{ $p->proveedor_direccion }}</p>
                                        <p class="w-fit text-xs">{{ $p->proveedor_correo }}</p>
                                    </td>

                                    <td class="px-4 py-3 text-xs flex justify-center items-center">
                                        @can('proveedores.edit')
                                            <button type="button"
                                                class="mr-3 py-1 px-2 font-semibold leading-tight text-green-700 bg-green-100 rounded dark:bg-green-700 dark:text-green-100">
                                                <a href="{{ Route('Proveedor.edit', $p->id) }}">
                                                    EDITAR
                                                </a>
                                            </button>
                                        @endcan

                                        @can('proveedores.destroy')
                                            <button type="button"
                                                class="mr-3 text-sm bg-red-700 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                                <form action="{{ Route('Proveedor.destroy', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Deshabilitar" class=""
                                                        onclick="return confirm('Desea Deshabilitar este Proveedor?')">
                                                </form>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                {{ $proveedores->links() }}
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="pantalla" value="proveedor">
@endsection
