@extends('navegador')

@section('Contenido')
    <button id="buttonApi" type="button" class="bg-red-400 "> AGREGAR DATOS GENERALES DESDE LA API</button>

    <form action="{{ Route('storeDatosAPI') }}" method="post">
        @csrf

        <button type="submit">enviar</button>
        <table class="table-auto">
            <thead class=" border border-gray-300 ">
                <tr>
                    <th>id</th>
                    <th>tipo_de_cambio</th>
                    <th>forma_pago</th>
                    <th>cheque</th>
                    <th>cuenta_bancaria</th>
                    <th>entrega</th>
                    <th>nota</th>
                </tr>
            </thead>
            <tbody id="tabla" class="divide-y divide-gray-300 border border-gray-300">
                <tr>
                </tr>
            </tbody>
        </table>



    </form>

    <script src="{{ asset('js/backupxd/consumirApiDatos.js') }}"></script>
@endsection
