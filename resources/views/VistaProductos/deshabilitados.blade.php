@extends('navegador')

@section('Contenido')
    {{-- <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
        <h2 class="text-3xl font-extrabold text-gray-200 md:text-4xl">
            LISTA DE PRODUCTOS
        </h2>

    </div> --}}
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
        LISTA DE PRODUCTOS DESHABILITADOS 
    </p>

    <div class=" flex justify-between items-center mx-5">
        @if (session('RegistroProducto'))
            <p class="text-white w-fit p-2 bg-lime-500 text-sm text-center rounded-xl  h-full sm:w-fit mt-4">
                {{ session('RegistroProducto') }}
                {{-- REgistro exitoso --}}
            </p>
        @endif
    </div>



    <div class=" my-3 mx-5 overflow-hidden rounded-lg ">
        <!-- reemplace w-full por mx-8 -->
        <div class="  overflow-x-auto">
            <table class="w-full overflow-x-auto ">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-center uppercase border-b dark:border-gray-700 text-gray-300 h-12 bg-gray-800">
                        <!-- dark:text-gray-200 dark:bg-gray-800-->
                        <th class="">Codigo</th>
                        <th class="">Productos ({{$count}})</th>
                        <th class="">Precio de Costo</th>
                        <th class="p-1">Precio Con Factura</th>
                        <th class="">Precio Sin Factura</th>
                        <th class="">Ubicación</th>
                        <th class="">Tienda</th>
                        {{-- <th class="">Tienda</th> --}}
                        {{-- <th class="">Fecha de Expiración</th> --}}
                        <th class="">Proveedor</th>
                        <th class="">Acciones</th>
                    </tr>
                </thead>

                <tbody class=" bg-white divide-2 divide-gray-300 dark:bg-gray-800">

                    @foreach ($productos as $p)
                        <tr
                            class=" bg-gray-50 text-center dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                            <td class=" px-2 text-sm">{{ $p->cod_oem }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full"
                                            src="{{ asset('img/fotosProductos/' . $p->foto) }}" alt=""
                                            loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-left">{{ $p->nombre }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 text-left">Stock:
                                            {{ $p->cantidad }}
                                        </p>
                                        @if ($p->fecha_expiracion != '2100-09-26' || $p->fecha_expiracion != null)
                                        @else
                                            <p class="text-xs text-gray-600 dark:text-gray-400 text-left">Fecha de
                                                Expitacion:
                                                {{ $p->fecha_expiracion }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $p->precio_compra }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ $p->precio_venta_con_factura }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ $p->precio_venta_sin_factura }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-black bg-lime-500 rounded-full dark:bg-lime-500 dark:text-black">
                                    {{ $p->estante }} </span>
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    {{ $p->tienda }} </span>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $p->nombre_proveedor }}
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{ $p->nombre_proveedor_contacto }}
                            </td>

                            <td class="px-4 py-3 text-xs">
                                <div class=" flex justify-around">
                                    {{-- <button type="button"
                                            class="px-2 py-1 mx-1 font-semibold leading-tight text-yellow-900 bg-yellow-100 rounded-lg dark:bg-yellow-700 dark:text-yellow-100">
                                            <a href="{{ Route('Descargar', $p->id) }}">
                                                Descar Imagen
                                            </a></button> --}}
                                    {{-- <button type="button"
                                            class="px-2 py-1 mx-1 font-semibold leading-tight text-yellow-900 bg-yellow-100 rounded-lg dark:bg-yellow-700 dark:text-yellow-100">
                                            <a href="{{ Route('Producto.show', $p->id) }}">
                                                Ver
                                            </a></button> --}}
                                    {{-- @can('ventas.edit')
                                            <button type="button"
                                                class="px-2 py-1 mx-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-lg dark:bg-green-700 dark:text-green-100">
                                                <a href="{{ Route('Producto.edit', $p->id) }}">
                                                    EDITAR
                                                </a></button>
                                        @endcan --}}
                                    {{-- habilitar --}}

                                    {{-- @can('ventas.destroy') --}}
                                        <button type="button"
                                            class="mr-3 mx-1 text-sm bg-blue-700 hover:bg-blue-400 text-white px-2 py-1 rounded focus:outline-none focus:shadow-outline">
                                            <form action="{{ Route('producto.habilitado', $p->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="submit" value="Habilitar" class=""
                                                    onclick="return confirm('Desea Habilitar este Producto??')">
                                            </form>
                                        </button>
                                    {{-- @endcan --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">
                            <li>
                                <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                    {{ $productos->links() }}
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> --}}

        </div>
    </div>
    <input type="hidden" id="pantalla" value="producto">
@endsection
