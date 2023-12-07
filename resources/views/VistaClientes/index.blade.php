@extends('navegador')


@section('Contenido')
    <div class="mt-4 mx-4 pb-4">
        <div>
            <p
                class="uppercase font-extrabold  text-gray-900 dark:text-gray-200 text-center sm:m-4 m-3 pt-1 text-2xl  sm:text-3xl lg:text-4xl">
                Lista de Clientes
            </p>
        </div>

        <div class="mt-4 mx-4  ">
            @livewire('buscador-cliente-wire') 
        </div>
    </div> 

    <input type="hidden" id="pantalla" value="cliente">
@endsection
