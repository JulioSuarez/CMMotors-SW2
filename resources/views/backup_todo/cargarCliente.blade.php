@extends('navegador')

@section('Contenido')
    <button id="buttonApi" type="button" class="bg-red-400 "> AGREGAR CLIENTES DESDE LA API</button>

    <form action="{{ Route('Cliente.storexd') }}" method="post">
        @csrf
        
    <button type="submit">enviar</button>
        <table class="table-auto">
            <thead class=" border border-gray-300 ">
                <tr>
                    <th>ci</th>
                    <th>nombre</th>
                    <th>empresa</th>
                    <th>nit</th>
                    <th>correo</th>
                    <th>telefono</th>
                    <th>direccion</th>
                </tr>
            </thead>
            <tbody id="tabla" class="divide-y divide-gray-300 border border-gray-300">
                <tr>

                </tr>

            </tbody>
        </table>
    </form>

    <script src="{{ asset('js/backupxd/consumirApiCliente.js') }}"></script>
@endsection
