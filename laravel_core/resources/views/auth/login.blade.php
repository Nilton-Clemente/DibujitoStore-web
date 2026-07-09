@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/LoginCliente.css') }}">
@endsection

@section('content')
<div id="caja_principal">
    <div id="caja_secundaria">
        <div id="Titulo">
            <h2>Iniciar Sesion</h2>
        </div>
        <div id="box_input_datos">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <input type="text" name="nombre" placeholder="Usuario" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>

                @if(session('status'))
                    <div style="color: #2F5233; font-size: 13px; text-align: center;">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                    <div style="color: red; margin-bottom: 10px;">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div id="Container_Button">
                    <button type="submit">Iniciar Sesion</button>
                </div>
            </form>
        </div>
        <div id="no_key">
            <p>Olvidaste tu contraseña</p>
        </div>
    </div>
    <div id="caja_terciaria">
        <div id="ini_alternativa">
            <p>Continuar con :</p>
            <img src="{{ asset('iconos/image 22.png') }}" alt="">
        </div>
        <div id="no_account">
            <p>No tienes una cuenta <a href="{{ route('register') }}">registrate</a></p>
        </div>
    </div>
</div>
@endsection
