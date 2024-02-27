@extends('plantillas/plantilla')

@section('titulo', 'CREAR CLIENTES')

@section('contenido')

  <form action="{{route('insertarCliente')}}" method="post" enctype="multipart-form-data">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
      @error('email')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="{{old('nombre')}}">
      @error('nombre')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="telefono" class="form-label">Telefono</label>
      <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="{{old('telefono')}}">
      @error('telefono')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="direccion" class="form-label">Direccion</label>
      <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="{{old('direccion')}}">
      @error('direccion')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Crear</button>
    <a href="{{route('clientes')}}" class="btn btn-danger">Cancelar</a>
  </form>

@endsection