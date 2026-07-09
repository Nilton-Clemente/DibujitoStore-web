@extends('layouts.app')

@section('title', 'Resultados de busqueda')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ResultadoProductos.css') }}">
@endsection

@section('content')
<div id="box_principal">
    <div id="Menu">
        <div id="container_titulo">
            <h3>Filtrar productos</h3>
        </div>
        <div id="container_opciones">
            <p>Ordenar por:</p>
            <p>Marca:</p>
            @if(!empty($busqueda))
                <p>Busqueda: {{ $busqueda }}</p>
            @elseif(!empty($categoriaId))
                <p>Categoria: {{ $categoriaId }}</p>
            @endif
        </div>
    </div>

    <div id="resultado_productos">
        <div id="contenedor_productos">
            @forelse($productos as $prod)
                @php
                    $precioOferta = $prod->oferta
                        ? $prod->precio - ($prod->precio * $prod->oferta->porcentaje / 100)
                        : $prod->precio;
                    $descuento = $prod->precio > 0
                        ? (($prod->precio - $precioOferta) / $prod->precio) * 100
                        : 0;
                @endphp

                <div class="producto">
                    <a href="{{ route('products.show', $prod->id) }}" class="producto-link">
                        <div class="img_producto">
                            <img src="{{ asset('imagenes/' . $prod->imagen) }}" alt="{{ $prod->nombre }}">
                        </div>

                        <span class="marca-producto">{{ $prod->marca ? $prod->marca->nombre : 'Sin definir' }}</span>
                        <strong>{{ $prod->nombre }}</strong>
                        <div class="precios-producto">
                            @if($prod->precio > $precioOferta)
                                <div class="container_precio_des">
                                    <span class="precio-original">S/ {{ number_format($prod->precio, 2) }} un</span>
                                    <span class="number_descuento">-{{ number_format($descuento, 0) }} %</span>
                                </div>
                            @endif
                            <span class="precio-actual">S/ {{ number_format($precioOferta, 2) }} un</span>
                        </div>
                    </a>

                    <div id="container_buttons">
                        <button class="btn-agregar-carrito" data-id="{{ $prod->id }}" type="button">Agregar</button>
                        <img src="{{ asset('iconos/corazon.png') }}" alt="Favorito">
                    </div>
                </div>
            @empty
                <p>No se encontraron productos para la busqueda realizada.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
