<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra finalizada - Jeap Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400;500;600;700&family=Krona+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Checkout.css') }}">
</head>
<body class="confirmation-body">
    <main class="confirmation-page">
        <div class="success-icon" aria-hidden="true">✓</div>
        <h1>¡Gracias por tu compra!</h1>
        <p class="confirmation-message">Tu pedido <strong>{{ $pedido->codigo }}</strong> está confirmado.<br>Guarda este código para consultar los detalles de tu compra.</p>

        <section class="confirmation-summary" aria-labelledby="confirmation-summary-title">
            <h2 id="confirmation-summary-title">Resumen del pedido</h2>
            <div class="confirmation-items">
                @foreach($items as $item)
                    <article class="confirmation-item">
                        <img src="{{ asset('imagenes/' . $item->imagen_producto) }}" alt="{{ $item->nombre_producto }}">
                        <div><h3>{{ $item->nombre_producto }}</h3><p>Cantidad: {{ $item->cantidad }}</p></div>
                        <strong>S/ {{ number_format($item->subtotal, 2) }}</strong>
                    </article>
                @endforeach
            </div>
            <div class="confirmation-totals">
                <div><span>Subtotal</span><span>S/ {{ number_format($pedido->subtotal, 2) }}</span></div>
                <div><span>Envío estándar</span><span>Gratis</span></div>
                <div class="confirmation-total"><strong>Total</strong><strong>S/ {{ number_format($pedido->total, 2) }}</strong></div>
            </div>
        </section>
        <a class="continue-shopping" href="{{ route('home') }}">Seguir comprando</a>
    </main>
</body>
</html>
