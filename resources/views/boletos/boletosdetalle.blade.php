<div id="tabla-principal">
    <table border=1>
    <tr>
        <td>
        <tr>
                    <td width=150>TURNO</td>
                    <td width=170>BOLETO</td>
                    <td width=190>CANTIDAD</td>
                    <td width=210>PROMOCION</td>
                    <td width=200>AGREGAR MÁS ASIENTOS</td>
                    
                </tr>
       @foreach ($consultaventas as $cv)
       <tr>
        <td>{{$cv->turno}}</td>
        <td>{{$cv->boleto}}</td>
        <td>{{$cv->cantidad}}</td>
        <td>{{$cv->promocion}}</td>
        <td>{{$cv->totalpago}}</td>
        <td>
        <td>
            <form action="#" method="POST" name="frmdo{{ $cv->turno }}" id="frmdo{{ $cv->turno }}">
                @csrf
                <input type="hidden" name="turno" value="{{ $cv->turno }}">
                <input type="button" class="btn btn-warning agregar-btn" data-turno="{{ $cv->turno }}" value="AGREGAR">
            </form>
        </td>
        </tr>     
        @endforeach
        </table>

</div>


<div id='masasientos'></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".agregar-btn").click(function () {
            const form = $(this).closest('form');
            $("#masasientos").load('{{ route("agregarasientos") }}' + '?' + form.serialize());
        });
    });
</script>