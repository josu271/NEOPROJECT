<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;        // ← Importa Hash aquí
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'dni'      => ['required', 'integer'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('DNI', $data['dni'])->first();

        if ($user && Hash::check($data['password'], $user->getAuthPassword())) {
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->with('error', 'Credenciales inválidas')
            ->withInput($request->only('dni'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
