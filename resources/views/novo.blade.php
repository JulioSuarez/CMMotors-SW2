<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

        @foreach ($rol as $fila)
        <tr class="">

            <td class="">{{$fila->id}} -
                {{$fila->name}} - {{$fila->description}}
            </td>
        </tr>

        @endforeach

</body>
</html>
