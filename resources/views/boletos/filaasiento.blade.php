@foreach($nuevoAsiento as $n)
    <tr>
        <td>{{ $n->turno }}</td>
        <td>{{ $n->boleto }}</td>
        <td>{{ $n->cantidad }}</td>
        
        <td>
        </td>
    </tr>
    @endforeach
</table>