@extends('plantillas/plantilla')

@section('titulo', 'PEDIDOS')

@section('contenido')
<table class="table table-striped">

    <div class="d-flex justify-content-center m-3">
        <a href="{{route('crearP')}}" class="btn btn-primary p-2">[+] Añadir Producto</a>
    </div>

    <thead class="table-dark">
      <tr>
        <th scope="col">ID</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($pedidos as $p)
           <tr>
              <td scope="row">{{$p->id}}</td>
          
           </tr> 
        @endforeach
    </tbody>
  </table>
@endsection