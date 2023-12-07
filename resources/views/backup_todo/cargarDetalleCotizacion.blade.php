@extends('navegador')

@section('Contenido')
    <button id="buttonApi" type="button" class="bg-red-400 "> AGREGAR DETALLES DE COTIZACION DESDE LA API</button>

    <form action="{{ Route('storeDetalleCotizarAPI') }}" method="post">
        @csrf

        <button type="submit">enviar</button>
        <table class="table-auto">
            <thead class=" border border-gray-300 ">
                <tr>
                    <th>id</th>
                    <th>cantidad</th>
                    <th>precio</th>
                    <th>id_producto</th>
                    <th>id_cotizacion</th>
                    <th>precio_producto_unitario</th>
                    <th>tiempo_entrega</th>
                    <th>detalle_co</th>
                    <th>unidad_co</th>
                </tr>
            </thead>
            <tbody id="tabla" class="divide-y divide-gray-300 border border-gray-300">
                <tr>
                </tr>

            </tbody>
        </table>

    </form>

    <script src="{{ asset('js/backupxd/consumirApiDetalleCotizacion.js') }}"></script>
@endsection
