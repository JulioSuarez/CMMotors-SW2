@extends('navegador')

@section('Contenido')

<div class="relative w-full max-w-full flex-grow flex-1 text-left pt-6 px-8 ">
    <a href="{{ Route('Ubicacion.create') }}"
        class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
        Crear un Ubicacion
    </a>

    <a href="{{ Route('Ubicacion.create') }}"
        class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
        Crear un estante
    </a>

    <a href="{{ Route('Ubicacion.create') }}"
        class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
        Crear un sector
    </a>

</div>




<div class="px-6 pt-6 2xl:container">

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">


        <div class="md:col-span-2 lg:col-span-1" >
            <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    <h5 class="text-xl text-gray-900 text-center font-bold">UBICACIONES</h5>
                    <table class="mt-6 -mb-2 w-full text-gray-600">
                        <header>
                            <tr>
                                <td class="py-2 font-bold">Ubicacion</td>
                                <td class="py-2 font-bold">Estante</td>
                                <td class="py-2 font-bold">Almacen</td>
                                <td class="py-2 font-bold">Acciones</td>
                            </tr>
                        </header>
                        <tbody>
                            @foreach ($ubicaciones as $ubi)
                            <tr>
                                <td class="py-2">{{$ubi->codigo_ubi}}</td>
                                <td class="py-2">{{$ubi->codigo_estantes}} - {{$ubi->nombre_estante}}</td>
                                <td class="py-2">{{$ubi->id_sector}} - {{$ubi->nombre_sector}}</td>
                                <td class="py-2">
                                    <a href="{{Route('Ubicacion.edit',$ubi->id)}}">Editar</a>
                                    <form action="{{Route('Ubicacion.destroy',$ubi->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Desea Eliminar?')"
                                                type="submit"> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>


        <div class="md:col-span-2 lg:col-span-1" >
            <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    <h5 class="text-xl text-gray-900 text-center font-bold">ESTANTES</h5>
                    <table class="mt-6 -mb-2 w-full text-gray-600">
                        <header>
                            <tr>
                                <td class="py-2 font-bold">Codigo</td>
                                <td class="py-2 font-bold">Estantes</td>
                                <td class="py-2 font-bold">Descripcion</td>
                                <td class="py-2 font-bold">Nro. Col. Nro. Filas</td>
                                <td class="py-2 font-bold">Sector</td>
                                <td class="py-2 font-bold">Acciones</td>
                            </tr>
                        </header>
                        <tbody>
                            @foreach ($estantes as $est)
                            <tr>
                                <td class="py-2">{{$est->id}}</td>
                                <td class="py-2">{{$est->nombre}}</td>
                                <td class="py-2">{{$est->descripcion}}</td>
                                <td class="py-2">{{$est->nro_columnas}} - {{$est->nro_filas}}</td>
                                <td class="py-2">{{$est->id_sector}}</td>
                                <td class="py-2">
                                    <a href="{{Route('Ubicacion.edit',$ubi->id)}}">Editar</a>
                                    <form action="{{Route('Ubicacion.destroy',$ubi->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Desea Eliminar?')"
                                                type="submit"> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>


        <div class="md:col-span-2 lg:col-span-1" >
            <div class="h-full py-8 px-6 space-y-6 rounded-xl border border-gray-200 bg-white">
                    <h5 class="text-xl text-gray-900 text-center font-bold">SECTORES</h5>
                    <table class="mt-6 -mb-2 w-full text-gray-600">
                        <header>
                            <tr>
                                <td class="py-2 font-bold">Codigo</td>
                                <td class="py-2 font-bold">Nombre</td>
                                <td class="py-2 font-bold">Descripcion</td>
                                <td class="py-2 font-bold">Acciones</td>
                            </tr>
                        </header>
                        <tbody>
                            @foreach ($sectores as $s)
                            <tr>
                                <td class="py-2">{{$s->id}}</td>
                                <td class="py-2">{{$s->nombre}}</td>
                                <td class="py-2">{{$s->descripcion}}</td>
                                <td>
                                    <a href="{{Route('Ubicacion.edit',$s->id)}}">Editar</a>
                                    <form action="{{Route('Ubicacion.destroy',$s->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Desea Eliminar?')"
                                                type="submit"> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>



    </div>
</div>

@endsection

