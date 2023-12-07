@extends('navegador')

@section('Contenido')

<div class="mt-4 mx-4">
    <div class="font-Carter  mb-4 text-gray-900 dark:text-gray-200 text-center sm:m-4 m-3 pt-1 text-2xl  sm:text-3xl lg:text-4xl uppercase">
        <p >Lista de Empleados</p>
    </div>
{{--
<div class="relative overflow-x-auto shadow-md border sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Telefono
                </th>
                <th scope="col" class="px-6 py-3">
                    Categor
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Actiones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $p)
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $p->nombre }}
                </th>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $p->telefono }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    Apple MacBook Pro 17"
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    Apple MacBook Pro 17"
                </td>
                <td class="px-6 py-4">
                    <a href="{{ Route('Empleado.edit', $p->ci) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <button type="button"
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                            <form action="{{ Route('Empleado.destroy', $p->ci) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Deshabilitar" class=""
                                                    onclick="return confirm('Desea Deshabilitar a este Trabajador?')">
                                            </form>
                                        </button>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div> --}}

    {{-- taileind 3 --}}

    <section class="flex flex-col justify-center items-center space-y-8">
        <button class="bg-blue-600 hover:bg-blue-400 px-2 py-1 transition-colors rounded text-white shadow-xl shadow-blue-300">
            Botono con sombra
        </button>


        <div class="flex gap-4 w-full snap-x overflow-x-auto">
            <div class="snap-center shrink-0 w-2/5 rounded overflow-hidden shadow-lg">
                <img class="aspect-video object-cover" src="https://images.pexels.com/photos/1619317/pexels-photo-1619317.jpeg" alt="">
            </div>
            <div class="snap-center shrink-0 w-2/5 rounded overflow-hidden shadow-lg">
                <img class="aspect-video object-cover" src="https://images.pexels.com/photos/1619317/pexels-photo-1619317.jpeg" alt="">
            </div>
            <div class="snap-center shrink-0 w-2/5 rounded overflow-hidden shadow-lg">
                <img class="aspect-video object-cover" src="https://images.pexels.com/photos/1619317/pexels-photo-1619317.jpeg" alt="">
            </div>
        </div>




    </section>


</div>

@endsection
