@extends('navegador')
@section('Contenido')
    <div class="lg:bg-blue-500 md:bg-red-300 xl:bg-yellow-400 2xl:bg-purple-600 sm:bg-black bg-gray-400">
        <label>
            celu = plomo,
            sm 640px = black ,
            md 768px = rojo ,
            lg 1024px = azul ,
            xl 1280px = amariilo ,
            2xl 1536px = purpura ,
        </label>
    </div>
    <form class="p-6 flex flex-col justify-center" action="{{Route('Empleado.store')}}" method="POST">
        @csrf
        @method('POST')

    <div class="flex flex-col items-center ">
        <h1 class="text-center font-bold text-2xl"> REGISTRO DE EMPLEADO</h1>
        <div class="w-10/12 sm:w-8/12 lg:w-3/4 xl:w-4/6 grid grid-cols-1 lg:grid-cols-2 gap-y-6 lg:gap-x-8 ">

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Cedula Identidad</label>
                    <p></p>
                </div>
                <input type="text"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 ">
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Nombre Completo</label>
                    <p></p>
                </div>
                <input type="text"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 ">
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Cedula Identidad</label>
                    <p></p>
                </div>
                <input type="text"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 ">
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Numero Telefonico</label>
                    <p></p>
                </div>
                <input type="text"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 ">
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Nombre Usuario</label>
                    <p></p>
                </div>
                <input type="text"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 ">
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Correo Electronico</label>
                    <p></p>
                </div>
                <input type="text"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 ">
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Introduce una Contraseña</label>
                    <p></p>
                </div>
                <input type="text"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 ">
            </div>

            <div class=" ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Confirmen Contraseña</label>
                    <p></p>
                </div>
                <input type="text"
                    class="bg-white border-2 border-gray-300 focus:border-blue-400 outline-none
                w-full px-2 py-2 ">
            </div>

            <div class="row-span-2 ">
                <div class="flex justify-between pb-1">
                    <label for="" class="font-semibold"> Roles</label>
                    <p></p>
                </div>

                @foreach ($roles as $id => $role)
                    @if ($role != 'dev')
                        <input type="checkbox" name="roles[]" value="">
                        <label for="" class="uppercase"> {{ $role }}</label><br>
                    @endif
                @endforeach

            </div>

            <div class=" bg-red-300 lg:py-5 px-5 flex flex-row-reverse justify-between">
                <button type="submit" class="bg-black text-white rounded-lg py-2 w-full "> Registrar</button>

            </div>

        </div>


    </div>
</form>
@endsection
