@extends('navegador')

@section('Contenido')
<h1> REGISTRO DE SECTORES </h1>

<form action="{{Route('Sector.update',$sector->id)}}" method="POST">
    @csrf
    @method('PUT')

    <label for=""> Nombre </label>
    <input type="text" name="nombre" id="" value="{{$sector->nombre}}"> <br>

    <label for=""> Descripcion </label>
    <input type="text" name="descripcion" id="" value="{{$sector->descripcion}}}"> <br>

    <br>
    <button type="submit"> Guardar</button>
</form>
@endsection
