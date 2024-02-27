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
            <th scope="col">Cantidad</th>
            <th scope="col">Imagen</th>
            <th></th>
          </tr>
        </thead>
    
        <tbody>
            @foreach (session('carrito') as $pc)
               <tr>
                   <form action="{{route('aCarrito')}}" method="POST">
                     @csrf
                    <td scope="row">{{$pc['producto']->id}}</td>
                    <td>{{$pc['producto']->nombre}}</td>
                    <td>{{$pc['producto']->descripcion}}</td>
                    <td>{{$pc['producto']->precio}}</td>
                    <td><input class="form-control" type="number" name="cantidad" size="5" value="{{$pc['cantidad']}}"></td>
                    <td><img src="{{asset('storage/'.$pc['producto']->img)}}" width="50px" height="50px"></td>
                    <td>
                        <button type="submit" class="btn btn-outline-info p-2" name="modificarPC" 
                        value="{{$pc['producto']->id}}">Modificar</button>
                        <button type="submit" class="btn btn-outline-danger p-2" name="borrarPC" 
                        value="{{$pc['producto']->id}}">Borrar</button>
                    </form>
                  </td>
               </tr> 
            @endforeach
        </tbody>
      </table>

      <form action="{{route('crearPedido')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Crear Pedido</button>
      </form>
    @endsection