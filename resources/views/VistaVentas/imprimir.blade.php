<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">
    <title>Venta</title>
</head>

<style>
        .body{
            background-image: url('img/fotosPDF/venta.gif');
            background-position: center;
            background-size: 100%;
            background-repeat: no-repeat;
            padding-top: 4.5cm;
            padding-bottom: 4cm;
        }
    </style>


<body class="body">

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td class="w-50">
                    <div><span class="bold">Asesor de venta</span>: {{ $xds->nombre_empleado }}
                        {{ $xds->apellido_empleado }}</div>
                    <div><span class="bold">E-mail</span>: {{ $xds->correo_electronico }}</div>
                    <div><span class="bold">Celular</span>: {{ $xds->telefono_empleado }}</div>
                    <div><span class="bold">Whatsapp</span>: {{ $xds->telefono_empleado }}
                        <img class="" src="{{ public_path('img/fotosPDF/wpp.svg') }}" width="10px"></div>
                </td>

                <td class="text-right">
                    <div><span class="bold">Fecha</span>: {{ $xds->fecha }} </div>
                    <div><span class="bold">Venta-Nro</span> {{ $xds->id }}</div>
                    <div><span class="bold">T/C</span>: {{ $datos->tipo_de_cambio }}</div>
                </td>
            </tr>
        </table>

        {{-- customer information --}}
        <div class="mt">
            <table class="cliente" cellpadding="0" cellspacing="0">
                <thead>
                    <td>
                        Cliente
                    </td>
            </table>
            <div><span class="bold">Señor(es):</span> {{ $xds->nombre_cliente }}</div>
        </div>

        {{-- invoice items --}}
        <table class="items-table mt" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th class="text-center">ITEM</th>
                    <th class="text-center">CANT.</th>
                    <th class="text-center">UNIT.</th>
                    <th class="text-center">DESCRIPCION</th>
                    {{-- <th class="text-center">T.ENTREGA</th> --}}
                    <th class="text-center">P.UNIT.</th>
                    <th class="text-center">TOTAL</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
            @foreach ($xd as $product)
                <tr class="item">
                    <td class="text-center">{{ $i }}</td>
                    <td class="text-center">{{ $product->cantidad }}</td>
                    <td class="text-center up">{{ $product->unidad }}</td>
                    <td>{{ $product->detalles }}</td>
                    <td class="text-center">{{ $product->precio_producto_unitario }}</td>
                    <td class="text-center">{{ $product->precio }}</td>
                </tr>
                {{ $i++ }}
            @endforeach

            <tr class="total">
                <td colspan="6">Sub-Total: {{ $xds->monto_total }}</td>
            </tr>
            <tr class="total">
                <td colspan="6">Descuento: {{ $xds->descuento }} %</td>
            </tr>
            <tr class="total">
                <td colspan="6">Total en BS: {{ $xds->total_en_bolivianos }}</td>
            </tr>
            <tr class="total">
                <td colspan="6">Total en $us: {{ $xds->total_en_dolares }}</td>
            </tr>

        </table>

        <table cellpadding="0" cellspacing="0" class="saltopagina">
            <tr>
                <td>
                    <div class="cliente"><span class="bold">Terminos y Condiciones (Facturación Local)</span></div>
                    <div><span class="bold">Representante Legal: Ernesto Edil Claros Melgar - CI. 7665967 SC</span>
                    </div>
                    <div><span class="bold">1 Cotizado en:</span> moneda nacional</div>
                    <div><span class="bold">2 Forma de pago:</span> {{ $datos->forma_pago }}</div>
                    <div><span class="bold">3 Cheque a nombre de:</span> {{ $datos->cheque }}</div>
                    <div><span class="bold">4 Transferencia Bancaria:</span> {{ $datos->cuenta_bancaria }}</div>
                    <div><span class="bold">5 Lugar de entrega:</span> {{ $datos->entrega }}</div>
                    <div><span class="bold">Nota: {{ $datos->nota }} </span></div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
