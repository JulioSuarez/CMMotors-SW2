<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <style>
        /* * {
            font-family: 'Lato', sans-serif;
        } */
    </style>
    <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">
    <title>Venta</title>
</head>

<body>
    <header class="headerr">
        <img src="{{ public_path('img/fotosPDF/locochon.gif') }}" width="695px" height="90px">
    </header>
    <div class="invoice-box">
        {{-- invoice items --}}
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th class="text-left">#</th>
                    <th class="text-left">NRO DE VENTA.</th>
                    <th class="text-left">FECHA</th>
                    <th class="text-center">INVERSION</th>
                    <th class="text-center">IMPORTE TOTAL</th>
                    <th class="text-center">UTILIDAD BRUTA</th>
                </tr>
            </thead>
            @php
                $l = count($ventas);
                $inversion = 0;
                $monto = 0;
                $utilidad = 0;
            @endphp
            @for ($i = 0; $i < $l; $i++)
                <tr class="item">
                    <td>{{ $i + 1 }}</td>
                    <td>VENTA-NRO-{{ $ventas[$i]->id }}</td>
                    <td>{{ $ventas[$i]->fecha }}</td>
                    <td class="text-center">{{ $suma_pu[$i] }}</td>
                    <td class="text-center">{{ $ventas[$i]->total_en_bolivianos }}</td>
                    <td class="text-center">{{ $utilidades[$i] }}</td>
                    <td class="hidden">{{ $inversion += $suma_pu[$i] }}</td>
                    <td class="hidden">{{ $monto += $ventas[$i]->total_en_bolivianos }}</td>
                    <td class="hidden">{{ $utilidad += $utilidades[$i] }}</td>
                </tr>
            @endfor

        </table>
        <table>
            <thead>
                <tr class="item">
                    <th class="text-right">
                        Cantidad de Ventas Realizadas:
                    </th>
                    <td>
                        {{ $l }}
                    </td>
                </tr>
                <tr class="item">
                    <th class="text-right">
                        Sumatoria de los precios de compra de cada producto:
                    </th>
                    <td>
                        {{ $inversion }}
                    </td>
                </tr>
                <tr class="item">
                    <th class="text-right">
                        Sumatoria de los precios de venta de cada producto:
                    </th>
                    <td>
                        {{ $monto }}
                    </td>
                </tr>
                <tr class="item">
                    <th class="text-right">
                        Sumatoria de la utilidad bruta estimada:
                        </td>
                    <td>
                        {{ $suma_xd }}
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>
