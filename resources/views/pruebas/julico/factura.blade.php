@extends('navegador')
@section('Contenido')
    <div class=" flex items-center justify-center ">
        <div class="bg-white">
            <div class="pt-6">
                <nav aria-label="Breadcrumb">
                    <ol role="list"
                        class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                        <li>
                            <img src="{{ asset('img/logo-cm.png') }}" alt="Imagen Superior" width="20%">
                            <p aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">hola
                        </li>

                        <li class="text-sm">
                            <p aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">hola
                            <p aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">hola
                            <p aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">hola
                            </p>
                        </li>
                    </ol>
                </nav>

                <!-- Product info -->
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">hola</h1>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-2xl tracking-tight text-gray-900">Bs.- hola | Estante
                    hola | Stock: hola</p>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pb-16 lg:pr-8">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre o Razon Social</th>
                                <th scope="col">CI/NIT</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Dirección</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $a = 0;
                            @endphp
                            @foreach ($clientes as $ubi)
                                <tr>
                                    <th scope="row">{{ $a = $a + 1 }}</th>
                                    <td>{{ $ubi->nombre }}</td>
                                    <td>{{ $ubi->ci }}</td>
                                    <td>{{ $ubi->telefono }}</td>
                                    <td>{{ $ubi->correo }}</td>
                                    <td>{{ $ubi->direccion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
