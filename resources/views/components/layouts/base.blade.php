<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>



</head>

<body>

    <header style="display: flex; gap:10px; flex-flow:row;">
        @auth
            <a href="{{route('user.logout')}}">Logout</a>
            <a href="{{route('lavados.listar')}}">Mostrar Lavados</a>
            <a href="{{route('lavados.create')}}">Crear Lavado</a>
            <a href="{{route('citas.index')}}">Mostrar Citas</a>

        @endauth

    </header>

    {{$slot}}
</body>

</html>
