<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <title>{{config('APP_NAME', 'Contactanos')}}</title>
</head>
<body>
    <h1>{{$subject}}</h1>
    <h3>Sugerencias, quejas o reclamos</h3>
    <p class="p-5">
        <strong>Nombre: </strong> <span>{{$name}}</span><br>
        <strong>Correo: </strong> <span>{{$email}}</span><br>
        <strong>Telefono: </strong> <span>{{$phone}}</span><br>
    </p>
    <p>
        {{$messagee}}
    </p>
</body>
</html>
