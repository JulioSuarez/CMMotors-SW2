@extends('navegador')

@section('Contenido')
    <button id="buttonApi" type="button" class="bg-red-400 "> AGREGAR VENTAS DESDE LA API</button>

    <form action="{{ Route('storeVentasAPI') }}" method="post">
        @csrf

        <button type="submit">enviar</button>
        <table class="table-auto">
            <thead class=" border border-gray-300 ">
                <tr>
                    <th>id</th>
                    <th>monto_total</th>
                    <th>fecha</th>
                    <th>hora</th>
                    <th>descuento</th>
                    <th>total_en_bolivianos</th>
                    <th>total_en_dolares</th>
                    <th>estado</th>
                    <th>ci_cliente</th>
                    <th>ci_empleado</th>
                    <th>id_datos</th>
                </tr>
            </thead>
            <tbody id="tabla" class="divide-y divide-gray-300 border border-gray-300">
                <tr>
                </tr>

            </tbody>
        </table>


    </form>

    <script src="{{ asset('js/backupxd/consumirApiVenta.js') }}"></script>
@endsection
