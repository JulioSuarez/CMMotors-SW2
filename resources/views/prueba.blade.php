@extends('navegador')

@section('Contenido')

<p>hola mundp</p>

{{-- <form action="{{route('prueba_post')}}" method="post"> --}}
    <form action="{{route('prueba.show')}}" method="post">
    @csrf
        <input class="border-2 " type="text" name="code" id="" placeholder="buscar">
        <input class="border-2 " type="text" name="antes" id="" value="89">
        <input class="border-2 " type="text" name="ventana" id="" value="edit">
        <button type="submit" >
            buscar
        </button>
</form>


@endsection

