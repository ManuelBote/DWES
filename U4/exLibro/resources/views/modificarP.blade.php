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
   <form action="{{route('rutaActualizar', $p->id)}}" method="post"> 
    @csrf

    <label for="id">Id</label><br>
    <input type="text" name="id" value="{{$p->id}}" disabled="disabled">
    <br><br>

    <label for="fecha">Fecha</label><br>
    <input type="date" name="fecha" value="{{$p->fecha}}">
    @error('fecha')
        <div>Rellena fecha</div>
    @enderror
    <br><br>

    <label for="libro">Libro</label><br>
    <select name="libro" id="libro">
        @foreach ($libros as $l)
            @if($p->libro->id==$l->id)
                <option value="{{$l->id}}" selected="selected">{{$l->titulo}}</option>
            @else
                <option value="{{$l->id}}">{{$l->titulo}}</option>
            @endif
        @endforeach
    </select>
    @error('libro')
        <div>Selecciona libro</div>
    @enderror
    <br><br>

    <label for="nombreCliente">Nombre cliente</label><br>
    <input type="text" name="cliente" value="{{$p->nombreCliente}}">
    @error('cliente')
        <div>Rellena cliente</div>
    @enderror
    <br><br>

    <label for="fechaDevolucion">Fecha Devolucion</label>
    <input type="date" name="fechaD" value="{{$p->fechaDevolucion}}">
    <br><br>

    <button type="submit">Modificar</button>
    <button><a href="{{route('rutaVer')}}">Cancelar</a></button>
   </form>

   <div style="color:red;">
    @if (session('mensaje')!=null)
        {{session('mensaje')}}        
    @endif
   </div>
</body>
</html>