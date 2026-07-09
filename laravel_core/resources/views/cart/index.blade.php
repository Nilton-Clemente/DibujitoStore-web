@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/VerCarrito.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <h2>Mi Carrito</h2>
    @if(empty($cartItems))
        <p>Tu carrito está vacío.</p>
    @else
        <div class="mt-3">
            @include('cart.panel', ['cartItems' => $cartItems])
        </div>
    @endif
</div>
@endsection
