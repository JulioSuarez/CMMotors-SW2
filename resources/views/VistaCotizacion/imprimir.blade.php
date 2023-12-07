<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ public_path('css/invoice.css') }}">
    <title>Cotizaciones</title>
</head>

    <style>
        .body{
            /* src: url('img/fotosPDF/ventas.svg'),format("svg"); */
            /* background: url('img/fotosPDF/coti.svg'), none; */
            background-image: url('img/fotosPDF/coti3.gif');
            background-position: center;
            background-size: 100%;
            background-repeat: no-repeat;
            padding-top: 3.8cm;
            padding-bottom: 1cm;
        }
    </style>

<body class="body">
    {{-- <div>
        <img src="{{ public_path('img/fotosPDF/ventas.svg') }}" alt="">
        <p>123</p>
        <p>123</p>
        <p>123</p>
        <p>123</p>
        <p>123</p>
        <p>123</p>
        <p>123</p>
        <p>123</p>
        <p>123</p>
        <img src="{{ public_path('img/fotosPDF/ventas.svg') }}" alt="">
        <p>hola mundo</p>
    </div> --}}
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td class="w-50">
                    <div><span class="bold">Asesor de venta</span>: {{ $xds->nombre_empleado }}
                        {{ $xds->apellido_empleado }}</div>
                        <div><span class="bold">E-mail</span>: {{ $xds->correo_electronico }}</div>
                        <div><span class="bold">Celular</span>: {{ $xds->telefono_empleado }}</div>
                        <div><span class="bold">Whatsapp</span>: {{ $xds->telefono_empleado }}
                            <img class="" src="{{ public_path('img/fotosPDF/wpp.svg') }}" width="12px">
                        </div>
                </td>


                <td class="text-right">
                    <div><span class="bold">Fecha</span>: {{ $xds->fecha_realizada }} </div>
                    <div><span class="bold">Fecha Validez</span>: {{ $xds->fecha_validez }} </div>
                    <div><span class="bold">COTIZACION-Nro</span> {{ $xds->nro_coti }}</div>
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
            <div><span class="bold">Atención:</span> {{ $xds->atencion }}</div>
            <div><span class="bold">Ref:</span> {{ $xds->referencia }}</div>
        </div>

        {{-- invoice items --}}
        <table class="items-table" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="heading">
                    <th class="text-center">ITEM</th>
                    <th class="text-center">CANT.</th>
                    <th class="text-center">UNIT.</th>
                    <th class="text-center">DESCRIPCION</th>
                    <th class="text-center">T.ENTREGA</th>
                    <th class="text-center">P.UNIT.</th>
                    <th class="text-center">TOTAL</th>
                </tr>
            </thead>
            @php
                $i = 0;
            @endphp
            @foreach ($xd as $product)
                <tr class="item">
                    <td class="text-center">{{ ++$i }}</td>
                    <td class="text-center">{{ $product->cantidad }}</td>
                    <td  class="text-center up" >{{ $product->unidad_co }}</td>
                    <td>{{ $product->detalle_co }}</td>
                    <td class="text-center">{{ $product->tiempo_entrega }}</td>
                    <td class="text-center">{{ $product->precio_producto_unitario }}</td>
                    <td class="text-center">{{ $product->precio }}</td>
                </tr>
            @endforeach

            <tr class="total">
                <td colspan="7">Sub-Total: {{ $xds->monto_total }}</td>
            </tr>
            <tr class="total">
                <td colspan="7">Descuento: {{ $xds->descuento }} %</td>
            </tr>
            <tr class="total">
                <td colspan="7">Total en BS: {{ $xds->total_en_bolivianos }}</td>
            </tr>
            <tr class="total">
                <td colspan="7">Total en $us: {{ $xds->total_en_dolares }}</td>
            </tr>

        </table>

            <table class="tnota saltopagina" cellpadding="0" cellspacing="0">
                <thead>
                    <td class="nota">
                        Nota: {{ $datos->nota }}
                    </td>
                    <br>
            </table>
            <table cellpadding="0" cellspacing="0">
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
                        {{-- <div><span class="bold">Nota: {{ $datos->nota }} </span></div> --}}
                    </td>
                </tr>
            </table>
        </div>

</body>

</html>
