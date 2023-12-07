@extends('navegador')

@section('Contenido')

<div class="m-10 ">

    <div class="py-14">
        <form action="{{ route('CargarATugerente') }} " method="post">
            @csrf
            {{-- <label for="xd" class="label-xd"> cantidad</label>
            <input type="text" class="border-2  border-black" name="contador" id="xd"> --}}
            <button type="submit" class="btn-green">
                Cargar los productos no homologados a tuGerente
            </button>
        </form>
    </div>

        <div class="flex px-7 space-x-4 mb-4">
            <form action="{{ route('cargarIdproducto') }} " method="post">
                @csrf
                <button type="submit" class="btn-blue">
                    cargar las id_productos de tuGerente
                </button>
            </form>

            <div class=" ">
                @if (session('Mensaje'))
                <p class="text-white w-fit p-1  bg-lime-500 text-sm text-center rounded-xl ">
                 {{ session('Mensaje') }}
                 {{-- REgistro exitoso --}}
             </p>
                 @endif
            </div>
        </div>
        <form action="{{ route('RestaurarProductoGerente') }} " method="post">
            @csrf

            <label for="inicio">inicio</label>
            <input class="border-2 p-1  resize-sm mr-5" type="text" name="inicio">

            <label for="fin">fin</label>
            <input class="border-2 p-1  resize-sm mr-5" type="text" name="fin">

            <button type="submit" class="btn-blue">
                cargar los primeros 100 productos
            </button>
        </form>

        <div class=" mt-20 ">



            <h1> Restauar todos los productos en un click, sirve si todo los productos ya cuentan con id en tu geretne</h1>

            <form action="{{ route('RestaurarProducto') }}" method="post">
                @csrf
                <button class="btn-blue mt-5">Restaurar los productos </button>
            </form>
        </div>

        <div class=" mt-20 ">
            <h1> Poner id_producto de tu gerente a la base de datos</h1>

            <form action="{{ route('actualizarIdProducto') }}" method="post">
                @csrf
                <button class="btn-blue mt-5">Actualizar id Producto </button>
            </form>
        </div>


</div>


@endsection
