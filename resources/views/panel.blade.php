@extends('tema')

@section('corresponde')
<script type="text/javascript">
$(document).ready(function() {
    // Manejo del cambio de artista
    $("#ida").change(function() {
        var artistaId = $(this).val();
        if (artistaId) {
            $("#infoart").html('<div class="loading-spinner">Loading...</div>');
            $.ajax({
                url: '{{ url('artistaInfo') }}',
                type: 'GET',
                data: { ida: artistaId },
                success: function(data) {
                    $("#infoart").html(data.infoArtista);
                    
                },
                error: function(error) {
                    $("#infoart").html('<p>Error al cargar la información del artista.</p>');
                    console.error(error);
                }
            });
        } else {
            $("#infoart").fadeOut();
        }
    });

    $("#idb").change(function() {
        var tipoId = $(this).val();
        if (tipoId) {
            $("#infobol").html('<div class="loading-spinner">Cargando información del boleto...</div>');
            $.ajax({
                url: '{{ route('boletosInfo') }}',
                type: 'GET',
                data: { idb: tipoId },
                success: function(data) {
                    $("#infobol").html(data.infobol);

                    // Verificar la disponibilidad
                    var disponibilidad = data.disponibilidad.toLowerCase();
                    if (disponibilidad === 'agotado') {
                        $("#mensajeDisponibilidad").html('<div class="alert alert-danger">Este boleto está agotado. Por favor, elija otro tipo de boleto.</div>');
                        $("#cantidad").prop('disabled', true); // Deshabilitar el campo de cantidad si está agotado
                        $("#total").val(''); // Limpiar el total
                    } else {
                        $("#mensajeDisponibilidad").html('');
                        $("#cantidad").prop('disabled', false); // Habilitar el campo de cantidad si está disponible
                        calcularTotal(); // Calcular el total si está disponible
                    }
                },
                error: function(error) {
                    $("#infobol").html('<p>Error al cargar la información del boleto.</p>');
                    console.error(error);
                }
            });
        } else {
            $("#infobol").fadeOut();
            $("#mensajeDisponibilidad").html('');
            $("#cantidad").prop('disabled', true); // Deshabilitar el campo de cantidad si no hay selección
        }
    });

    // Manejo del cambio en la cantidad
    $("#cantidad").on('input', function() {
        calcularTotal();
    });

    function calcularTotal() {
        var costoTexto = $("#boleto-info").data('costo'); // Obtener el costo del atributo data
        if (typeof costoTexto !== 'string') {
            costoTexto = String(costoTexto); // Convertir a cadena si no es una cadena
        }
        var costo = parseFloat(costoTexto.replace(/[^0-9.-]+/g, "")); // Convertir el texto a número, eliminando cualquier carácter no numérico
        var cantidad = parseInt($("#cantidad").val());

        if (isNaN(costo) || isNaN(cantidad) || cantidad < 1) {
            $("#total").val(''); // Vaciar el campo total si los valores no son válidos
            return;
        }

        var total = costo * cantidad;
        $("#total").val('$' + total.toFixed(2));
    }

    // Filtrado por fecha
    $('#filtrar').click(function(e) {
        e.preventDefault(); // Prevenir comportamiento predeterminado
        var fecha = $('#fecha').val();
        $.ajax({
            url: '{{ route('filtrarfecha') }}',
            type: 'GET',
            data: { fecha: fecha },
            success: function(data) {
                $('#fechaconcierto').html(data);
            },
            error: function(error) {
                console.error('Error al filtrar los datos:', error);
                $('#fechaconcierto').html('<p>Error al cargar los datos.</p>');
            }
        });
    });
    $("#guardar").click(function(event) {
        event.preventDefault();
        $(this).attr('disabled', 'disabled');
        console.log("Guardado");
    })
    
});
</script>

<center><h1>CONCIERTOS - VENTA DE BOLETOS</h1></center>
<form style="max-width: 600px; margin: 0 auto;">
    <table class="table">
        <tr>
            <td>TURNO</td>
            <td><input type='text' name='idven' id="idven" value='{{ $numventa }}' readonly='readonly'></td>
        </tr>
        <tr>
            <td>FECHA</td>
            <td><input type="date" name="fecha" value=""></td>
        </tr>
        <tr>
            <td>ARTISTA</td>
            <td>
                <select name="ida" id="ida">
                    <option value="">Seleccione un artista</option>
                    @foreach($artistas as $artista)
                        <option value="{{ $artista->ida }}">Nombre: {{ $artista->nombre }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="infoart"></div>
            </td>
        </tr>
    </table>

    <div class="form-group">
        <label for="fecha">FECHAS DISPONIBLES</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $fecha ?? '' }}">
        <button type="submit" class="btn btn-primary mt-2" id="filtrar">Filtrar</button>
        <div id="fechaconcierto"></div>
    </div>

    <div class="form-group mt-4">
        <label for="idb">TIPO DE BOLETO</label>
        <select class="form-control" name="idb" id="idb">
            <option value="">Seleccione su boleto</option>
            @foreach($tipo_boletos as $tipo)
                <option value="{{ $tipo->idbol }}">{{ $tipo->tipo }}</option>
            @endforeach
        </select>
    </div>

    <div id="infobol"></div>

    <div class="form-group mt-3">
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" value="1">
    </div>

    <div class="form-group mt-3">
        <label for="total">Total a pagar:</label>
        <input type="text" id="total" class="form-control" readonly>
    </div>
    <div class="form-group mt-4">
        <button type="submit" class="btn btn-success" id="guardar">Proceder compra</button>

    </div>
</form>

@stop

