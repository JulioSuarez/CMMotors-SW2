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
{{-- @dd($p) --}}
    <div class=" bg-white">
        <nav aria-label="Breadcrumb" class="pt-3 bg-white ">
            <ol role="list " class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <li>
                    <div class="flex items-center">
                        <a href="/" class="mr-2 text-sm font-medium text-gray-900">Inicio</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-4 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                        <a href="/Producto" class="mr-2 text-sm font-medium text-gray-900">Productos</a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-4 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>

                <li class="text-sm">
                    <p aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ $p->nombre }}
                    </p>
                </li>
            </ol>
        </nav>

    
        <div class="  grid grid-cols-1 sm:grid-cols-5 mt-5 mx-5 ">
            <!--mb-4 aspect-w-4 aspect-h-5 sm sm:rounded-lg lg:aspect-w-3 lg:aspect-h-4-->
            <div class=" sm:col-span-2 flex items-center px-5">
                <img src="{{ asset('img/fotosProductos/' . $p->foto) }}" alt="Model wearing plain white basic tee."
                    class=" object-cover object-center ">
            </div>
            <!-- Options -->
            <div class="bg-white sm:col-span-3">
                <p class="bg-gray-300 p-3 font-bold text-black">
                    {{ $p->nombre }}
                </p>
                <table class="uppercase table-auto w-full text-black ">
                    <tbody class="">
                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Codigo Producto:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->cod_producto }}
                            </td>
                        </tr>
                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Codigo OEM:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->cod_oem }}
                            </td>
                        </tr>
                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Precio de Compra:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->precio_compra }} Bs
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Precio C/Factura:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->precio_venta_con_factura }} Bs
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Precio S/Factura:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->precio_venta_sin_factura }} Bs
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Ubicacion:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->estante }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Marca:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->marca }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Procedencia:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->procedencia }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Origen:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->origen }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Stock:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->cantidad }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Stock Minimo:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->cant_minima }}
                            </td>
                        </tr>

                        @if (is_null($p->fecha_expiracion) || $p->fecha_expiracion == "2100-09-26" )

                        @else
                            <tr class="border-b ">
                                <th class="text-left py-1 px-4 ">
                                    Vence:
                                </th>
                                <td class="text-left py-1 px-2 ">
                                    {{ $p->fecha_expiracion }}
                                </td>
                            </tr>
                        @endif


                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Proveedor:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->nombre_proveedor }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Correo:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->proveedor_correo }}
                            </td>
                        </tr>

                        <tr class="border-b ">
                            <th class="text-left py-1 px-4 ">
                                Contacto:
                            </th>
                            <td class="text-left py-1 px-2 ">
                                {{ $p->proveedor_telefono }}
                            </td>
                        </tr>

                    </tbody>

                </table>


                <div class="grid grid-cols-2 gap-x-10 m-4 px-8">
                    @can('productos.edit')
                    <a  href="{{ Route('Producto.edit', $p->id) }}"
                        class="px-2 py-2 text-center  font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100
                        hover:bg-green-300">
                        
                            EDITAR
                      
                    </a>
                    @endcan

                    @can('productos.destroy')
                    @if ($p->estado == 'HABILITADO')
                        <button type="button"
                            class="mr-3 text-sm  bg-red-700 hover:bg-blue-700 text-white  rounded-full focus:outline-none focus:shadow-outline">
                            <form action="{{ Route('Producto.destroy', $p->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="DESHABILITAR" class=" cursor-pointer px-2 py-1 w-full h-full"
                                    onclick="return confirm('Desea Deshabilitar este Producto?')">
                            </form>
                        </button>
                    @else
                        <button type="button"
                            class="mr-3 text-sm bg-blue-700 hover:bg-blue-400 text-white px-2 py-1 rounded-full focus:outline-none focus:shadow-outline">
                            <form action="{{ Route('producto.habilitado', $p->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="submit" value="HABILITAR" class=""
                                    onclick="return confirm('Desea Habilitar este Producto?')">
                            </form>
                        </button>
                    @endif
                    @endcan
                    {{-- <a href="{{Route('Descargar',$p->id)}}">Descar Imagen</a> --}}
                </div>



            </div>

        </div>

    </div>
    <input type="hidden" id="pantalla" value="producto">
@endsection
