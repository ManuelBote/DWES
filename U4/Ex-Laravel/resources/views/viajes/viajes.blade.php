<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Viajes</title>
</head>
<body>
    
    <h1>TRAVELBEST - VIAJES 2024</h1>

    <br><br>
    @if(session("mensaje"))
        <div style="color: red">{{session("mensaje")}}</div>
    @endif

    <button><a href="{{route("verReserva")}}">Crear reserva</a></button>

    <br><br>

    <table border="1px solid black">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo del viaje</th>
                <th>Destino</th>
                <th>Nº de noches</th>
                <th>Nº de plazas</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viajes as $v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->TituloViaje}}</td>
                    <td>{{$v->Destino}}</td>
                    <td>{{$v->nNoches}}</td>
                    <td>{{$v->nPlazas}}</td>
                    <td>{{$v->pPersona}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>