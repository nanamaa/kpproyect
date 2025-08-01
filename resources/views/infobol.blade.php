<div class="card" id="boleto-info" data-costo="{{ $boleto->costo }}">
    <div class="card-header">
        <strong>Información del Boleto</strong>
    </div>
    <div class="card-body">
        <p><strong>Tipo:</strong> {{ $boleto->tipo }}</p>
        <p><strong>Costo:</strong> ${{ number_format($boleto->costo, 2) }}</p>
        <p><strong>Disponibilidad:</strong> {{ ucfirst($boleto->disponibilidad) }}</p>

        @if(strtolower($boleto->disponibilidad) === 'agotado')
            <div class="alert alert-danger mt-3">
                <strong>¡Boleto agotado!</strong> Por favor, elija otro tipo de boleto.
            </div>
        @endif
    </div>
</div>







