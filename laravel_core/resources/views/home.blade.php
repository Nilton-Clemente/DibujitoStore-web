@extends('layouts.app')

@section('title', 'Productos Destacados')

@section('content')
<div id="chatbot_container">
    <i class="bi bi-chat-dots-fill" id="button_chatbot"></i>
</div>

<div id="Box_Principal_Anuncios">
    @forelse ($anuncios as $row)
        <div class="anuncio">
            <img src="{{ asset('imagenes/' . $row->imagen) }}" alt="Anuncio">
        </div>
    @empty
        <p>No hay anuncios activos</p>
    @endforelse
</div>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($promociones as $index => $promo)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @forelse($promociones as $index => $promo)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('imagenes/' . $promo->imagen) }}" class="d-block w-100" alt="Promoción">
            </div>
        @empty
            <p>No hay promociones activas</p>
        @endforelse
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div id="box_principal_productos">
    <div id="titulo_productos">
        <h3>Productos destacados</h3>
    </div>

    <div id="carouselProductos" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php $contador = 0; $total = count($productosDestacados); @endphp
            @foreach($productosDestacados as $prod)
                @if($contador % 6 == 0)
                    <div class='carousel-item {{ $contador == 0 ? "active" : "" }}'>
                        <div id='Contenedor_productos'>
                @endif
                
                <div class="tarjeta_producto">
                    <a href="{{ route('products.show', $prod->id) }}" class="producto-link">
                        <div class="imagen_producto">
                            <img src="{{ asset('imagenes/' . $prod->imagen) }}" alt="{{ $prod->nombre }}">
                        </div>
                        <span class="marca-producto">{{ $prod->marca ? $prod->marca->nombre : 'Sin definir' }}</span>
                        <h2>{{ $prod->nombre }}</h2>
                        
                        <div class="precios-producto">
                            @php
                                $precioOferta = $prod->oferta ? $prod->precio - ($prod->precio * $prod->oferta->porcentaje / 100) : $prod->precio;
                            @endphp
                            @if($prod->precio > $precioOferta)
                                <div class="container_precio_des">
                                    <span class="precio-original">S/ {{ number_format($prod->precio, 2) }}</span>
                                    <span class="number_descuento">-{{ round((($prod->precio - $precioOferta)/$prod->precio)*100) }} %</span>
                                </div>
                            @endif
                            <span class="precio-actual">S/ {{ number_format($precioOferta, 2) }}</span>
                        </div>
                    </a>
                    <div class="container_buttons">
                        <button class="btn-agregar-carrito" data-id="{{ $prod->id }}">Agregar</button>  
                        <img src="{{ asset('iconos/corazon.png') }}">
                    </div>
                </div>

                @php $contador++; @endphp
                @if($contador % 6 == 0 || $contador == $total)
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<div id="box_banners_principales">
    @php $contadorBanner = 1; @endphp
    @foreach($bannersPrincipales as $banner)
        @php
            $redirectUrl = '#';
            $redireccion = (string) ($banner->redireccion ?? '');

            if ($redireccion !== '') {
                if (str_contains($redireccion, 'Producto.php?id=')) {
                    preg_match('/id=(\d+)/', $redireccion, $matches);
                    if (!empty($matches[1])) {
                        $redirectUrl = route('products.show', (int) $matches[1]);
                    }
                } else {
                    $queryString = parse_url($redireccion, PHP_URL_QUERY) ?: ltrim($redireccion, '?');
                    parse_str($queryString, $queryParams);
                    $filteredParams = array_filter([
                        'busqueda' => $queryParams['busqueda'] ?? null,
                        'categoria_id' => $queryParams['categoria_id'] ?? null,
                    ], fn($value) => $value !== null && $value !== '');

                    $redirectUrl = route('products.search', $filteredParams);
                }
            }
        @endphp
        @if($contadorBanner == 1)
            <div class="grupo-2">
        @endif
        
        <div class="{{ $contadorBanner == 3 ? 'large_container' : 'container_banner' }}">
            <a href="{{ $redirectUrl }}" class="producto-link">
                <div class="container_imagen_banner">
                    <img src="{{ asset('imagenes/' . $banner->imagen) }}" alt="{{ $banner->nombre ?? '' }}">
                </div>
            </a>
        </div>
        
        @if($contadorBanner == 2)
            </div>
        @endif
        @php $contadorBanner++; @endphp
    @endforeach
