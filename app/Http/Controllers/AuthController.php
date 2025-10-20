<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = DB::table('usuarios')->where('email', $request->email)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Guardar usuario en la sesión
            $request->session()->put('usuario', [
                'id' => $usuario->id,
                'nombre' => $usuario->nombre,
                'rol' => $usuario->rol,
                'email' => $usuario->email,
            ]);

            // Regenerar sesión por seguridad
            $request->session()->regenerate();

            // Redirigir según el rol
            if ($usuario->rol === 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('productos.index');
            }
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    // Mostrar el dashboard 
    public function dashboard(Request $request)
    {
        $usuario = $request->session()->get('usuario');
        return view('admin.dashboard', ['usuario' => $usuario]);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        $request->session()->forget('usuario');
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
