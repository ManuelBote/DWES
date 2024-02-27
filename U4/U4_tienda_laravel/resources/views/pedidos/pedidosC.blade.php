@extends('plantillas/plantilla')

@section('titulo', 'PEDIDOS DE '. Auth::user()->name)

@section('contenido')
<table class="table table-striped">

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