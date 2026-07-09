@extends('layouts.auth')

@section('title', 'Registro')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/RegistroCliente.css') }}">
@endsection

@section('content')
<div id="caja_principal">
    <div id="caja_secundaria">
        <div id="Titulo">
            <h2>Crear Cuenta</h2>
        </div>

        <div id="box_input_datos">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" required>
                <input type="text" name="contrasena" placeholder="Contraseña" required>
                <input type="password" name="contrasena_confirmation" id="contrasena_confirmation" placeholder="Confirmar contraseña" required>
                <small id="password-confirmation-error" aria-live="polite"></small>
                <input type="text" name="telefono" placeholder="Telefono" value="{{ old('telefono') }}">
                <input type="email" name="correo" placeholder="Correo electronico" value="{{ old('correo') }}">
                <input type="text" name="dni" placeholder="DNI" value="{{ old('dni') }}">

                @if($errors->any())
                    <div style="color: red; margin-bottom: 10px;">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div id="Container_Button">
                    <button type="submit">Registrarse</button>
                </div>
            </form>
        </div>
    </div>

    <div id="caja_terciaria">
        <div id="no_account">
            <p>Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesion</a></p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/registro.js') }}"></script>
@endsection
