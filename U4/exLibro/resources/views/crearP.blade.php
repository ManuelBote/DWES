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
   <form action="{{route('rutaInsertar')}}" method="post"> 
    @csrf

    <label for="fecha">Fecha</label><br>
    @if(old('fecha')!=null)
        <input type="date" name="fecha" value="{{old('fecha')}}">
    @else
        <input type="date" name="fecha" value="{{date('Y-m-d')}}">
    @endif
    @error('fecha')
        <div>Rellena fecha</div>
    @enderror
    <br><br>

    <label for="libro">Libro</label><br>
    <select name="libro" id="libro">
        @foreach ($libros as $l)
            @if(old('libro')!=null && old('libro')==$l->id)
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
    <input type="text" name="cliente" value="{{old('cliente')}}">
    @error('cliente')
        <div>Rellena cliente</div>
    @enderror
    <br><br>

    <button type="submit">Crear</button>
    <button type="reset">Limpiar</button>
   </form>

   <div style="color:red;">
    @if (session('mensaje')!=null)
        {{session('mensaje')}}        
    @endif
   </div>
</body>
</html>