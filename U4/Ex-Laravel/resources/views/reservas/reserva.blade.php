<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reserva</title>
</head>
<body>

    <h1>Crear Reserva</h1>

    <br><br>
    @if(session("mensaje"))
        <div style="color: red">{{session("mensaje")}}</div>
    @endif

    <form action="{{route("crearReserva")}}" method="post">
        @csrf
        <div>
            <label for="viaje">Viaje</label>
            <select name="viaje" id="viaje">
                @foreach ($viajes as $v)
                    <option value="{{$v->id}}">{{$v->TituloViaje}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="{{date('Y-m-d')}}">
        </div>

        <div>
            <label for="nombre">Cliente</label>
            <input type="text" name="nombre" id="nombre">
        </div>

        <div>
            <label for="nPersonas">Nº de Personas</label>
            <input type="number" name="nPersonas" id="nPersonas" value="1">
        </div>

        <button type="submit">Crear</button>
        <button><a href="{{route("verViajes")}}">Cancelar</a></button>
    </form>
    
</body>
</html>