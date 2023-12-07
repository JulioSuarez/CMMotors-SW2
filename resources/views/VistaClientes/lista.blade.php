<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="print.css" href="{{ public_path('css/app.css') }}" type="text/css" media="print" /> --}}
    {{-- <link rel="stylesheet" href="{{ public_path('css/app.css') }}" type="text/css" media="print" /> --}}
    <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">


    <title>Listado de Clientes</title>
</head>
<body>
    @php
        $l = 1;
    @endphp
    <header class="headerr">
        <img src="{{ public_path('img/fotosPDF/locochon.gif') }}" width="695px" height="90px">
    </header>
    <div class="invoice-box">
        {{-- invoice items --}}
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th class="text-center">#</th>
                    <th class="text-left">Nombre o Razon Social</th>
                    <th class="text-left">CI/NIT</th>
                    <th class="text-center">Telefono</th>
                    {{-- <th class="text-center">Correo</th> --}}
                    <th class="text-center">Dirección y Correo</th>
                </tr>
            </thead>
            @foreach ($clientes as $cli)
                <tr class="item">
                    <td class="text-center">{{ $l++ }}</td>
                    <td>{{ $cli->nombre }}</td>
                    <td>{{ $cli->ci }}</td>
                    <td>{{ $cli->telefono }}</td>
                    {{-- <td>{{ $cli->correo }}</td> --}}
                    <td>{{ $cli->direccion }} | Email: {{ $cli->correo }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
