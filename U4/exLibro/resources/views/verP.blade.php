<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Prestamos</h1>
    <button>
        <a href="{{route('rutaCrear')}}" style="text-decoration: none;">Nuevo</a>
    </button>
    <br><br>

    <table border="1px">
        <tr>
            <th>Id</th>
            <th>Fecha de prestamo</th>
            <th>Titulo Libro</th>
            <th>Cliente</th>
            <th>Fecha devolucion</th>
            <th>Acciones</th>
        </tr>

        @foreach ($prestamos as $p)
            <tr>
                <td>{{$p->id}}</td>
                <th>{{date('d/m/Y',strtotime($p->fecha))}}</th>
                <td>{{$p->libro->titulo}}</td>
                <td>{{$p->nombreCliente}}</td>
                <td>{{$p->fechaDevolucion}}</td>
                <td><a href="{{route('rutaModificar', $p->id)}}">Modificar</a></td>
            </tr>   
        @endforeach
        
    </table>
</body>
</html>