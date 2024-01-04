@extends('navegador')

@section('Contenido')
    <link rel="stylesheet" href="{{ asset('css/desabilitarInputNumber.css') }}" />

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

    <!--container max-w-lg-->
    {{--
    <div class="lg:bg-blue-500 md:bg-red-300 xl:bg-yellow-400 2xl:bg-purple-600 sm:bg-black bg-gray-400">
    <label>
        celu = plomo,
        sm 640px = black ,
        md 768px = rojo ,
        lg 1024px = azul ,
        xl 1280px = amariilo ,
        2xl 1536px = purpura ,
    </label>
    </div> --}}




    @error('errorG')
        <div id="myDiv" class="animate-bounce  fixed z-50  top-12 right-3 py-2 px-3 w-fit rounded-lg bg-red-500">
            {{-- <p> {{ $message }}</p> --}}
            {{-- @dd($errors) --}}
            @foreach ($errors->get('errorG') as $field => $errors)
                @foreach ($errors as $error)
                    <p>
                        "Error en el campo '{{ $field }}': {{ $error }}";
                    </p>
                @endforeach
            @endforeach

        </div>

        <script>
            //    console.log('hola xd xd');
            setTimeout(function() {
                document.getElementById('myDiv').style.display = 'none';
            }, 3000);
        </script>
    @enderror

    @error('eroorConexion')
        <div id="myDiv2" class="animate-bounce  fixed z-50  top-12 right-3 py-2 px-3 w-fit rounded-lg bg-red-500">
            <p> {{ $message }}</p>
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('myDiv2').style.display = 'none';
            }, 3000);
        </script>
    @enderror



    <form action="{{ Route('Producto.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="py-4 px-4 max-w-full m-3  sm:m-5 bg-white rounded-xl
                    lg:px-10  2xl:mx-20">

            <p
                class="mb-3 text-gray-900 text-center font-bold tracking-normal leading-tight lg:mb-5  lg:text-xl ">
                REGISTRAR UN PRODUCTO
            </p>

            <!-- GRID COLUMNAS-->
            <div
                class="grid grid-cols-1 grid-row-12 sm:grid-cols-2
                xl:grid-cols-4
                gap-y-2 sm:gap-x-10 2xl:gap-x-16     sm:px-2 lg:px-5 ">


                <div class="flex flex-col  ">
                    <div class="flex ">
                        <label for="ci_autocomplete"
                            class="text-gray-800 text-sm font-semibold mb-1 leading-snug tracking-tighter sm:tracking-normal">
                            *Codigo Producto:
                        </label>
                        @error('cod_producto')
                            <p class="text-red-500 text-xs sm:text-sm px-1 sm:px-2 sm:pr-3 font-semibold rounded-xl  w-max">
                                <small>*{{ $message }}</small>
                            </p>
                        @enderror
                        <p id="p_prud_alterno_existe"> </p>
                    </div>
                    <input
                        class="text-gray-500  font-normal w-full    h-8  pl-3 text-sm border
                      border-gray-300 rounded
                        focus:outline-none focus:border focus:border-blue-900 uppercase"
                        id="cod_producto" name="cod_producto" type="text" autocomplete="off"
                        value="{{ old('cod_producto') }}" oninput="noEspacios()" />
                </div>

                <div class="flex flex-col ">
                    <div class="flex  ">
                        <label for="ci_autocomplete"
                            class="text-gray-800 text-sm  font-semibold mb-1 sm:pl-0 leading-tight tracking-normal">
                            *Codigo OEM:
                        </label>
                        @error('cod_oem')
                            <p
                                class="text-red-500 text-xs sm:text-sm px-1 sm:px-2 mr-2  sm:pr-3 font-semibold rounded-xl  w-max">
                                <small>*{{ $message }}</small>
                            </p>
                        @enderror
                        <p id="p_pruducto_existe"> </p>
                    </div>

                    <input
                        class="text-gray-500 font-normal w-full  h-8 pl-3 text-sm
                        border border-gray-300 rounded
                        focus:outline-none focus:border focus:border-blue-900 uppercase "
                        id="cod_oem" name="cod_oem" type="text" autofocus="true" autocomplete="off"
                        value="{{ old('cod_oem') }}" oninput="noEspacios()" />

                    {{-- <input type="text" name="nombre" id="nombre" oninput="noEspacios()" required> --}}

                </div>
                <script>
                    function noEspacios() {
                        var input = document.getElementById("cod_oem");
                        input.value = input.value.replace(/\s/g, "");
                        var input = document.getElementById("cod_producto");
                        input.value = input.value.replace(/\s/g, "");
                    }
                </script>



                <div class="flex flex-col sm:col-span-2">
                    <div class="flex  ">
                        <label for="cliente"
                            class="text-gray-800 text-sm font-semibold mb-1  leading-tight tracking-normal">
                            *Nombre de Articulo:
                        </label>
                        @error('nombre')
                            <p class="text-red-500 text-xs sm:text-sm px-1 sm:px-2  sm:pr-3 font-semibold rounded-xl  w-max">
                                <small>*{{ $message }}</small>
                            </p>
                        @enderror
                    </div>
                    <input
                        class="mt-0 mb-1 text-gray-500 font-normal   h-8 pl-3 text-sm
                        border-gray-300 rounded border
                        focus:outline-none focus:border focus:border-blue-900 uppercase"
                        id="nombre_prod" name="nombre" type="text" autocomplete="off" value="{{ old('nombre') }}" />
                </div>



                <div class="flex flex-col">
                    <label for="marca" class="text-gray-800 text-sm font-semibold  mb-1">
                        Marca:
                    </label>
                    <input id="marca"
                        class=" pl-3 text-gray-500 font-normal h-8 w-full text-sm border-gray-300 rounded border
                        focus:outline-none focus:border focus:border-blue-900 uppercase"
                        name="marca" type="text" value="{{ old('marca') }}" />
                </div>

                <div class="flex flex-col">
                    <label for="procedencia" class="text-gray-800 text-sm font-semibold mb-1 ">
                        Procedencia:
                    </label>
                    <input id="procedencia"
                        class="pl-3 text-gray-500 font-normal w-full h-8 text-sm border-gray-300 rounded border
                    focus:outline-none focus:border focus:border-blue-900 uppercase"
                        name="procedencia" type="text" value="{{ old('procedencia') }}" />
                </div>
                <div class="flex flex-col">
                    <label for="origen" class="text-gray-800 text-sm mb-1 font-semibold  ">
                        Origen:
                    </label>
                    <input id="origen"
                        class="pl-3 text-gray-500 font-normal w-full h-8 text-sm border-gray-300 rounded border
                            focus:outline-none focus:border focus:border-blue-900 uppercase"
                        name="origen" type="text" value="{{ old('origen') }}" />
                </div>

                <div class="flex flex-col lg:mt-1 ">
                    @include('VistaProductos.Modal_crear_proveedo')

                    <div class="flex justify-between mb-1">
                        <label for="proveedor" class="text-gray-800 text-sm font-semibold   leading-tight tracking-normal">
                            Proveedor:
                        </label>
                        {{-- <button id="bt_crear_proveedorM" type="button"
                            class="text-black text-xs hover:bg-blue-200 hover:border-black border rounded px-1 ">
                            Crear Proveedor </button> --}}
                    </div>
                    <select name="proveedor" id="select_proveedor"
                        class="w-full mb-2  p-1 rounded-lg text-sm bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                        @foreach ($proveedores as $pro)
                            <option value="{{ $pro->id }}">{{ $pro->nombre_proveedor }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="flex flex-col ">
                    <label for="fecha_expiracion"
                        class="text-gray-800 text-sm font-semibold mb-1 leading-tight tracking-normal">
                        Fecha de expiracion:
                    </label>
                    <input id="fecha_expiracion"
                        class=" text-gray-500 font-normal w-full h-8  text-sm border-gray-300 rounded border
                            focus:outline-none focus:border focus:border-blue-900 uppercase"
                        name="fecha_expiracion" type="date" autocomplete="off" value="{{ old('fecha_expiracion') }}" />
                </div>

                <div class="flex flex-col ">
                    <div class="flex  ">
                        <label for="estante" class="text-gray-800 text-sm mb-1 font-semibold">
                            *Ubicacion:
                        </label>
                        @error('estante')
                            <p
                                class="text-red-500 text-xs sm:text-sm px-1 sm:px-2 mr-2  sm:pr-3 font-semibold rounded-xl  w-max">
                                <small>*{{ $message }}</small>
                            </p>
                        @enderror
                    </div>
                    <input id="estante"
                        class=" text-gray-500 font-normal  h-8 text-center  text-sm border-gray-300 rounded border
                            focus:outline-none focus:border focus:border-blue-900 uppercase"
                        name="estante" type="text" autocomplete="off" value="{{ old('estante') }}" />
                </div>





                <!-- row-start-4 -->
                <div class=" sm:row-span-1  h-20  row-start-4
                lg:h-auto xl:col-span-2 lg:row-span-1">

                    @error('precio')
                        <p class="text-red-500 text-xs sm:text-sm px-1 sm:px-2 mr-2  sm:pr-3 font-semibold rounded-xl  w-max">
                            <small>*Los campos de precios son {{ $message }}</small>
                        </p>
                    @else
                        <p class=" text-blue-400 text-xs text-right">*Los precios de factura se autocompletan </p>
                    @enderror

                    <div class="flex justify-around text-center items-end">
                        <div class="flex flex-col items-center ">
                            <label for="precio_pp"
                                class=" text-gray-800 text-sm font-semibold  leading-tight tracking-normal mb-1">
                                *Precio de Compra:
                            </label>
                            <input
                                class="text-gray-500  font-normal lg:w-24 xl:w-28 2xl:32 w-16 h-7 flex items-center py-1 px-2 text-sm border border-gray-300 rounded
                                    focus:outline-none focus:border focus:border-blue-900 uppercase "
                                id="precio_pp" name="precio" type="number" step="0.01" autocomplete="off"
                                value="{{ old('precio') }}" />
                        </div>


                        <div class="flex flex-col items-center ">
                            <label for="precio_sin_factura"
                                class="text-gray-800 text-sm font-semibold leading-tight tracking-normal mb-1">
                                *Venta sin Factura:
                            </label>
                            <input
                                class="text-gray-500  font-normal w-16 lg:w-24  xl:w-28 2xl:32 h-7 flex items-center py-1 px-2 text-sm border border-gray-300 rounded
                                    focus:outline-none focus:border focus:border-blue-900 uppercase "
                                id="precio_sin_factura_pp" name="precio_sin_factura" type="number" step="0.01"
                                value="0" autocomplete="off" value="{{ old('precio_sin_factura_pp') }}" />
                        </div>

                        <div class="flex flex-col items-center">
                            <label for="precio_factura"
                                class="text-gray-800 text-sm font-semibold leading-tight tracking-normal mb-1">
                                *Venta con Factura:
                            </label>
                            <input
                                class="text-gray-500  font-normal lg:w-24 xl:w-28 2xl:32 w-16 h-7 flex items-center py-1 px-2 text-sm border border-gray-300 rounded
                                    focus:outline-none focus:border focus:border-blue-900 uppercase "
                                id="precio_factura_pp" name="precio_factura" type="number" step="0.01"
                                value="0" autocomplete="off" value="{{ old('precio_factura_pp') }}" />
                        </div>



                    </div>
                </div>


                <div class="xl:col-span-2 xl:col-start-1    xl:row-start-6 ">
                    <label for="unidad" class=" text-gray-800 text-sm font-semibold   leading-tight tracking-normal">
                        Tipo de Unidd:
                    </label>
                    <div class="flex justify-around items-center ">
                        <div class=" ">
                            <input type="radio" id="piezas" name="unidad" class="" checked value="PZA">
                            <label class="text-gray-700 text-sm " for="piezas">PZA</label>
                        </div>
                        <div>
                            <input type="radio" id="kit" name="unidad" value="KIT">
                            <label class="text-gray-700 text-sm" for="kit">KIT</label>
                        </div>
                        <div>
                            <input type="radio" id="mts" name="unidad" value="Mts">
                            <label class="text-gray-700 text-sm" for="mts">Mts</label>
                        </div>
                        <div>
                            <input type="radio" id="lts" name="unidad" value="Lts">
                            <label class="text-gray-700 text-sm" for="lts">Lts</label>
                        </div>
                        <div>
                            <input type="radio" id="kg" name="unidad" value="Kg">
                            <label class="text-gray-700 text-sm" for="kg">Kg</label>
                        </div>
                    </div>
                </div>

                <!-- row-start-4 -->

                <div
                    class="flex justify-around row-start-5 sm:row-start-auto
                        xl:col-span-2 xl:col-start-3 xl:row-start-7
                            ">
                    <div class="flex flex-col ">
                        <div class="flex">
                            <label for="cantidad"
                                class="text-gray-800 text-sm font-semibold mb-1 leading-tight tracking-normal">
                                *Stock:
                            </label>
                            @error('cantidad')
                                <p
                                    class="text-red-500 text-xs sm:text-sm px-1 sm:px-2 mr-2  sm:pr-3 font-semibold rounded-xl  w-max">
                                    <small>*{{ $message }}</small>
                                </p>
                            @enderror

                        </div>

                        <input
                            class="text-gray-500  font-normal w-24 xl:w-36  h-8 p-1 text-center text-sm border border-gray-300 rounded
                                focus:outline-none focus:border focus:border-blue-900 uppercase"
                            id="cantidad" name="cantidad" type="number" autocomplete="off" min="0"
                            placeholder="0" value="{{ old('cantidad') }}" />
                    </div>
                    <div class="flex flex-col">
                        <label for="cant_minima"
                            class="text-gray-800 text-sm font-semibold mb-1  leading-tight tracking-normal">
                            Stock Minimo:
                        </label>
                        <input
                            class="text-gray-500  font-normal w-24 xl:w-36   h-8 p-1 text-center text-sm border border-gray-300 rounded
                            focus:outline-none focus:border focus:border-blue-900 uppercase"
                            id="cant_minima" name="cant_minima" type="number" autocomplete="off" min="0"
                            value="1" value="{{ old('cant_minima') }}" />
                    </div>
                </div>

                <div class="sm:col-span-2 ">
                    <label for="tienda" class="text-gray-800 text-sm  font-semibold ">
                        Tienda:
                    </label>
                    <div class="flex sm:flex justify-around  2xl:pl-1 items-center ">
                        <div class=" ">
                            <input type="radio" id="repuesto" name="tienda" class="" checked
                                value="Repuestos">
                            <label class="text-gray-700 text-xs sm:text-base " for="repuesto">
                                Repuestos</label>
                        </div>
                        <div>
                            <input type="radio" id="ferreteria" name="tienda" value="Ferreteria">
                            <label class="text-gray-700 text-xs sm:text-base" for="ferreteria">
                                Ferreteria</label>
                        </div>
                        <div>
                            <input type="radio" id="deposito" name="tienda" value="Deposito Taller">
                            <label class="text-gray-700 text-xs sm:text-base" for="deposito">
                                Deposito Taller</label>
                        </div>
                        <div>
                            <input type="radio" id="deposito" name="tienda" value="Deposito Ferreteria">
                            <label class="text-gray-700 text-xs sm:text-base" for="deposito">
                                Deposito Ferreteria</label>
                        </div>
                    </div>
                </div>


                <div class="xl:col-span-2  ">
                    <label for="" class="text-gray-800 text-sm font-semibold   leading-tight tracking-normal">
                        Estado del Articulo:
                    </label>
                    <div class="flex justify-around 2xl:w-2/4  items-center ">
                        <div class=" ">
                            <input type="radio" id="est_habilitado" name="estado" class="" checked
                                value="HABILITADO">
                            <label class="text-gray-700 text-sm " for="est_habilitado">HABILITADO</label>
                        </div>
                        <div>
                            <input type="radio" id="est_desabilitado" name="estado" value="DESHABILITADO">
                            <label class="text-gray-700 text-sm" for="est_desabilitado">DESHABILITADO</label>
                        </div>
                    </div>
                </div>





                <!-- sm:row-start-3 sm:col-start-2 sm:row-span-4 -->
                <div
                    class=" sm:row-start-3 sm:col-start-2 sm:row-span-5
                xl:col-span-2 xl:row-start-1 xl:col-start-3 xl:p-4">
                    <div class=" flex justify-between  ">
                        <!-- flex justify-between mt-4 lg:w-1/2-->
                        <button
                            class="text-xs  xl:text-xl font-medium text-gray-600 dark:text-gray-400
                        border-2 border-lg border-gray-400 rounded-lg px-2 w-fit"
                            type="button" id="button_subir_foto">
                            Subir Foto
                        </button>
                        <input id="file_foto_ventas" name="foto" type="file" class="sr-only">

                        <a id="bt_buscar_google"
                            class="flex items-center text-xs  xl:text-xl font-medium text-gray-400
                        border-2 border-lg border-gray-400 rounded-lg px-2 "
                            target="_blank" href="https://images.google.com/">
                            Buscar en
                            <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" class=" pl-1   ">
                                <path fill="#EA4335 "
                                    d="M5.26620003,9.76452941 C6.19878754,6.93863203 8.85444915,4.90909091 12,4.90909091 C13.6909091,4.90909091 15.2181818,5.50909091 16.4181818,6.49090909 L19.9090909,3 C17.7818182,1.14545455 15.0545455,0 12,0 C7.27006974,0 3.1977497,2.69829785 1.23999023,6.65002441 L5.26620003,9.76452941 Z" />
                                <path fill="#34A853"
                                    d="M16.0407269,18.0125889 C14.9509167,18.7163016 13.5660892,19.0909091 12,19.0909091 C8.86648613,19.0909091 6.21911939,17.076871 5.27698177,14.2678769 L1.23746264,17.3349879 C3.19279051,21.2936293 7.26500293,24 12,24 C14.9328362,24 17.7353462,22.9573905 19.834192,20.9995801 L16.0407269,18.0125889 Z" />
                                <path fill="#4A90E2"
                                    d="M19.834192,20.9995801 C22.0291676,18.9520994 23.4545455,15.903663 23.4545455,12 C23.4545455,11.2909091 23.3454545,10.5272727 23.1818182,9.81818182 L12,9.81818182 L12,14.4545455 L18.4363636,14.4545455 C18.1187732,16.013626 17.2662994,17.2212117 16.0407269,18.0125889 L19.834192,20.9995801 Z" />
                                <path fill="#FBBC05"
                                    d="M5.27698177,14.2678769 C5.03832634,13.556323 4.90909091,12.7937589 4.90909091,12 C4.90909091,11.2182781 5.03443647,10.4668121 5.26620003,9.76452941 L1.23999023,6.65002441 C0.43658717,8.26043162 0,10.0753848 0,12 C0,13.9195484 0.444780743,15.7301709 1.23746264,17.3349879 L5.27698177,14.2678769 Z" />
                            </svg>
                            <p class=" sr-only lg:not-sr-only sm:pl-1 xl:pl-1 text-gray-700"> Google</p>
                        </a>

                    </div>
                    <div class="mt-4 flex flex-col items-center ">
                        <img id="img_fotoventas" src="{{ asset('img/fotosProductos/' . old('foto', 'default.png')) }}"
                            alt="no se cargo" height=""
                            class=" h-44 sm:h-64 xl:h-64 object-cover rounded-xl border-2 border-spacing-2 border-black">
                    </div>

                </div>

{{-- falta terminar --}}
                <div class=" xl:col-span-2 flex flex-row-reverse justify-between  py-1 ">
                    <button id="loading-button" type="submit"
                        class=" bg-blue-500 py-1 px-3 text-lg text-gray-100  rounded-xl">
                        Guardar
                    </button>
                    <div id="loading-spinner" class="hidden">
                        <!-- Aquí puedes agregar una animación de carga, por ejemplo, un spinner -->
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Cargando...</span>
                        </div>
                    </div>
                </div>






            </div> <!-- end del div de columnas -->

        </div> <!-- end de div principal-->

    </form>


    {{-- loading-button --}}
    <script>
        function startLoading() {
            var button = document.getElementById("loading-button");
            var spinner = document.getElementById("loading-spinner");

            // Deshabilitar el botón
            button.disabled = true;

            // Ocultar el botón y mostrar la animación de carga
            button.style.display = "none";
            spinner.style.display = "block";

            // Simula una operación de carga (puedes reemplazar esto con tu lógica real)
            setTimeout(function() {
                // Habilitar el botón y ocultar la animación de carga después de 3 segundos (simulación)
                button.disabled = false;
                button.style.display = "block";
                spinner.style.display = "none";
            }, 3000); // Cambia 3000 a la duración de tu operación de carga real en milisegundos
        }
    </script>

    <script src="{{ asset('js/Proveedor/cargar_imagen.js') }}"></script>
    <script src="{{ asset('js/Proveedor/ProductoExiste.js') }}"></script>
    <input type="hidden" id="pantalla" value="producto">
@endsection
