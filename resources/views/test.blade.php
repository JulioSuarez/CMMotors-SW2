<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <!-- #asi se determina si el usuario esta autenticado o no -->
    <?php
    $name = Auth::user()->name;
    $id = Auth::user()->id;
    $email = Auth::user()->email;
    ?>

    @if ($id == '1')
        @include('admin.index')
    @else
        @include('empleado.index')
    @endif
    <br>
</body>

</html>
