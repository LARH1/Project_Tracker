<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/project.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
    <title>Proyecto Descargado</title>
</head>

<body>
    <div class="container text-center">
        <p class="h5 ">{{$project->clave}}</p>
        <br>
        <i style="font-size: 7rem;" class="text-secondary far fa-clock"></i>
        <p class="mt-4">El archivo del proyecto {{$project->clave}} fue descargado el 
        {{$fecha}} a las {{$hora}} hrs</p>
    </div>
</body>

</html>