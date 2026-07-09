@extends('layouts.app')

@section('title', $producto->nombre)

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/VerCarrito.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detalles-producto.css') }}">
@endsection

@section('content')
<div id="container_principal">
    <div id="container_secundario">
        <div id="imagen_producto">
            <img src="{{ asset('imagenes/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
        </div>

        <div id="Info_producto">
            <div id="container_descripcion_producto">
                <h2>Descripcion</h2>
                <p>{{ $producto->descripcion }}</p>
            </div>
        </div>
    </div>

    <div id="box_info_and_options">
        <div id="Textbox_producto">
            <div id="primary_box">
                <div id="container_producto_superior">
                    <span class="marca-producto-principal">{{ $producto->marca ? $producto->marca->nombre : 'Sin definir' }}</span>

                    <div id="extra_container">
                        <p>{{ $producto->nombre }}</p>
                        <img src="{{ asset('iconos/corazon.png') }}" alt="Favorito">
                    </div>

                    <div id="container_box">
                        <div id="info_precio">
                            @php
                                $precioOferta = $producto->oferta
                                    ? $producto->precio - ($producto->precio * $producto->oferta->porcentaje / 100)
                                    : $producto->precio;
                            @endphp
                            @if($producto->precio > $precioOferta)
                                <p class="precio-original-main">S/ {{ number_format($producto->precio, 2) }}</p>
                            @endif
                            <p class="precio-actual-main">S/ {{ number_format($precioOferta, 2) }}</p>
                        </div>

                        <div id="info_stock">
                            <p>Quedan menos de {{ $producto->stock }} unidades disponibles</p>
                        </div>
                    </div>

                    <div id="container_button">
                        <button class="btn-agregar-carrito" type="button" data-id="{{ $producto->id }}">Agregar al carrito</button>
                    </div>
                </div>
            </div>

            <div id="container_methods_pago">
                <h4>Metodos de pago</h4>
                <div id="image-icons">
                    <img src="{{ asset('iconos/yape-logo-fondo-transparente.png') }}" alt="Yape">
                    <img src="{{ asset('iconos/Visa_Inc._logo_(2005–2014).png') }}" alt="Visa">
                    <img src="{{ asset('iconos/MasterCard_Logo.svg.png') }}" alt="Mastercard">
                </div>
            </div>
        </div>

        <div id="container_compartir">
            <p>Compartir en:</p>
            <div>
                <i class="bi bi-twitter-x"></i>
                <i class="bi bi-facebook"></i>
                <i class="bi bi-whatsapp"></i>
            </div>
        </div>
    </div>
</div>

<div id="container_productos_similares">
    <div id="title_productos_similares">
        <p>Productos Similares</p>
    </div>
    <div id="container_productos">
        @foreach($relacionados as $rel)
            @php
                $precioRelacionado = $rel->oferta
                    ? $rel->precio - ($rel->precio * $rel->oferta->porcentaje / 100)
                    : $rel->precio;
            @endphp
            <a href="{{ route('products.show', $rel->id) }}" class="enlace_similar">
                <div class="producto_similar">
                    <div class="img_container_similar">
                        <img src="{{ asset('imagenes/' . $rel->imagen) }}" alt="{{ $rel->nombre }}">
                    </div>
                    <span class="marca-producto">{{ $rel->marca ? $rel->marca->nombre : 'Sin definir' }}</span>
                    <p class="similar_nombre">{{ $rel->nombre }}</p>
                    <div class="precios-producto">
                        @if($rel->precio > $precioRelacionado)
                            <span class="precio-original">S/ {{ number_format($rel->precio, 2) }} un</span>
                        @endif
                        <span class="precio-actual">S/ {{ number_format($precioRelacionado, 2) }} un</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
