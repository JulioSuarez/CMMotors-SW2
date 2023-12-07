<table>
    <thead>
        <tr>
            <th>id</th>
            <th>cod_producto</th>
            <th>cod_oem</th>
            <th>nombre</th>
            <th>marca</th>
            <th>procedencia</th>
            <th>origen</th>
            <th>cantidad</th>
            <th>cant_minima</th>
            <th>precio_venta_con_factura</th>
            <th>precio_venta_sin_factura</th>
            <th>precio_compra</th>
            <th>foto</th>
            {{-- <th>fecha_expiracion</th> --}}
            <th>tienda</th>
            <th>unidad</th>
            <th>estado</th>
            <th>estante</th>
            <th>id_tugerente</th>
            <th>id_proveedor</th>

{{-- 
            <th> id_venta</th>
            <th> id_producto</th>
            <th> cod_oem</th>
            <th> cod_sustituto</th>
            <th> nombre</th>
            <th> precio</th>
            <th> tienda </th> --}}

            {{-- <th> cod_producto</th>
            <th>cod_oem</th>
            <th>nombre</th>
            <th>precio</th>
            <th>prod_id</th>
            <th>prod_cod_oem</th>
            <th>prod_cod_sustito</th> --}}
        
        </tr>
    </thead>

    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id}}</td>
                <td>{{ $producto->cod_producto}}</td>
                <td>{{ $producto->cod_oem}}</td>
                <td>{{ $producto->nombre}}</td>
                <td>{{ $producto->marca}}</td>
                <td>{{ $producto->procedencia}}</td>
                <td>{{ $producto->origen}}</td>
                <td>{{ $producto->cantidad}}</td>
                <td>{{ $producto->cant_minima}}</td>
                <td>{{ $producto->precio_venta_con_factura}}</td>
                <td>{{ $producto->precio_venta_sin_factura}}</td>
                <td>{{ $producto->precio_compra}}</td>
                <td>{{ $producto->foto}}</td>
                {{-- <td>{{ $producto->fecha_expiracion}}</td> --}}
                <td>{{ $producto->tienda}}</td>
                <td>{{ $producto->unidad}}</td>
                <td>{{ $producto->estado}}</td>
                <td>{{ $producto->estante}}</td>
                <td>{{ $producto->id_tugerente}}</td>
                <td>{{ $producto->id_proveedor}}</td>

                {{-- <td> {{ $producto['id_venta']}} </td>
                <td> {{ $producto['id_producto']}}</td>
                <td> {{ $producto['cod_oem']}}</td>
                <td> {{ $producto['cod_sustituto']}}</td>
                <td> {{ $producto['nombre']}}</td>
                <td> {{ $producto['precio']}}</td>
                <td> {{ $producto['tienda']}}</td> --}}

                {{-- <td>{{ $producto['cod_producto']}}</td>
                <td>{{ $producto['cod_oem']}}</td>
                <td>{{ $producto['nombre']}}</td>
                <td>{{ $producto['precio']}}</td>
                <td>{{ $producto['prod_id']}}</td>
                <td>{{ $producto['prod_cod_oem']}}</td>
                <td>{{ $producto['prod_cod_sustito']}}</td> --}}

            </tr>
        @endforeach
    </tbody>
</table>
