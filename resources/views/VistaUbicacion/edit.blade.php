@extends('navegador')

@section('Contenido')

    <h1> EDITAR UBICACION</h1>

     <form action="{{Route('Ubicacion.update',$ubicacion->id)}}" method="POST">
        @csrf
        @method('PUT')

        <label for=""> Codigo de Ubicacion </label>
        <input type="text" name="codigo_ubi" id="" value="{{$ubicacion->codigo_ubi}}"> <br>
        
        <label for=""> Seleccione un codigo de Estente: </label>
        <select name="codigo_estante" id="">
            <option value="{{$ubicacion->codigo_estantes}}"> {{$ubicacion->nombre_estante}}</option>
            @foreach ($estantes as $es )
                @if ($es->id !=$ubicacion->codigo_estantes)
                    <option value="{{$es->id}}"> {{$es->nombre}}</option>
                    @endif
            @endforeach
        </select>

        <br>
        <button type="submit"> Guardar</button>

    </form>

@endsection
