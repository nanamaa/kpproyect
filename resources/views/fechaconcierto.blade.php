<table class="table table-hover">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Artista</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($artistas as $artista)
            <tr>
                <td>{{ $artista->fecha }}</td>
                <td>{{ $artista->nombre }}</td>
            </tr>
        @endforeach
    </tbody>
</table>