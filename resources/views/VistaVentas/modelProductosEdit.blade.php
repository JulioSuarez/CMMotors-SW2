{{-- @dd($detalles) --}}
<dialog id="myModal{{ $i }}" class="h-1/1 w-80 lg:w-96  p-3 rounded-2xl ">

    <!--bt_cerrar_modal-->
    <button id="bt_cerrar_modal{{ $i }}" type="button"
        class="cursor-pointer absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
            width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5"
            stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
    </button>
    <div class=" h-auto lg:px-4  px-2 ">
        <!--div principal-->
        <p class="text-base font-extrabold  uppercase font-serif text-center py-2 pr-2"
            id="p_nombre_prod{{ $i }}">
            {{-- NOMBRE DE PRODUCTO --}}
            {{ $detalles[$i - 1]->nombre }}
        </p>

        <!-- div_img_flex -->
        <div
            class=" flex justify-around
        aspect-w-4 aspect-h-5 sm sm:rounded-lg lg:aspect-w-3 lg:aspect-h-4">
            <img src="{{ asset('img/fotosProductos/' . $detalles[$i - 1]->foto) }}"
                alt="no se pillo" width="80"
                class=" h-full object-cover object-center rounded-lg "
                id="img_producto_venta{{ $i }}">

             <div class="w-full flex flex-col justify-around ml-1 px-2 sm:px-4 font-bold text-sm">
                <div class="flex justify-between py-1 border-b border-gray-300">
                    <p>Precio C/F: </p>
                    <p id="p_precio_fact_prod{{$i}}" class="text-gray-500 pr-2">{{$detalles[$i - 1]->precio_venta_con_factura }} </p>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-300">
                    <p id="">Ubicacion: </p>
                    <p id="p_estante_prod{{$i}}" class="text-gray-500 pr-2">{{$detalles[$i - 1]->estante }} </p>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-300">
                    <p id="">Cantidad: </p>
                    <p id="p_cantidad_prod{{$i}}" class="text-gray-500 pr-2"> {{$detalles[$i - 1]->cantidad }}</p>
                </div>

            </div>
        </div>



        <div class=" mx-2 mt-4 mb-0">
            <!-- div_descripcion-->
            <p class="text-sm mb-2 font-medium text-gray-900">Descripción</p>

            <ul class="list-disc space-y-2 pl-4 mb-4 text-sm text-gray-800">
                <li class="mb-3 ">
                    <div class="flex justify-between border-b border-gray-300">
                        <p class="font-semibold"> Codigo Producto: </p>
                        <p id="p_pro{{$i}}" class="pr-4">{{ $detalles[$i - 1]->cod_producto }} </p>
                    </div>
                </li>
                <li class="mb-3 ">
                    <div class="flex justify-between border-b border-gray-300">
                        <p class="font-semibold"> Codigo Oem: </p>
                        <p id="p_alt{{$i}}" class="pr-4">{{ $detalles[$i - 1]->cod_oem }} </p>
                    </div>
                </li>
                <li class="mb-3">
                    <div class="flex justify-between border-b border-gray-300">
                        <span class="font-semibold">Precio Compra: </span>
                        <span id="p_precio_comp{{$i}}" class="pr-4">{{ $detalles[$i - 1]->precio_compra }}</span>
                    </div>
                </li>

                <li class="mb-3">
                    <div class="flex justify-between border-b border-gray-300">
                        <span class="font-semibold">Precio S/Factura: </span>
                        <span id="p_precio_sin_fact{{$i}}" class="pr-4">
                            {{ $detalles[$i - 1]->precio_venta_sin_factura }}
                        </span>
                    </div>
                </li>

                <li class="mb-3">
                    <div class="flex justify-between border-b border-gray-300">
                        <span class="font-semibold">Marca: </span>
                        <span id="p_marca{{$i}}" class="pr-4">{{ $detalles[$i - 1]->marca }} </span>
                    </div>
                </li>
                <li class="mb-3">
                    <div class="flex justify-between border-b border-gray-300">
                        <span class="font-semibold">Procedencia: </span>
                        <span id="p_procedencia{{$i}}" class="pr-4">{{ $detalles[$i - 1]->procedencia }} </span>
                    </div>
                </li>
                <li class="mb-3">
                    <div class="flex justify-between border-b border-gray-300">
                        <span class="font-semibold">Origen: </span>
                        <span id="p_origen{{$i}}" class="pr-4">{{ $detalles[$i - 1]->origen }} </span>
                    </div>
                </li>

                <li class="mb-3">
                    <div class="flex justify-between border-b border-gray-300">
                        <span class="font-semibold">Cant Minima: </span>
                        <span id="p_stock_min{{$i}}" class="pr-4"> {{ $detalles[$i - 1]->cant_minima }}</span>
                    </div>
                </li>
                

                <li class="mb-3">
                    <div class="flex justify-between border-b border-gray-300">
                        <span class="font-semibold">Proveedor: </span>
                        <span id="p_proveedor{{$i}}" class="pr-4">{{ $detalles[$i - 1]->id_proveedor}} </span>
                    </div>
                </li>

            </ul>


        </div>
    </div>

</dialog>
