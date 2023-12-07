<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>
        inicio de seccion!!!!!
    </h1>

    <form action="{{ route('Login') }}" method="POST">
        @csrf
        <label for="email">Correo Electronico</label>
        <input type="email" value="" id="email" name="correo_electronico">
        <br>
        <label for="contrasena">Contrasena</label>
        <input type="password" value="" id="contrasena" name="password">
        <button type="submit"> iniciar </button>
    </form>

</body>
</html>
