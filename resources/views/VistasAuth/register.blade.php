<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>register</title>
</head>
<body>

    <div class="">
        <h1 class="text-center p-4 font-black">
            Registrate ahora!
        </h1>

        <div class="row w-75 m-auto">
            <div class="col-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Imagen">
            </div>

            <div class="col-8">
                <form action="{{ route('register.store') }}" method="POST" class="row">
                    @csrf

                    <div class="mb-3 col-12">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" class="form-control" id="name" name="nombre_usuario" placeholder="name complete">
                    </div>

                    <div class="mb-3 col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="correo_electronico" placeholder="name@example.com">
                    </div>

                    <div class="mb-3 col-12">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="password" placeholder="password">
                    </div>

                    <div class="mb-3 col-12">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="password">
                    </div>

                    <input type="submit" value="registrarme" class="btn btn-primary col-12">
                </form>

                {{-- <form action="{{ route('register.index') }}" method="POST">
                    @csrf
                    <label for="email">Correo Electronico</label>
                    <input type="email" value="" id="email" name="correo_electronico">
                    <br>
                    <label for="contrasena">Contrasena</label>
                    <input type="password" value="" id="contrasena" name="password">
                    <button type="submit"> iniciar </button>
                </form> --}}
            </div>
        </div>
    </div>

</body>
</html>
