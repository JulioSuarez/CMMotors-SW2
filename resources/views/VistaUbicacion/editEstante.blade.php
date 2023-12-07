@extends('navegador')

@section('Contenido')

<h1> REGISTRO DE ESTANTES </h1>

<form action="{{Route('Estante.update',$estante->id)}}" method="POST">
@csrf  
@method('PUT')

<label for=""> Nombre </label>
<input type="text" name="nombre" id="" value="{{$estante->nombre}}"> <br>

<label for=""> Descripcion </label>
<input type="text" name="descripcion" id="" value="{{$estante->descripcion}}"> <br>

<label for=""> Nro de columans </label>
<input type="number" name="nro_columnas" id="" value="{{$estante->nro_columnas}}"> <br>

<label for=""> Nro de Filas </label>
<input type="number" name="nro_filas" id="" value="{{$estante->nro_filas}}"> <br>

<select name="id_sector" id="">
    <option value="{{$estante->id_sector}}"> {{$estante->nombre_sector}}</option>
    @foreach ($sectores as $es )
        @if ($estante->id_sector != $es->id)
             <option value="{{$es->id}}"> {{$es->nombre}}</option>
        @endif
   @endforeach
</select>

<br>
<button type="submit"> Guardar</button>

</form>
@endsection
