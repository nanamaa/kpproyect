@extends ('tema')

@section('corresponde')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("#idb").change(function() {
        let idb = $(this).val();
        if (idb) {
            $("#idcinf").load('{{ route('boletosinfo') }}' + '?idb=' + idb);
        } else {
            $("#idcinf").html("");
        }
    });
});
</script>

<center><h1>BIENVENIDO AL SISTEMA DE VENTA DE BOLETOS</h1></center>

<body>
    <form style="max-width: 600px; margin: 0 auto;">
        <table class="table">
            <tr>
                <td>TURNO</td>
                <td><input type="text" name="idven" id="idven" value="{{ $numventa }}" readonly></td>
            </tr>
            <tr>
                <td>FECHA</td>
                <td><input type="date" name="fechahoy" id="fechahoy" value="{{ $fechahoy }}" readonly></td>
            </tr>
            <tr>
                <td>ELIJA SU ARTISTA O EVENTO</td>
                <td>
                    <select name="idb" id="idb">
                        <option value="">Seleccione un artista o evento</option>
                        @foreach($banda as $ba)
                            <option value="{{ $ba->idb }}">{{ $ba->nombre }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id='idcinf'></div>
                </td>
            </tr>
        </table>
    </form>
</body>

@endsection
