<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>



</head>

<body>

    <head>
        @auth
            <a href="{{route('user.logout')}}">Logout</a>
        @endauth
    </head>

    {{$slot}}
</body>

</html>
