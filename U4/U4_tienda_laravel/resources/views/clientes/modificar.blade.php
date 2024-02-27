@extends('plantillas/plantilla')

@section('titulo', 'MODIFICAR CLIENTES ID:'.$c->id)

@section('contenido')

  <form action="{{route('actualizarC', $c->id)}}" method="post" enctype="multipart-form-data">
    @csrf
    @METHOD("PUT")
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" id="email" name="email" value="{{$c->usuario->email}}" placeholder="Email">
      @error('email')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="{{$c->usuario->name}}" placeholder="Nombre">
      @error('nombre')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="telefono" class="form-label">Telefono</label>
      <input type="text" class="form-control" id="telefono" name="telefono" value="{{$c->telefono}}" placeholder="Telefono">
      @error('telefono')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="direccion" class="form-label">Direccion</label>
      <input type="text" class="form-control" id="direccion" name="direccion" value="{{$c->direccion}}" placeholder="Direccion">
      @error('direccion')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-success">Modificar</button>
    <a href="{{route('clientes')}}" class="btn btn-danger">Cancelar</a>
  </form>

@endsection