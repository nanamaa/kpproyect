<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#opc").change(function() {
        let valor = $(this).val();
        $("#boletos").load('{{route('preciosboletos')}}'+'?opc='+valor);
        $("#promociones").load('{{route('cargapromociones')}}'+'?opc='+valor);
    });

    });
</script>

<tr>
    <td><strong>TIPO DE BOLETO</strong></td>
</tr>
<tr>
    <td>
        <select name="idbol" id='opc'>
        <option value="">Seleccione su boleto</option> 
            @foreach($boletos as $b)
                <option value="{{ $b->idbol }}">{{ $b->tipo }}</option>
            @endforeach
        </select>
    </td>
</tr>
<div id='boletos'></div>

    <td><strong>CANTIDAD</strong></td>
    <td><input type= 'text' name = 'cantidad' class="form-control" value="{{old('cantidad')}}" placeholder='Máx 5'></td>
</tr>


<div id='promociones'></div>