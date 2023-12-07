@extends('navegador')

@section('Contenido')
    <p
        class="font-extrabold  text-gray-900 dark:text-gray-200 text-center sm:m-4 m-3 pt-1 text-2xl  sm:text-3xl lg:text-4xl ">
        Consutlas Ventas xd xd
    </p>

    <a class=" hidden lg:block px-2 py-1 mb-1 mx-2 h-fit w-fit text-center font-medium tracking-wide text-white bg-blue-500 rounded-md
text-sm sm:text-lg hover:bg-blue-600 focus:bg-blue-600 focus:outline-none whitespace-nowrap"
        id="axd2" href="{{ Route('Venta.create') }}">
        Nueva venta
    </a>

    <div class=" my-3 mx-5 overflow-hidden rounded-lg ">
        <!-- reemplace w-full por mx-8 -->
        @livewire('buscador-venta-wire')
    </div>
@endsection
