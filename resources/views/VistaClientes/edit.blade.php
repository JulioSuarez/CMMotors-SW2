
@extends('navegador')
@section('Contenido')
<link rel="stylesheet" href="{{ asset('css/desabilitarInputNumber.css') }}" />

    <form id="form_cliente" action="{{Route('Cliente.update',$cliente->ci)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col items-center ">
            <h1 class="text-center font-bold text-2xl my-3 sm:my-6"> EDITAR DE CLIENTE</h1>
            <div class="w-10/12 sm:w-8/12 lg:w-3/4 xl:w-4/6
                grid grid-cols-1 lg:grid-cols-2 gap-y-3 lg:gap-x-8">


                <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> CI/NIT  </label>
                        <p class=" pl-1 text-orange-600">*</p>
                    </div>
                    <input type="number" name="ci" id="ci_input" autocomplete="off" value="{{$cliente->ci}}"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 ">
                    <p id="ci_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>

                <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Nombre Completo  </label>
                        <p class=" pl-1 text-orange-600">*</p>
                    </div>
                    <input type="text" name="nombre" id="nombre_input" autocomplete="off" value="{{$cliente->nombre}}"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 capitalize">
                    <p id="nombre_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>

         
                {{-- <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Empresa </label>
                    </div>
                    <input type="text" name="empresa" id="empresa_input" autocomplete="off" value="{{$cliente->empresa}}"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 capitalize">
                    <p id="empresa_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div> --}}

                {{-- <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> NIT</label>
                    </div>
                    <input type="text" name="nit" id="nit_input" autocomplete="off"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 capitalize">
                    <p id="nit_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div> --}}

                <div class="lg:col-span-2 ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Direccion</label>
                    </div>
                    <input type="text" name="direccion" id="direccion_input" autocomplete="off" value="{{$cliente->direccion}}"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 uppercase">
                    <p id="direccion_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>

                <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Correo</label>
                    </div>
                    <input type="text" name="correo" id="correo_input" autocomplete="off" value="{{$cliente->correo}}"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 lowercase">
                    <p id="correo_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>

                <div class=" ">
                    <div class="flex pb-1">
                        <label class="font-semibold"> Telefono</label>
                    </div>
                    <input type="text" name="telefono" id="telefono_input" autocomplete="off" value="{{$cliente->telefono}}"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700
                    border-2 border-gray-300 focus:border-blue-700 capitalize">
                    <p id="telefono_pp" class="text-xs pt-0.5 text-red-500 font-semibold dark:font-normal"> </p>
                </div>


                <div class="flex justify-between mt-4 lg:col-span-2">
                       <a href="" 
                       class="md:w-32 bg-red-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg  hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">
                        Cancelar 
                       </a>
                     <button type="submit" class="md:w-32 bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg  hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">
                     Registrar
                    </button>
                </div>

            </div>
            <div id="error_validacion" class="flex mt-8">
                
            </div>
        </div>

    </form>
    <input type="hidden" id="ventana" value="ventana_edit" >
    <input type="hidden" id="valor_antes" value="{{ $cliente->ci }}" >
    <input type="hidden" id="pantalla" value="cliente">
    <script src="{{asset('js/Proveedor/ClienteExiste.js') }}"></script>
  
@endsection

