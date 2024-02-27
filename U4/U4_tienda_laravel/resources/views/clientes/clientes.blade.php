@extends('plantillas/plantilla')

@section('titulo', 'CLIENTES')

@section('contenido')
<table class="table table-striped">

  <div class="d-flex justify-content-center m-3">
      {{-- <a href="{{route('crearC')}}" class="btn btn-primary p-2">[+] Añadir Cliente</a> --}}
  </div>

  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Email</th>
      <th scope="col">Nombre</th>
      <th scope="col">Telefono</th>
      <th scope="col">Direccion</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>

  <tbody>
      @foreach ($clientes as $c)
         <tr>
            <td scope="row">{{$c->id}}</td>
            <td>{{$c->usuario->email}}</td>
            <td>{{$c->usuario->name}}</td>
            <td>{{$c->telefono}}</td>
            <td>{{$c->direccion}}</td>
            <td>
              <div style="display: flex; gap: 10px;">
                <a href="{{route('modificarC', $c->id)}}" class="btn btn-success p-2">Modificar</a>
                <form action="{{route('borrarC',$c->id)}}" method="POST">
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