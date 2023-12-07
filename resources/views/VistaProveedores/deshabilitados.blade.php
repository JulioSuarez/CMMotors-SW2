@extends('navegador')

@section('Contenido')
    <div class="mt-4 mx-4">

        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <h2 class="text-3xl font-extrabold text-gray-200 md:text-4xl">
                LISTA DE PROVEEDORES DESHABILITADOS </h2>
        </div>
        {{--
        @if (session('RegistroEliminado'))
        <p class="text-white bg-lime-500 p-2 text-sm rounded-xl mx-8 w-max">
            Venta Nro: {{ session('RegistroEliminado') }} Eliminada correctamente
        </p>
    @endif --}}

        @if (session('ProveedorRegistrado'))
            <p class="text-white bg-lime-500 p-2 text-sm rounded-xl mx-8 w-max">
                {{ session('ProveedorRegistrado') }}
            </p>
        @endif

        {{-- @if (session('VentasUpdate'))
        <p class="text-white bg-lime-500 p-2 text-sm rounded-xl mx-8 w-max">
            {{ session('VentasUpdate') }}
        </p>
    @endif --}}

        <div class="relative w-full max-w-full flex-grow flex-1 text-left">
            <a href="{{ Route('Proveedor.create') }}"
                class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                Registrar Proveedor
            </a>
        </div>
        <div class="mt-4 mx-4">
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Nombre/Razon Social</th>
                                <th class="px-4 py-3">CI/NIT</th>
                                <th class="px-4 py-3">Contacto</th>
                                <th class="px-4 py-3">Telefono</th>
                                <th class="px-4 py-3">Dirección</th>
                                <th class="px-4 py-3">Correo</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($proveedores as $p)
                                <tr
                                    class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
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
                                    <td class="px-4 py-3 text-sm">
                                        {{ $p->nit }}</td>
                                    <td class="px-4 py-3 text-xs">
                                        <p>{{ $p->nombre_proveedor_contacto }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <p>{{ $p->proveedor_telefono }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <p>{{ $p->proveedor_direccion }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <p>{{ $p->proveedor_correo }}</p>
                                    </td>


                                    <td class="px-4 py-3 text-xs">
                                        @can('proveedores.edit')
                                            <button type="button"
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                <a href="{{ Route('Proveedor.edit', $p->id) }}">
                                                    EDITAR
                                                </a></button>
                                        @endcan

                                        @can('proveedores.destroy')
                                            <button type="button"
                                                class="mr-3 text-sm bg-blue-700 hover:bg-blue-800 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                                <form action="{{ Route('proveedor.habilitar', $p->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="submit" value="Habilitar" class=""
                                                        onclick="return confirm('Desea Eliminar Habilitar este Proveedor?')">
                                                </form>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div
                    class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <!-- Pagination -->
                    <span class="flex col-span-0 mt-0 sm:mt-auto sm:justify-center">
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                {{ $proveedores->links() }}
                            </ul>
                        </nav>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="pantalla" value="proveedor">
@endsection
