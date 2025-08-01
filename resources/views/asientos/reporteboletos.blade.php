@extends('tema')

@section('corresponde')

<h1>REPORTE DE BOLETOS</h1>
<table class="table table-striped table-bordered table-hover">
    <thead class="bg-primary text-white">
        <tr>
            <th width="150">TURNO</th>
            <th width="170">FECHA SOLICITUD</th>
            <th width="190">BANDA</th>
            <th width="210">FECHA CONCIERTO</th>
            <th width="200">UBICACION</th>
            <th width="200">TIPO BOLETO</th>
            <th width="200">PROMOCION</th>
            <th width="200">TOTAL ASIENTOS</th>
            <th width="200">ASIENTOS</th>
            <th width="200">AREA</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reportetotal as $cv)
        <tr>
            <td>{{$cv->turno}}</td>
            <td>{{$cv->fechasolicitud}}</td>
            <td>{{$cv->banda}}</td>
            <td>{{$cv->fechaconcierto}}</td>
            <td>{{$cv->ubicacion}}</td>
            <td>{{$cv->tipo}}</td>
            <td>{{$cv->promocion}}</td>
            <td>{{$cv->totalboletos}}</td>
            <td>{{$cv->lugar}}</td>
            <td>{{$cv->areanombre}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
