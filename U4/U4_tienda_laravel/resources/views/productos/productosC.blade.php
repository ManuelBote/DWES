@extends('plantillas/plantilla')

@section('titulo', 'PRODUCTOS')

@section('contenido')
<table class="table table-striped">

    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Precio</th>
        <th scope="col">Stock</th>
        <th scope="col">Imagen</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
        @foreach ($productos as $p)
           <tr>
              <td scope="row">{{$p->id}}</td>
              <td>{{$p->nombre}}</td>
              <td>{{$p->descripcion}}</td>
              <td>{{$p->precio}}</td>
              <td>{{$p->stock}}</td>
              <td><img src="{{asset('storage/'.$p->img)}}" width="50px" height="50px"></td>
              <td>
                <form action="{{route('aCarrito')}}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-success p-2" name="carrito" value="{{$p->id}}">Añadir al carrito</button>
                </form>
              </td>
           </tr> 
        @endforeach
    </tbody>
  </table>
@endsection