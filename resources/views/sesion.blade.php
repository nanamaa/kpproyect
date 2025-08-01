<html>
<head>
<link href="{!! asset('css/bootstrap.css') !!}" rel="stylesheet" />
<link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">  </script>
</head>
<body><center>

    INICIO DE SESIÓN<br>
    <form action =  "{{route('verificar')}}" method= "POST">
    {{ csrf_field() }}
    <table> 
        <tr><td>INGRESE SU CORREO</td>
            <td><input type='text' class="form-control" name = 'correo'></td>
         </tr>
         <tr><td>INGRESE SU CONTRASEÑA</td>
            <td><input type='text' class="form-control" name = 'contra'></td>
         </tr>
         <tr><td colspan = 2>
            <input type = 'submit' class="btn btn-success" value = 'LOG IN'></td>           
         </tr>
  
</form>
    <tr><td colspan = 2>
     @if (Session::has('mensaje'))    
        <div class="alert alert-dismissible alert-warning">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h6 class="alert-heading">Error</h6>
        <p class="mb-0">{{ Session::get('mensaje') }}</p>
        </div>
    @endif
</tr>
    <table>

</center>

</body>
</html>