</div>

<div id="Box_Principal_Categorias">
    <div id="Contenedor_Categorias">
        @foreach($categorias as $cat)
            <div class="tarjeta_categoria">
                <div id="imagen_and_text">
                    <img src="{{ asset('imagenes/' . $cat->imagen) }}" alt="{{ $cat->nombre }}">
                    <h4>{{ $cat->nombre }}</h4>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Otros Banners Secundarios -->
<div id="box_banners_secundarios">
    @foreach($bannersSecundarios as $banner)
        @php
            $redirectUrl = '#';
            $redireccion = (string) ($banner->redireccion ?? '');

            if ($redireccion !== '') {
                if (str_contains($redireccion, 'Producto.php?id=')) {
                    preg_match('/id=(\d+)/', $redireccion, $matches);
                    if (!empty($matches[1])) {
                        $redirectUrl = route('products.show', (int) $matches[1]);
                    }
                } else {
                    $queryString = parse_url($redireccion, PHP_URL_QUERY) ?: ltrim($redireccion, '?');
                    parse_str($queryString, $queryParams);
                    $filteredParams = array_filter([
                        'busqueda' => $queryParams['busqueda'] ?? null,
                        'categoria_id' => $queryParams['categoria_id'] ?? null,
                    ], fn($value) => $value !== null && $value !== '');

                    $redirectUrl = route('products.search', $filteredParams);
                }
            }
        @endphp
        <div class="large_container">
            <a href="{{ $redirectUrl }}" class="producto-link">
                <div class="container_imagen_banner">
                    <img src="{{ asset('imagenes/' . $banner->imagen) }}" alt="{{ $banner->nombre ?? '' }}">
                </div>
            </a>
        </div>
    @endforeach
</div>

<!-- Ofertas -->
<div id="Box_Principal_Ofertas">
    <div id="titulo_ofertas">
        <h3>🔥 Ofertas Especiales</h3>
        <p>Aprovecha los mejores descuentos por tiempo limitado</p>
    </div>
    <div id="Contenedor_Ofertas">
        <div class="tarjeta_oferta">
            <div style="position:relative; overflow:hidden;">
                <span class="oferta_banner_label">OFERTA</span>
                <img src="{{ asset('imagenes/imagen oferta.jpg') }}" alt="Oferta" style="width:100%;height:100%;min-height:280px;object-fit:cover;display:block;">
            </div>
            <div class="oferta_productos_grid">
                @foreach($productosOferta as $ofert)
                    @php 
                        $prod = $ofert->producto; 
                        $precioOferta = $prod->precio - ($prod->precio * $ofert->porcentaje / 100);
                    @endphp
                    <div class="tarjeta_producto_oferta">
                        <span class="badge_descuento">-{{ $ofert->porcentaje }}%</span>
                        <img src="{{ asset('imagenes/' . $prod->imagen) }}" alt="{{ $prod->nombre }}">
                        <span class="marca-producto">{{ $prod->marca ? $prod->marca->nombre : 'Sin definir' }}</span>
                        <p class="nombre_oferta">{{ $prod->nombre }}</p>
                        <div class="precios-producto">
                            <span class="precio-original">S/ {{ number_format($prod->precio, 2) }} un</span>
                            <span class="precio-actual">S/ {{ number_format($precioOferta, 2) }} un</span>
                        </div>
                        <div class="container_buttons">
                            <button class="btn-agregar-carrito" data-id="{{ $prod->id }}">Agregar</button>  
                            <img src="{{ asset('iconos/corazon.png') }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Productos Tecnología -->
