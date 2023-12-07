
@extends('navegador')
@section('Contenido')
 
    {{-- <h2 class="bg-red-400 sm:bg-green-600 md:bg-purple-700 lg:bg-blue-600 xl:bg-yellow-500 2xl:bg-white
    text-3xl font-extrabold text-gray-200 text-center m-2
    md:text-4xl">
        sm = 640px = verde;
        md = 768px = violeta;
        lg = 1024px = azul;
        xl = 1280px = amariilo;
        2xl = 1536px = blanco;
    </h2> --}}


<link rel="stylesheet" href="{{ asset('css/desabilitarInputNumber.css') }}" />

    <form id="form_cliente" action="{{Route('Cliente.store')}}" method="POST">
        @csrf
        @method('POST')
        <div class="flex flex-col items-center ">
            <h1 class="text-center font-bold text-2xl my-3 sm:my-6"> REGISTRO DE CLIENTES</h1>
            <div class="w-10/12 sm:w-8/12 lg:w-3/4 xl:w-4/6
                grid grid-cols-1 lg:grid-cols-2 gap-y-3 lg:gap-x-8">

                <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> CI/NIT  </label>
                        <p class=" pl-1 text-orange-600">*</p>
                    </div>
                    <input type="number" name="ci" id="ci_input" autocomplete="off"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 ">
                    <p id="ci_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                    @error('ci')
                    <p class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal">
                        {{ $message }}    
                    </p>
                    @enderror
                </div>

                <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Nombre Completo  </label>
                        <p class=" pl-1 text-orange-600">*</p>
                    </div>
                    <input type="text" name="nombre" id="nombre_input" autocomplete="off"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 uppercase">
                    <p id="nombre_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                    @error('nombre')
                    <p class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal">
                        {{ $message }}    
                    </p>
                    @enderror
                </div>

                <div class="lg:col-span-2 ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Direccion</label>
                    </div>
                    <input type="text" name="direccion" id="direccion_input" autocomplete="off"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 uppercase">
                    <p id="direccion_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>

                <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Correo</label>
                    </div>
                    <input type="text" name="correo" id="correo_input" autocomplete="off"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 lowercase">
                    <p id="correo_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>

                <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Telefono</label>
                    </div>
                    <input type="text" name="telefono" id="telefono_input" autocomplete="off"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 ">
                    <p id="telefono_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>


                <div class="flex items-center text-sm mt-4 font-medium text-gray-700">
                    *nota: Los campos con asterisco son obligatorios
                </div>
                <div class="flex-1 text-right"> 
                     <button type="submit" 
                     class="md:w-32 mt-4 bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg  hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">
                     Registrar
                    </button>

                </div>
            </div>

            <div id="error_validacion" class="flex">
              
            </div>
        </div>

    </form>

    <input type="hidden" id="ventana" value="ventana_create" >
    <input type="hidden" id="valor_antes" value="0" >
    <input type="hidden" id="pantalla" value="cliente">            
    <script src="{{asset('../js/Proveedor/ClienteExiste.js/') }}"></script>

    
@endsection
