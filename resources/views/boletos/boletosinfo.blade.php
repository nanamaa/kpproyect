<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".opcion").click(function() {
            let opcion = this.value; // Obtener el valor seleccionado correctamente
            // Cargar la vista de tiposboletos en el div con id="tipoBoletoContainer"
            $("#tipoBoletoContainer").load('{{ route('tiposboletos') }}' + '?opcion=' + opcion);
        });

    });
</script>

<center><h1>FECHAS DISPONIBLES</h1></center>

    <label><strong>FECHAS DISPONIBLES</strong></label><br>
    <select name="fechaconcierto" id="fechaconcierto">
            @foreach($fechaconci as $c)
            <option value="{{ $c->idcinf }}">{{ $c->fechas }}</option>
            @endforeach
    </select>
    <br><br>

    <label><strong>UBICACIÓN</strong></label><br>
    <input type="text" name="ubicacion" value="{{ $conciertos->ubicacion }}" readonly>
    <br><br>

    <label><strong>TOTAL DE ASIENTOS LIBRES</strong></label><br>
    <input type="text" name="asientos" value="{{ $conciertos->total_asientos }} libres" readonly>
    <br><br>

    <label><strong>CONFIRMAR FECHA</strong></label><br>
    <label><input type="radio" name="confirmar" class="opcion" value="si"> SI</label>
    <label><input type="radio" name="confirmar" class="opcion" value="no"> NO</label>


    
    <!-- Div donde se insertará la vista de tipos de boletos -->
    <div id='tipoBoletoContainer'></div>

