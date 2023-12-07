<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <invoice></invoice>
            </div>
        </div>
    </div>
</body>
<script src="{{asset('component/invoice.tag')}}" type="tag"></script>
<script>
    $(document).ready(function()){
        riot.mount('invoice');
    }
</script>

</html>
