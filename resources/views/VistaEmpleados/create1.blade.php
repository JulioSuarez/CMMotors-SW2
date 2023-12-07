@extends('navegador')
@section('Contenido')
<link rel="stylesheet" href="{{ asset('css/desabilitarInputNumber.css') }}" />

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
    <form id="formularioxd" class=""
    action="{{Route('Empleado.store')}}" method="POST">
        @csrf
        @method('POST')

    <div class="flex flex-col items-center ">
        <h1 class="text-center font-bold text-2xl my-3 sm:my-6"> REGISTRO DE EMPLEADO</h1>
        <div class="w-10/12 sm:w-8/12 lg:w-3/4 xl:w-4/6 grid grid-cols-1 lg:grid-cols-2 gap-y-3 lg:gap-x-8 autocompl">

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="ci_emp" id="ci_label" class="font-semibold"> Cedula Identidad*</label>
                </div>
                <div id="ci_div" class="flex items-center border-2 border-gray-300 ">
                    <input type="number" name="ci" id="ci_emp" autocomplete="off"
                    class="outline-none w-full px-2 py-2 dark:bg-gray-700 ">
                    <div id="ci_svg">

                    </div>
                </div>


                <p id="p_ci_existe" class="text-xs pt-1"></p>
                <p id="p_ci" class="text-xs pt-1 text-red-600"></p>

            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for=""class="font-semibold"> Nombre Completo*</label>
                </div>
                <input type="text"  autocomplete="off" name="nombre"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 dark:bg-gray-700 capitalize">

                <p id="p_nombre_existe" class="text-xs pt-1"></p>
                <p id="p_nombre" class="text-xs pt-1 text-red-600"></p>

            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Numero Telefonico*</label>
                    <p></p>
                </div>
                <input type="number"  autocomplete="off" name="telefono"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2  dark:bg-gray-700 ">

                <p id="p_telefono_existe" class="text-xs pt-1"></p>
                <p id="p_telefono" class="text-xs pt-1 text-red-600"></p>
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="usuario" id="usuario_label" class="font-semibold pb-1"> Nombre Usuario*</label>
                </div>
                <div id="usuario_div" class="flex items-center border-2 border-gray-300">
                    <input type="text" name="usuario" id="usuario_inp" autocomplete="off"
                    class="bg-white outline-none  dark:bg-gray-700
                            w-full px-2 py-2 ">
                    <div id="usuario_svg">

                    </div>
                </div>
                <p id="p_usuario_existe" class="text-xs pt-1"></p>
                <p id="p_usuario" class="text-xs pt-1 text-red-600"></p>
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="correo" id="correo_label" class="font-semibold pb-1"> Correo Electronico*</label>
                </div>
                <div id="correo_div" class="flex items-center border-2 border-gray-300 focus:border-blue-400 px-1">
                    <input type="email" name="correo" id="correo_inp" autocomplete="off"
                    class="bg-white outline-none  dark:bg-gray-700
                            w-full px-2 py-2 ">
                    <div id="correo_svg">

                    </div>
                </div>
                <p id="p_correo_existe" class="text-xs pt-1"></p>
                <p id="p_correo" class="text-xs pt-1 text-red-600"></p>
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="pass_escrito" id="pass_escrito_label" class="font-semibold pb-1"> Introduce una Contraseña*</label>
                </div>
                <div id="pass_escrito_div" class="flex items-center border-2 border-gray-300 px-1">
                    <input type="password" name="pass_escrito" id="pass_escrito" autocomplete="off"
                    class="bg-white outline-none  dark:bg-gray-700
                            w-full px-2 py-2 ">
                    <div id="pass_escrito_svg">

                    </div>
                </div>
                <p id="p_pass_escrito_existe" class="text-xs pt-1"></p>
                <p id="p_pass_escrito" class="text-xs pt-1 text-red-600"></p>

            </div>

            <div class="lg:row-start-4 lg:col-start-2 ">
                <div class="flex justify-between pb-1">
                    <label for="password" id="password_label" class="font-semibold pb-1"> Confirmen Contraseña*</label>
                </div>
                <div id="password_div" class="flex items-center border-2 border-gray-300 px-1">
                    <input type="password" name="password" id="password" autocomplete="off"
                    class="bg-white outline-none  dark:bg-gray-700
                            w-full px-2 py-2 ">
                    <div id="password_svg">

                    </div>
                </div>
                <p id="p_password_existe" class="text-xs pt-1"></p>
                <p id="p_password" class="text-xs pt-1 text-red-600"></p>

            </div>

            <div class="row-span-2 ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Roles</label>
                </div>

                @foreach ($roles as $id => $role)
                    @if ($role != 'dev')
                        @if ($role == 'ventas')
                            <input type="radio" name="roles[]" id="{{$role}}" value="{{$id}}" checked>
                        @else
                            <input type="radio" name="roles[]" id="{{$role}}" value="{{$id}}">
                        @endif
                        <label for="{{$role}}" class="uppercase"> {{ $role }}</label><br>
                    @endif
                @endforeach

            </div>


            <div class="lg:py-5 px-5 flex flex-col  ">
                <div id="error_validacion" class="flex items-center pb-0.5">

                </div>
                <button id="bt_submit" type="submit" class="bg-black text-white rounded-lg py-2 w-full "> Registrar</button>

            </div>

        </div>

        <input type="hidden" id="ventana" name="ventana" value="ventana_create">

    </div>
</form>

<script src="{{ asset('js/Proveedor/EmpleadoExiste.js') }}"></script>
<input type="hidden" id="pantalla" value="empleado">
@endsection
