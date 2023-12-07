@extends('navegador')

@section('Contenido')
    <button id="buttonApi" type="button" class="bg-red-400 "> AGREGAR PROVEEDORES DESDE LA API</button>

    <form action="{{ Route('Proveedor.store2') }}" method="post" enctype="multipart/form-data">
        @csrf

        <button type="submit">enviar</button>
        <table class="table-auto">
            <thead class=" border border-gray-300 ">
                <tr>
                    <th>id</th>
                    <th>nombre_proveedor</th>
                    <th>proveedor_direccion</th>
                    <th>proveedor_telefono</th>
                    <th>proveedor_correo</th>
                    <th>nombre_proveedor_contacto</th>
                    <th>nit</th>
                    <th>tipo</th>
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

    <script src="{{ asset('js/backupxd/consumirApiProveedor.js') }}"></script>
@endsection
