<form id="asientos">    
<div>
        <label for="idbol">TIPO DE BOLETO</label><br>
        <select class="form-label mt-4" name="idbol" >
            @foreach ($boletos as $b)
                <option value="{{ $b->idbol }}">{{ $b->tipo . '-' . '$' . $b->costo }}</option>
            @endforeach
        </select><br><br>

        <label>CANTIDAD (máx 3)</label><br>
        <input type="number" name="cantidad" id="cantidad" min="1" max="3"><br><br>
        
        <label><strong>FECHAS DISPONIBLES</strong></label><br>
            <select name="fechaconcierto" id="fechaconcierto">
                    @foreach($fechaconci as $c)
                    <option value="{{ $c->idcinf }}">{{ $c->fechas . '-' . $c->nombre}}</option>
                    @endforeach
            </select>
            <br><br>
       
            <input type='button' class="btn btn-warning añadir-btn" value='AÑADIR'>

</div>
</form>

<div id = 'asiento'></div>
<div id="mensaje" style="margin-top: 10px;"></div>

<script>
    $(document).ready(function () {
        $(".añadir-btn").click(function () {
            const form = $(this).closest("form");
            const datos = form.serialize();

            $.ajax({
                url: '{{ route("guardanuevoasiento") }}',
                type: 'POST',
                data: datos,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Actualiza la tabla principal con la respuesta
                    $("#tabla-principal").html(response);

                    // Muestra mensaje de éxito
                    $("#mensaje")
                        .html("<div class='alert alert-success'>✅ ¡Asiento agregado con éxito!</div>")
                        .fadeIn()
                        .delay(3000)
                        .fadeOut();

                    
                },
                error: function (xhr) {
                    $("#mensaje")
                        .html("<div class='alert alert-danger'>❌ Ocurrió un error al agregar el asiento.</div>")
                        .fadeIn()
                        .delay(4000)
                        .fadeOut();
                }
            });
        });
    });
</script>



