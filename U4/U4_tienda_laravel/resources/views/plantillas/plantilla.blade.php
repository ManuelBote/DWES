<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-
    rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</head>
<body>
    <header>
      <div style="display: flex; align-items: center; gap: 20px; justify-content: space-between;">
        <div  style="display: flex; align-items: center; gap: 20px;">
          <img src="{{asset('img/icono.png')}}" alt="Icono de la pagina">
          <h1>@yield('titulo')</h1>
        </div>
        <div  style="display: flex; align-items: center; gap: 20px; margin-right:10px">
          @if(session('carrito')!=null)
            <h3>
             <a href="{{route('verCarrito')}}">Carrito: {{sizeof(session('carrito'))}}</a> 
            </h3>
          @endif
          <h3>{{Auth::user()->name}}</h3>
          <a href="{{route('salir')}}" class="btn btn-outline-secondary">Cerrar sesion</a>
        </div>
      </div>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Tienda</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('productos')}}">Productos</a>
                  </li>

                  @if (Auth::user()->tipo=='A')
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('clientes')}}">Clientes</a>
                  </li>
                  @endif
                  
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('pedidos')}}">Pedidos</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                  </li>
              </div>
            </div>
          </nav>
    </header>

    <!-- Mensaje -->
    <section>
        <div class="container">
        <!-- Comprobar si hay mensaje en la variable de session -->
          @if(session('mensaje'))
            <h3 class="text-danger text-center">{{session('mensaje')}}</h3>
          @endif

          {{-- @if ($errors->any())
            <ul>
              @foreach($errors->all() as $e)
                <li class="text-danger">{{$e}}</li>
              @endforeach
            </ul>
          @endif --}}
          
        </div>
    </section>

    {{-- Contenido --}}
    <section>
        <div class="container">
            @yield('contenido')
        </div>
    </section>
</body>
</html>