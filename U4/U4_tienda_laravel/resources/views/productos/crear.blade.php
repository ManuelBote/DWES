@extends('plantillas/plantilla')

@section('titulo', 'CREAR PRODUCTOS')

@section('contenido')

  <form action="{{route('insertarProducto')}}" method="post" enctype="multipart/form-data" class="mt-2">
    @csrf

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="{{old('nombre')}}">
      @error('nombre')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripcion</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" value="{{old('descripcion')}}">
      @error('descripcion')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="precio" class="form-label">Precio</label> 
      <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" step="0.01" value="{{old('precio')}}">
      @error('precio')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{old('stock')}}">
      @error('stock')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen</label>
      <input type="File" class="form-control" name="imagen" id="imagen">
      @error('imagen')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Crear</button>
    <a href="{{route('productos')}}" class="btn btn-danger">Cancelar</a>
  </form>

@endsection