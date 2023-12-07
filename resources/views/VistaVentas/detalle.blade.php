<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
        body {
            background-image: url({{ public_path('img/logocm.gif') }});
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* background-size: 100% 100%; */
            background-position: center;
            /* background-position: 50% 100%; */
            opacity: 0.2;
        }
    </style>

    <title>Facturacion - CM Motors</title>
</head>

<body>
    <div class="flex items-center text-sm">
        <div>
            <table class="w-full">
                <tr>
                    <td width="200" align="left">
                        <img src="{{ public_path('img/logo-cm.png') }}" alt="Imagen Superior" width="210">
                        <!-- <h6>CM Motor´s Import Export</h6><br>
                        <h6>Telf. 70297978</h6> -->
                        <!-- <p class="text-xs">Telf. 70297978</p> -->
                    </td>
                    <td width="200" align="right">
                    </td>
                    <td width="130" align="right" valign="top">
                        Santa Cruz {{$xds->fecha}}
                        CM Motor´s Import Export
                        Telf. 70297978
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <table class="table">
        <thead class="table-light">
            <tr>
                <th scope="col">Señor(es): </th>
                <th width="100%" align="left">{{ $xds->nombre_cliente }}</th>
            </tr>
            <tr>
                <th scope="col">NIT/CI: </th>
                <th width="100%" align="left">{{ $xds->ci_cliente }}</th>
            </tr>
        </thead>
    </table>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ITEM.</th>
                <th scope="col">CANT.</th>
                <th scope="col">D E T A L L E</th>
                <th scope="col">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            @php
                $a = 0;
            @endphp
            @foreach ($xd as $ubi)
                <tr>
                    <th scope="row">{{ $a = $a + 1 }}</th> -->
                    <td>{{ $ubi->cantidad }}</td>
                    <td>{{ $ubi->nombre_producto }}</td>
                    <td>{{ $ubi->precio }}</td>
                </tr>
            @endforeach
            <tr>
                <th></th>
                <th></th>
                <th>
                    Total en Bs:
                </th>
                <td>{{$xds->monto_total}}</td>
            </tr>
            <!-- <tr>
                <th></th>
                <th></th>
                <th align="right">
                    Total en $us:
                </th>
                <td>{{$xds->monto_total}}</td>
            </tr> -->
        </tbody>
    </table>
<p width="100%" align="right" valign="down">.</p>
</body>

</html>
