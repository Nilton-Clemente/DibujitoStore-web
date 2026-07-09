<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jeap Store')</title>

    <!-- CSS Globales -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/VentanaProductos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/VerCarrito.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutorial-pedido.css') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    @yield('styles')
</head>
<body data-tutorial-page="home" data-authenticated="{{ auth()->check() ? 'true' : 'false' }}">

    <div id="overlay"></div>

    <header>
        <nav id="buttons_header">
            <a href="{{ route('home') }}">
                <img id="logo" src="{{ asset('iconos/image 2.png') }}" alt="Logo">
            </a>
            
            <div id="elementos_derecha">
                <div id="container_button_menu">
                    <button>Categorias</button>
                </div>
                
                <div id="Barra_busqueda">
                    <form action="{{ route('products.search') }}" method="GET">
                        <input type="text" name="busqueda" placeholder="Buscar productos...">
                        <button id="Button_buscar" type="submit">
                            <img src="{{ asset('iconos/image 21.png') }}" alt="Buscar">
                        </button>
                    </form>
                </div>
            </div>

            <div id="Box_Button_Otros">
                @auth
                    <a href="#" class="user-greeting-link"><span class="user-greeting">Hola {{ Auth::user()->nombre }}</span></a>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-button"><span>Cerrar Sesion</span></button>
                    </form>

                    <div id="Box_Button_carrito">
                        <img src="{{ asset('iconos/image 20.png') }}" alt="Carrito">
                        <button id="btn-Carrito" type="button">Carrito</button>
                    </div>
                @else
                    <div id="container_button_login">
                        <i class="bi bi-person-fill login-icon"></i>
                        <a href="{{ route('login') }}"><span id="button_iniciar_sesion">Iniciar sesión</span></a>          
                    </div>
                @endauth
            </div>
        </nav>
        
        <div class="container_header_opciones">
            <div id="container_ubicacion">Ubicacion</div>
            <div id="navegation_items">
                <span>Nuevos productos</span>
                <span>Destacados</span>
                <span>Para ti</span>
                <span>Seleccion especial</span>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer-seguro">
        <div class="footer-contenedor">
            <div class="footer-columna">
                <h3>Enlaces</h3>
                <a href="{{ route('home') }}">Inicio</a>
                <a href="#">Productos</a>
                <a href="#">Contacto</a>
            </div>

            <div class="footer-columna">
                <h3>Nosotros</h3>
                <a href="#">Quienes somos</a>
                <a href="#">Misión</a>
                <a href="#">Visión</a>
            </div>

            <div class="footer-columna">
                <h3>Síguenos</h3>
                <div class="footer-redes">
                    <a href="#"><img src="{{ asset('iconos/facebook.png') }}" alt="Facebook"></a>
                    <a href="#"><img src="{{ asset('iconos/instagram.png') }}" alt="Instagram"></a>
                    <a href="#"><img src="{{ asset('iconos/twitter.png') }}" alt="Twitter"></a>
                </div>
            </div>
        </div>
        <p class="footer-copy">© {{ date('Y') }} Jeap - Todos los derechos reservados</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS Globales -->
    <script src="{{ asset('js/carrito.js') }}?v=20260522b"></script>
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script src="{{ asset('js/tutorial-pedido.js') }}"></script>
    @yield('scripts')
</body>
</html>