<div id="contenedor_tecnologia">
    <h3>Productos de Tecnología</h3>
    <div id="productos_tecnologia">
        @foreach($productosTecno as $prod)
            @php
                $precioOferta = $prod->oferta ? $prod->precio - ($prod->precio * $prod->oferta->porcentaje / 100) : $prod->precio;
            @endphp
            <div class="tarjeta_producto_tecno">
                <a href="{{ route('products.show', $prod->id) }}" class="producto-link">
                    <div class="imagen_producto_tecno">
                        <img src="{{ asset('imagenes/' . $prod->imagen) }}" alt="{{ $prod->nombre }}">
                    </div>
                    <span class="marca-producto">{{ $prod->marca ? $prod->marca->nombre : 'Sin definir' }}</span>
                    <h4>{{ $prod->nombre }}</h4>
                    <div class="precios-producto">
                        @if($prod->precio > $precioOferta)
                            <div class="container_precio_des">
                                <span class="precio-original">S/ {{ number_format($prod->precio, 2) }} un</span>
                                <span class="number_descuento">-{{ round((($prod->precio - $precioOferta)/$prod->precio)*100) }} %</span>   
                            </div>
                        @endif
                        <span class="precio-actual">S/ {{ number_format($precioOferta, 2) }} un</span>
                    </div>
                </a>
                <button class="btn-agregar-carrito" data-id="{{ $prod->id }}">Agregar</button>
            </div>
        @endforeach
    </div>
</div>

<div id="box_banners_extra">
    @foreach($bannersExtras as $banner)
        @php
            $redirectUrl = '#';
            $redireccion = (string) ($banner->redireccion ?? '');

            if ($redireccion !== '') {
                if (str_contains($redireccion, 'Producto.php?id=')) {
                    preg_match('/id=(\d+)/', $redireccion, $matches);
                    if (!empty($matches[1])) {
                        $redirectUrl = route('products.show', (int) $matches[1]);
                    }
                } else {
                    $queryString = parse_url($redireccion, PHP_URL_QUERY) ?: ltrim($redireccion, '?');
                    parse_str($queryString, $queryParams);
                    $filteredParams = array_filter([
                        'busqueda' => $queryParams['busqueda'] ?? null,
                        'categoria_id' => $queryParams['categoria_id'] ?? null,
                    ], fn($value) => $value !== null && $value !== '');

                    $redirectUrl = route('products.search', $filteredParams);
                }
            }
        @endphp
        <div class="large_container">
            <a href="{{ $redirectUrl }}" class="producto-link">
                <div class="container_imagen_banner">
                    <img src="{{ asset('imagenes/' . $banner->imagen) }}" alt="">
                </div>
            </a>
        </div>
    @endforeach
</div>

<div id="box_principal_finalOption">
    <div id="title">
        <p>Conoce mas de Jeap</p>
    </div>
    <div id="container_opciones">
        <div class="box_option" id="btn-chatbot" style="cursor: pointer;">
            <img src="{{ asset('iconos/icono pregunta.png') }}" alt="">
            <p>Preguntas frecuentes</p>
        </div>
        <div class="box_option">
            <img src="{{ asset('iconos/icono de tienda.png') }}" alt="">
            <p>Nuestras tiendas</p>
        </div>
        <div class="box_option">
            <img src="{{ asset('iconos/icono libro.png') }}" alt="">
            <p>Libro de reclamaciones</p>
        </div>
    </div>
</div>

<!-- Chatbot HTML -->
<div id="chatbot-window" class="chatbot-hidden">
    <div class="chatbot-header">
        <h4>Asistente de Ayuda</h4>
        <button id="close-chatbot">&times;</button>
    </div>
    <div id="chatbot-messages"></div>
</div>
@endsection
