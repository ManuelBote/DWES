@extends('plantillas/plantilla')

@section('titulo', 'PRODUCTOS')

@section('contenido')
<table class="table table-striped">

    <div class="d-flex justify-content-center m-3">
        <a href="{{route('crearP')}}" class="btn btn-primary p-2">[+] Añadir Producto</a>
    </div>

    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Precio</th>
        <th scope="col">Stock</th>
        <th scope="col">Imagen</th>
        <th scope="col">Acciones</th>
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
                <div style="display: flex; gap: 10px;">
                  <a href="{{route('modificarP', $p->id)}}" class="btn btn-success p-2">Modificar</a>
                  <form action="{{route('borrarP',$p->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger p-2">Borrar</button>
                  </form>
                </div>
              </td>
           </tr> 
        @endforeach
    </tbody>
  </table>
@endsection