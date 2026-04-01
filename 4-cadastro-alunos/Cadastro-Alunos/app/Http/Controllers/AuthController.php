<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar formulário de cadastro
    public function showRegister()
    {
        return view('autenticacao.cadastro');
    }

    // Processar cadastro
    public function register(Request $request)
    {
        $validado = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        try {
            $usuario = User::create([
                'name' => $validado['name'],
                'email' => $validado['email'],
                'password' => Hash::make($validado['password']),
            ]);

            Auth::login($usuario);

            return redirect()->route('dashboard.index')->with('sucesso', 'Cadastro realizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao cadastrar. Tente novamente.')->withInput();
        }
    }

    // Mostrar formulário de login
    public function showLogin()
    {
        return view('autenticacao.login');
    }

    // Processar login
    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);

        $usuario = User::where('email', $credenciais['email'])->first();

        if ($usuario && Hash::check($credenciais['password'], $usuario->password)) {
            Auth::login($usuario);
            $request->session()->regenerate();
            return redirect()->route('dashboard.index')->with('sucesso', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('sucesso', 'Logout realizado com sucesso!');
    }
}