@if(empty($cartItems))
    <p>Tu carrito esta vacio.</p>
@else
    <div id="container_padre">
        @foreach($cartItems as $item)
            <div class="item-carrito">
                <div class="box_primary">
                    <img src="{{ asset('imagenes/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}">
                    <div class="info-producto">
                        <span>{{ $item['nombre'] }}</span>
                        <span class="precio-producto" data-precio="{{ number_format($item['precio'], 2, '.', '') }}">
                            S/ {{ number_format($item['precio'], 2) }}
                        </span>
                    </div>
                </div>

                <div class="acciones-producto">
                    <input class="cantidad-producto" type="number" min="1" value="{{ $item['cantidad'] }}" data-id="{{ $item['id'] }}">
                    <button class="btn-eliminar-producto" data-id="{{ $item['id'] }}" type="button">Eliminar</button>
                </div>
            </div>
        @endforeach
    </div>
@endif
