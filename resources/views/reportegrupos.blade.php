@extends ('tema')

@section('corresponde')
    <h1>REPORTE DE GRUPOS REGISTRADOS</h1>
        <a href="{{route('formulario')}}">
            <center><button type="button" class="btn btn-success">REGISTRAR NUEVO GRUPO</button></center>
        </a>
        @if(Session::has('mensaje'))
            <div>
            <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">{{Session::get('mensaje')}}</h4>
            <p class="mb-0"></a></p>
            </div>
            </div>
            @endif

        <table class="table table-hover" border=1>
            <tr>
                <td>Foto</td>
                <td>Nombre</td>
                <td>Cantidad de integrantes</td>
                <td>Direccion de empresa</td>
                <td>Empresa que pertenece</td>
            </tr>
            @foreach($consulta as $c)
            <tr>
            <td><img src = "{{asset('archivos/'.$c->foto)}}" height =50 width=50></td>               
                <td>{{$c->gru}}</td>
                <td>{{$c->numintegrantes}}</td>
                <td>{{$c->direccion}}</td>
                <td>{{$c->e}}</td>
                <td>
                @if(Session::get('sesiontipo')=='Administrador')
                    <a href="{{ route('modificarban', ['idb' => $c->idb])  }}">
                    <button type="button" class="btn btn-warning">Modificar</button>
                    </a>
                    <a href="{{ route('eliminabanda', ['idb' => $c->idb]) }}" onclick="return confirm('¿Estás seguro de que deseas eliminar esta banda?');">
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </td>
                @endif
            </tr>
            @endforeach
        </table>
@stop