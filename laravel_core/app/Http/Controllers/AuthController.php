<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nombre', 'contrasena');

        // Mapear para usar en el custom provider
        $authData = [
            'nombre' => $credentials['nombre'],
            'password' => $credentials['contrasena'], // Nuestro custom provider usa 'password' key
        ];

        if (Auth::attempt($authData)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'nombre' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'contrasena' => ['required', 'string', 'max:255', 'confirmed'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'correo' => ['nullable', 'email', 'max:255'],
            'dni' => ['nullable', 'string', 'max:20'],
        ]);

        User::create([
            'nombre' => $data['nombre'],
            'contrasena' => $data['contrasena'],
            'telefono' => $data['telefono'] ?? null,
            'correo' => $data['correo'] ?? null,
            'dni' => $data['dni'] ?? null,
        ]);

        return redirect()->route('login')->with('status', 'Registro exitoso. Ahora puedes iniciar sesion.');
    }
}
