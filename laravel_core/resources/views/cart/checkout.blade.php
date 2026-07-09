<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pago seguro - Jeap Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400;500;600;700&family=Krona+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutorial-pedido.css') }}">
</head>
<body data-tutorial-page="payment" data-authenticated="true">
    <header class="payment-header">
        <div class="payment-header-inner">
            <a href="{{ route('home') }}" class="payment-back-link"><span aria-hidden="true">‹</span> Seguir comprando</a>
            <a href="{{ route('home') }}" class="payment-logo-link"><img src="{{ asset('iconos/image 2.png') }}" alt="JEAP" class="payment-logo"></a>
            <nav class="payment-progress" aria-label="Progreso de compra">
                <span>Carrito</span><i aria-hidden="true"></i><span class="active">Pago</span><i aria-hidden="true"></i><span>Confirmación</span>
            </nav>
        </div>
    </header>

    <main class="checkout-page">
        <ol class="checkout-steps" aria-label="Progreso de compra">
            <li class="completed"><span>✓</span>Carrito</li>
            <li class="active"><span>2</span>Pago</li>
            <li><span>3</span>Confirmación</li>
        </ol>

        <div class="checkout-grid">
            <section class="payment-section" aria-labelledby="payment-title">
                <h1 id="payment-title">Método de pago</h1>
                <div class="payment-card">
                    <div class="method-selected">
                        <span class="method-dot"></span>
                        <strong>Tarjeta de Crédito / Débito</strong>
                        <span class="card-icon">▰</span>
                    </div>

                    <form id="payment-form" novalidate>
                        <div class="field-group full-width">
                            <label for="card-name">Nombre en la tarjeta</label>
                            <input id="card-name" type="text" autocomplete="cc-name" placeholder="Ej. Juan Pérez" maxlength="80">
                            <small class="field-error" id="card-name-error"></small>
                        </div>
                        <div class="field-group full-width">
                            <label for="card-number">Número de tarjeta</label>
                            <input id="card-number" type="text" inputmode="numeric" autocomplete="cc-number" placeholder="0000 0000 0000 0000" maxlength="23">
                            <small class="field-error" id="card-number-error"></small>
                        </div>
                        <div class="field-row">
                            <div class="field-group">
                                <label for="card-expiry">Fecha de expiración</label>
                                <input id="card-expiry" type="text" inputmode="numeric" autocomplete="cc-exp" placeholder="MM/AA" maxlength="5">
                                <small class="field-error" id="card-expiry-error"></small>
                            </div>
                            <div class="field-group">
                                <label for="card-cvv">Código de seguridad (CVV)</label>
                                <input id="card-cvv" type="password" inputmode="numeric" autocomplete="cc-csc" placeholder="123" maxlength="4">
                                <small class="field-error" id="card-cvv-error"></small>
                            </div>
                        </div>
                        <p class="payment-disclaimer">Los datos de tu tarjeta se validan solo en este navegador y no se almacenan.</p>
                    </form>
                </div>
            </section>

            <aside class="order-summary" aria-labelledby="summary-title">
                <h2 id="summary-title">Resumen del pedido</h2>
                <div class="summary-row"><span>Subtotal ({{ count($cartItems) }} {{ count($cartItems) === 1 ? 'artículo' : 'artículos' }})</span><strong>S/ {{ number_format($totalGeneral, 2) }}</strong></div>
                <div class="summary-row"><span>Envío</span><strong>Gratis</strong></div>
                <div class="summary-divider"></div>
                <div class="summary-total"><span>Total</span><strong>S/ {{ number_format($totalGeneral, 2) }}</strong></div>
                <button id="pay-button" class="pay-button" type="submit" form="payment-form" disabled>🔒 Pagar S/ {{ number_format($totalGeneral, 2) }}</button>
                <p class="secure-copy">Tu información se procesa de forma segura. Al confirmar, aceptas nuestros términos y condiciones.</p>
            </aside>
        </div>
    </main>
    <script src="{{ asset('js/checkout.js') }}"></script>
    <script src="{{ asset('js/tutorial-pedido.js') }}"></script>
</body>
</html>
