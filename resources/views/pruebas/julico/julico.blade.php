<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-5">
        <div class="card">
            <h5 class="card-header bg-secondary text-white">Buscar información de la base de datos en tiempo real con
                laravel 9 y JavaScript</h5>
            <div class="card-body">
                <div class="container">
                    <div class="row height d-flex justify-content-center align-items-center">
                        <div class="col-md-8">
                            <div class="search">
                                <i class="fas fa-search icon"></i>
                                <input type="text" id="mysearch" class="form-control"
                                    placeholder="Buscar un producto">
                            </div>
                            <ul id="ShowList" tabindex='1' class="list-group"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('search/search.js') }}" type="module"></script>
</body>

</html>
