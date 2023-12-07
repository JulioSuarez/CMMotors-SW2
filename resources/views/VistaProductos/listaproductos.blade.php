<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <style>
    </style>
    <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">
    <title>Lista de Productos</title>
</head>

<body>
    <header class="headerr">
        <img src="{{ public_path('img/fotosPDF/locochon.gif') }}" width="695px" height="95px">
    </header>
    <div class="invoice-box">
        {{-- invoice items --}}
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th class="text-center">#</th>
                    <th class="text-center">COD.PRODUCTO</th>
                    <th class="text-center">COD.OEM</th>
                    <th class="text-center">DETALLE</th>
                    <th class="text-center">P.COMPRA</th>
                    <th class="text-center">P.VENTA S/F</th>
                    <th class="text-center">P.VENTA C/F</th>
                    {{-- <th class="text-center">STOCK</th> --}}
                    {{-- <th class="text-center">UBICACIÓN</th> --}}
                </tr>
            </thead>
            @php
                $l = count($productos);
                $stock = 0;
                $compra = 0;
                $factura = 0;
                $sinfactura = 0;
                $utilidad = 0;
            @endphp
            @for ($i = 0; $i < $l; $i++)
                <tr class="item">
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center">{{ $productos[$i]->cod_producto }}</td>
                    <td class="text-center">{{ $productos[$i]->cod_oem }}</td>
                    <td>{{ $productos[$i]->nombre }}
                        | Stock: {{ $productos[$i]->cantidad }}
                        | Ubicacion: {{ $productos[$i]->estante }}</td>
                    <td class="text-center">{{ $productos[$i]->precio_compra }}</td>
                    <td class="text-center">{{ $productos[$i]->precio_venta_sin_factura }}</td>
                    <td class="text-center">{{ $productos[$i]->precio_venta_con_factura }}</td>
                    {{-- <td class="text-center">{{ $productos[$i]->cantidad }}</td> --}}
                    {{-- <td class="text-center">{{ $productos[$i]->estante }}</td> --}}
                    <td class="hidden">{{$compra+=($productos[$i]->precio_compra * $productos[$i]->cantidad)}}</td>
                    <td class="hidden">{{$factura+=($productos[$i]->precio_venta_sin_factura * $productos[$i]->cantidad)}}</td>
                    <td class="hidden">{{$sinfactura+=($productos[$i]->precio_venta_con_factura * $productos[$i]->cantidad)}}</td>
                    <td class="hidden">{{$stock+=($productos[$i]->cantidad)}}</td>
                    <td class="hidden">{{$utilidad+=(($productos[$i]->precio_venta_con_factura - $productos[$i]->precio_compra) * $productos[$i]->cantidad)}}</td>
                </tr>
            @endfor
        </table>
        <table class="">
            <thead>
                <tr class="item">
                    <th class="text-right">
                        Stock total de productos:
                    </th>
                    <td>
                        {{ $stock }}
                    </td>
                </tr>
                <tr class="item">
                    <th class="text-right">
                        Sumatoria de Costos de Compra de cada producto:
                    </th>
                    <td>
                        {{$compra}}
                    </td>
                </tr>
                <tr class="item">
                    <th class="text-right">
                        Sumatoria de los precios de venta c/f:
                    </th>
                    <td>
                        {{$factura}}
                    </td>
                </tr>
                <tr class="item">
                    <th class="text-right">
                        Sumatoria de los precios de venta s/f:
                    </th>
                    <td>
                        {{$sinfactura}}
                    </td>
                </tr>
                <tr class="item">
                    <th class="text-right">
                        Sumatoria de la Utilidad estimada:
                    </th>
                    <td>
                        {{$utilidad}}
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>
