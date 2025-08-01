<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .contenedor {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            padding: 20px;
        }

        .formulario {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .promocion {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .promocion label {
            font-weight: bold;
        }

        #proprecio {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #d9534f;
        }
    </style>
</head>
<body>


<div class="contenedor">
    <div class="formulario">
        <h3>TIPOS DE PROMOCIONES</h3>

        <div id="promociones">
            <strong>PROMOCIONES</strong>
            <br><br>

            @if($opc == 1)
                <div class="promocion">
                    <input type="radio" name="promocion" value="1"> 
                    <label>Promoción VIP 1</label>
                </div>
                <p>Paquete de dos playeras del artista y un vaso coleccionable</p>

                <div class="promocion">
                    <input type="radio" name="promocion" value="2"> 
                    <label>Promoción VIP 2</label>
                </div>
                <p>Entrada al soundcheck y firma de autógrafos</p>

                <div class="promocion">
                    <input type="radio" name="promocion" value="3"> 
                    <label>Promoción VIP 3</label>
                </div>
                <p>Permiso de entrar temprano al concierto</p>

            @elseif($opc == 2)
                <div class="promocion">
                    <input type="radio" name="promocion" value="4"> 
                    <label>Promoción PRE 1</label>
                </div>
                <p>Fotografía con el artista</p>

                <div class="promocion">
                    <input type="radio" name="promocion" value="5"> 
                    <label>Promoción PRE 2</label>
                </div>
                <p>Un descuento para el próximo concierto del artista</p>

                <div class="promocion">
                    <input type="radio" name="promocion" value="6"> 
                    <label>Promoción PRE 3</label>
                </div>
                <p>Stickers coleccionables e irrepetibles</p>

            @elseif($opc == 3)
                <div class="promocion">
                    <input type="radio" name="promocion" value="6"> 
                    <label>Promoción BASIC 1</label>
                </div>
                <p>+10 puntos para cliente básico</p>

                <div class="promocion">
                    <input type="radio" name="promocion" value="7"> 
                    <label>Promoción BASIC 2</label>
                </div>
                <p>+15 puntos para convertirse en cliente premium</p>

                <div class="promocion">
                    <input type="radio" name="promocion" value="8"> 
                    <label>Promoción BASIC 3</label>
                </div>
                <p>Paquete de llaveros coleccionables</p>
            @endif

            <div id="proprecio"></div>

            <br>
            <label for="id_asientos">ELIJA SU ASIENTO:</label>
            <select class="form-label mt-4" name="id_asientos">
                @foreach($asientos as $a)
                    <option value="{{ $a->id_asientos }}">{{ $a->fila . '-' . $a->areaa }}</option>
                @endforeach
            </select>

            <tr>
                <td align='right' colspan=2>
                <input type='button' class="btn btn-warning" name='registrar' id = 'registrar' value='CONFIRMAR'></td>
            </tr>
        </div>
    </div>
</div>

<div id = 'carri'></div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("input[name='promocion']").change(function () {
            var promoSeleccionada = $(this).val();
            $.get("{{ route('promocionesprecio') }}", { promo: promoSeleccionada }, function (data) {
                $("#proprecio").html("<strong>Precio: $" + data.pre + "</strong>");
            });
        });


        $("#registrar").click(function() {
        $("#carri").load('{{url('registracarrito')}}' + '?' + $(this).closest('form').serialize()) ;
    });



    });
</script>
</body>
</html>
