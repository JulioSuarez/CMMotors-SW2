@extends('navegador')

@section('Contenido')

    <h1> REGISTRO DE UBICACIONES </h1>

    <form action="{{Route('Ubicacion.store')}}" method="POST">
        @csrf
        @method('POST')

        <label for=""> Codigo de Ubicacion </label>
        <input type="text" name="codigo_ubi" id="" value=""> <br>

        <label for=""> Seleccione un codigo de Estente </label>
        <select name="codigo_estante" id="">
            @foreach ($estantes as $es )
                <option value="{{$es->id}}"> {{$es->nombre}}</option>
            @endforeach
        </select>

        <br>
        <button type="submit"> Guardar</button>

    </form>

    <br><P>---------------------------------------------------------------</P> <br>

    <h1> REGISTRO DE ESTANTES </h1>

    <form action="{{Route('Estante.store')}}" method="POST">
        @csrf
        @method('POST')

        <label for=""> Nombre </label>
        <input type="text" name="nombre" id="" value=""> <br>

        <label for=""> Descripcion </label>
        <input type="text" name="descripcion" id="" value=""> <br>

        <label for=""> Nro de columans </label>
        <input type="number" name="nro_columnas" id="" value=""> <br>

        <label for=""> Nro de Filas </label>
        <input type="number" name="nro_filas" id="" value=""> <br>

        <select name="id_sector" id="">
            @foreach ($sectores as $es )
                <option value="{{$es->id}}"> {{$es->nombre}}</option>
            @endforeach
        </select>

        <br>
        <button type="submit"> Guardar</button>

    </form>


    <br><P>---------------------------------------------------------------</P> <br>


    <h1> REGISTRO DE SECTORES </h1>

    <form action="{{Route('Sector.store')}}" method="POST">
        @csrf
        @method('POST')

        <label for=""> Nombre </label>
        <input type="text" name="nombre" id="" value=""> <br>

        <label for=""> Descripcion </label>
        <input type="text" name="descripcion" id="" value=""> <br>

        <br>
        <button type="submit"> Guardar</button>

    </form>

@endsection
