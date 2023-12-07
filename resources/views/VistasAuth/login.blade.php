<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> --}}
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<style>
    .fondo {
        /* background-color: black; */
        background-image: url('img/bg.jpg');
        background-position: center;
        background-size: 100%;
        background-repeat: repeat;
    }

    .negro {
        background-color: black;
    }
</style>

<body class="fondo">

    <div class="">
        <div class="row w-75 m-auto">

            <div class="col">
                <div class="flex min-h-full items-center justify-center py-20 px-4 sm:px-6 lg:px-8">

                    <div class="w-full max-w-md space-y-8">
                        <div class="negro">
                            <img class="mx-auto h-32 w-auto" src="{{ asset('img/logo-CM-Motors.gif') }}"
                                alt="CM Motors">
                        </div>

                        <div class="bg-gray-0">
                            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-100">
                                Iniciar Sesión
                            </h2>
                        </div>

                        <form id="login" action="{{ Route('LoginStore') }}" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="remember" value="true"> --}}
                            <div class=" rounded-md shadow-sm ">
                                {{-- <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Correo Electronico
                            </label> --}}

                                {{-- <label for="email" class="">Email Address</label> --}}
                                <input id="email" name="correo_electronico" type="text" autocomplete="email"
                                    required
                                    class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Correo Electronico o Usuario" value="{{ old('correo_electronico') }}">



                                {{-- <label for="password" class="sr-only">Password</label> --}}
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Contrasena" value="{{ old('password') }}">

                            </div>

                            <div class="my-2 ">
                                @error('password')
                                    <p class="text-white bg-red-600 p-2 text-sm rounded-xl "> {{ $message }} </p>
                                @enderror
                                @error('correo')
                                    <p class="text-white bg-red-600 p-2 text-sm rounded-xl"> {{ $message }} </p>
                                @enderror


                                @if (session('statusLogout'))
                                    <p class="text-white bg-lime-500 p-2 text-sm rounded-xl">
                                        Seccion Cerrada Exitosamente
                                    </p>
                                @endif
                            </div>




                            <div class="flex flex-row-reverse items-center justify-between mb-2">
                                {{-- <div class="flex items-center ">
                                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="remember-me" class="ml-2 block text-sm text-black-900">Recordar Contrasena</label>
                            </div> --}}

                                {{-- @include('VistasAuth.modelOlvidaste') --}}
                                <p class="font-medium text-indigo-600 hover:text-indigo-500" href="">
                                    Olvidaste tu contrasena?</p>
                            </div>

                            <div>
                                <button id="login" type="submit"
                                    class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <!-- Heroicon name: mini/lock-closed -->
                                        <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    Entrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>

        </div>
    </div>

</body>

</html>
