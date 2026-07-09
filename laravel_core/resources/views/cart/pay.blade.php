<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito - Dibujito</title>
    <meta name="description" content="Revisa y confirma los productos de tu carrito antes de continuar con el pago.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=AR+One+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Pagar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutorial-pedido.css') }}">
</head>
<body data-tutorial-page="review" data-authenticated="true">
    <div class="bg-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <header id="main-header">
        <div class="header-inner">
            <a href="{{ route('home') }}" class="back-link" id="btn-seguir-comprando">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                Seguir comprando
            </a>

            <a href="{{ route('home') }}" class="logo-link" id="logo-home">
                <img src="{{ asset('iconos/image 2.png') }}" alt="Dibujito logo" class="header-logo">
            </a>

            <div class="header-steps">
                <span class="step active">Carrito</span>
                <span class="step-dot"></span>
                <span class="step">Pago</span>
                <span class="step-dot"></span>
                <span class="step">Confirmacion</span>
            </div>
        </div>
    </header>

    <main>
        @if(session('checkout_error'))
            <p class="checkout-alert" role="alert">{{ session('checkout_error') }}</p>
        @endif
        <div class="page-title-wrap">
            <h1 class="page-title">Mi Carrito</h1>
            <span class="cart-badge" id="cart-count">{{ count($cartItems) }} productos</span>
        </div>

        <div id="principal_container">
            <section id="container_productos_carrito" aria-label="Productos en el carrito">
                <div id="columnas">
                    <span>Producto</span>
                    <span>Precio</span>
                    <span>Cantidad</span>
                    <span>Total</span>
                </div>

                <div id="containers_productos">
                    @forelse($cartItems as $row)
                        @php $subtotal = $row['precio'] * $row['cantidad']; @endphp
                        <div class="container_producto" data-precio="{{ $row['precio'] }}" data-cantidad="{{ $row['cantidad'] }}">
                            <div class="name_producto">
                                <div class="img-wrap">
                                    <img src="{{ asset('imagenes/' . $row['imagen']) }}" alt="{{ $row['nombre'] }}" class="product-img">
                                </div>
                                <span class="product-name">{{ $row['nombre'] }}</span>
                            </div>

                            <div class="cell-precio">
                                <span class="precio-producto" data-precio="{{ $row['precio'] }}">S/ {{ number_format($row['precio'], 2) }}</span>
                            </div>

                            <div class="cell-cantidad">
                                <span class="cantidad-producto" data-cantidad="{{ $row['cantidad'] }}">{{ $row['cantidad'] }}</span>
                            </div>

                            <div class="cell-total">
                                <span class="subtotal-producto">S/ {{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="container_producto">
                            <span class="product-name">Tu carrito esta vacio.</span>
                        </div>
                    @endforelse
                </div>
            </section>

            <aside id="container_detalles_pagar" aria-label="Resumen de pago">
                <div class="panel coupon-panel">
                    <div class="panel-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                        <span>Tienes un cupon?</span>
                    </div>
                    <p class="coupon-hint">Si no ves el precio con descuento al aplicar el cupon, lo veras al seleccionar el metodo de pago.</p>
                    <div class="coupon-input-wrap">
                        <input type="text" id="input-cupon" placeholder="Ingresa tu codigo" class="coupon-input">
                        <button class="btn-apply" id="btn-aplicar-cupon" type="button">Aplicar</button>
                    </div>
                </div>

                <div class="panel summary-panel">
                    <h2 class="summary-title">Resumen del pedido</h2>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="resumen-subtotal">S/ {{ number_format($totalGeneral, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Descuentos</span>
                        <span id="resumen-descuento" class="discount-val">- S/ 0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Envio</span>
                        <span class="free-shipping">Gratis</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row total-row">
                        <span>Total</span>
                        <span id="resumen-total">S/ {{ number_format($totalGeneral, 2) }}</span>
                    </div>
                </div>

                <div id="container_button">
                    @if(!empty($cartItems))
                    <a class="btn-continuar" id="btn-continuar" href="{{ route('cart.checkout') }}">
                        Continuar con el pago
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                    @else
                    <button class="btn-continuar" type="button" disabled>Continuar con el pago</button>
                    @endif
                    <p class="secure-note">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        Pago 100% seguro y encriptado
                    </p>
                </div>
            </aside>
        </div>
    </main>

    <script src="{{ asset('js/pagar.js') }}"></script>
    <script src="{{ asset('js/tutorial-pedido.js') }}"></script>
</body>
</html>
