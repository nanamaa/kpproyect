<html>

<head>
        <link href="{!! asset('css/bootstrap.css')!!}" rel="stylesheet"/>
        <link href="{!! asset('css/bootstrap.min.css')!!}" rel="stylesheet"/>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js">  </script>
</head>
    <body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ORGANIZADORA CONCIERTOS "MCG del REY"</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('inicio') }}">Inicio
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Catalogos</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Grupos</a>
            <a class="dropdown-item" href="{{route('form1')}}">Conseguir boletos</a>
            <a class="dropdown-item" href="#">Noticias</a>
            
        </li>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Consultas</a>
          <div class="dropdown-menu">
            
            <a class="dropdown-item" href="{{ route('formulario') }}">Alta de grupos</a>
            <a class="dropdown-item" href="{{ route('reportegrupo') }}">Reporte de grupos</a>
            <a class="dropdown-item" href="{{ route('reporteboletos') }}">Reporte de boletos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cerrarsesion') }}">Cerrar sesion</a>
      </ul>
      @if (Session::has('sesionname'))
      <div>HAS INICIADO SESIÓN
        <br> {{ Session::get('sesionname')}}
      <br>
      {{Session::get('sesiontipo')}}</div>
       @endif
    </div>
  </div>
</nav>
</body>
</html>

@yield('corresponde')


<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Derechos reservados</h5>
      <small>MCG pop</small>
    </div> 
  </a>
</div>
</body>
</html>