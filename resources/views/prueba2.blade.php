<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CM Motor's Import Export</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex justify-center">
       <div class=" w-3/4 m-10">
            <form action="{{  route('Existe_usuario')}}" class="flex flex-col space-y-4" method="post">
                @csrf
                <div class="">
                    <label for="">USUARIO </label>
                    <input class="border-2 p-1 " type="text" name="valor">
                </div>

                <div>
                    <label for="">CI_EMPLEADO </label>
                    <input class="border-2 p-1 " type="text" name="id_edit">
                </div>

                {{-- <div>
                    <label for=""></label>
                    <input class="border-2 p-1 " type="text">
                </div> --}}
                <button type="submit" class="btn-blue w-24">
                    enviar
                </button>
            </form>
       </div>
    </div>


</body>
</html>
