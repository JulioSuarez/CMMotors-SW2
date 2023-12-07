@extends('navegador')

@section('Contenido')
    <button id="buttonApi" type="button" class="bg-red-400 "> AGREGAR 400 PRODUTOS </button>
    <label for=""> cantidad </label>
    <input class="text-black" type="text" id="bandera" value="0">

    <form action="{{ Route('Producto.storexd') }}" method="post" enctype="multipart/form-data">
        @csrf

        <button type="submit">enviar</button>
        <table class="table-auto">
            <thead class=" border border-gray-300 ">
                <tr>
                    <th>id</th>
                    <th>cod_oem</th>
                    <th>cod_sustituto</th>
                    <th>nombre</th>
                    <th>marca</th>
                    <th>procedencia</th>
                    <th>origen</th>
                    <th>descripcion</th>
                    <th>cantidad</th>
                    <th>cant_minima</th>
                    <th>precio_venta_con_factura</th>
                    <th>precio_venta_sin_factura</th>
                    <th>precio_compra</th>
                    <th>foto</th>
                    <th>fecha_expiracion</th>
                    <th>tienda</th>
                    <th>unidad</th>
                    <th>estado</th>
                    <th>estante</th>
                    <th>categoria</th>
                    <th>id_proveedor</th>
                </tr>
            </thead>
            <tbody id="tabla" class="divide-y divide-gray-300 border border-gray-300">
                <tr>
                    {{-- <td>
                    <input class="w-20 mx-1 " id="ci" type="text" name="ci[]" value="1111">
                </td>
                <td>
                    <input class="w-20 mx-1 "  id="nombre" type="text" name="nombre[]" value="pruebaxd">
                </td>
                <td>
                    <input class="w-20 mx-1 " id="empresa" type="text" name="empresa[]" value="pruebaxd">
                </td> --}}
                </tr>


            </tbody>
        </table>
    </form>

    <script src="{{ asset('js/backupxd/consumirApiProducto.js') }}"></script>
@endsection
