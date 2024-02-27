@extends('plantillas/plantilla')

@section('titulo', 'MODIFICAR PRODUCTO ID:'.$p->id)

@section('contenido')

  <form action="{{route('actualizarP', $p->id)}}" method="post" enctype="multipart/form-data" class="mt-2">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="{{$p->nombre}}" placeholder="nombre">
      @error('nombre')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripcion</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$p->descripcion}}" placeholder="Descripcion">
      @error('descripcion')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="precio" class="form-label">Precio</label> 
      <input type="number" class="form-control" id="precio" name="precio" value="{{$p->precio}}" placeholder="Precio" step="0.01">
      @error('precio')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="text" class="form-control" id="stock" name="stock" value="{{$p->stock}}" placeholder="Stock">
      @error('stock')
        <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen</label>
      <img src="{{asset('storage/'.$p->img)}}" alt="" width="30px" height="30px">
      <input type="File" class="form-control" name="imagen" id="imagen">
    </div>

    <button type="submit" class="btn btn-success">Modificar</button>
    <a href="{{route('productos')}}" class="btn btn-danger">Cancelar</a>
  </form>

@endsection