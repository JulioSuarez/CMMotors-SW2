@extends('navegador')

@section('Contenido')
    <h1 class="font-serif text-gray-800 text-2xl "> Numero de Venta:{{ $venta->id }}</h1>
    <label class="font-serif text-gray-800" for=""> Cliente: {{ $venta->nombre_cliente }}
        {{ $venta->apellido }}</label> <br>



    <div class="my-4 mx-4 overflow-hidden rounded-lg shadow-xs">
        <!-- reemplace w-full por mx-8 -->
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-0 py-3">ITEM </th>
                        <th class="px-4 py-3">Codigo</th>
                        <th class="px-4 py-3">Cantidad </th>
                        <th class="px-4 py-3">Detalle</th>
                        <th class="px-4 py-3">Unidad </th>
                        <th class="px-4 py-3">P/Unidad </th>
                        <th class="px-4 py-3">P/Total</th>
                    </tr>
                </thead>

                <tbody class=" bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($ventas as $v)
                        <tr
                            class=" bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                @php $i++; @endphp
                                @if ($i > 9)
                                    {{ $i }}
                                @else
                                    0{{ $i }}
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $v->cod_oem }}</td>
                            <td class="px-4 py-3 text-sm">{{ $v->cantidad }}</td>
                            <td class="px-4 py-3 text-xs">detalle</td>
                            <td class="px-4 py-3 text-sm">piezas</td>
                            <td class="px-4 py-3 text-sm">{{ $v->precio }}</td>
                            {{-- <td class="px-4 py-3 text-sm">{{ $v->monto_total }}</td> --}}
                            {{-- @dd($v); --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-2">
        <label class="font-serif text-gray-800" for=""> Atentamente: {{ $venta->nombre_empleado }} </label>
        <label class="font-serif text-gray-800 text-right mr-8" for=""> Monto Total: {{ $venta->monto_total }}</label>

    </div>
    <input type="hidden" id="pantalla" value="cotizacion">
@endsection
