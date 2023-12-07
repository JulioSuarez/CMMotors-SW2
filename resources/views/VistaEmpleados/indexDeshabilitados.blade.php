@extends('navegador')

@section('Contenido')
    <div class="mt-4 mx-4">
        <div class="md:col-span-2 xl:col-span-3 text-center font-semibold">
            <p class="text-lg">Lista de Empleados</p>
        </div>
        <div class="mt-4 mx-4">
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <div class="relative w-full max-w-full flex pb-2 flex-1 text-right">
                                <a href="{{ Route('Empleado.create') }}"
                                    class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Registrar
                                    Empleado</a>
                            </div>
                            {{-- <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                                <a href="{{ Route('Clientes.pdf') }}"
                                    class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Imprimir
                                    </a>
                            </div> --}}
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">CI</th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Telefono</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($empleados as $p)
                                <tr
                                    class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            {{-- <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full"
                                                src="{{ asset('img/fotosEmpleados/' . $p->foto) }}" alt=""
                                                loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                                </div>
                                            </div> --}}
                                            <div>
                                                <p class="font-semibold">{{ $p->ci }}</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm capitalize">{{ $p->nombre }}</td>
                                    <td class="px-4 py-3 text-xs">
                                        <p>{{ $p->telefono }}</p>
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        @can('empleados.edit')
                                        <button type="button"
                                            class="m-2 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            <a href="{{ Route('Empleado.edit', $p->ci) }}">
                                                EDITAR
                                            </a></button>
                                        @endcan
                                        @can('empleados.destroy')
                                        <button type="button"
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                            <form action="{{ Route('Empleado.destroy', $p->ci) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Deshabilitar" class=""
                                                    onclick="return confirm('Desea Deshabilitar a este Trabajador?')">
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
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="pantalla" value="empleado">
@endsection
