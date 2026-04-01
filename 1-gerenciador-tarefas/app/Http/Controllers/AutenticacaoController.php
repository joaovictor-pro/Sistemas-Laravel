<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AutenticacaoController extends Controller
{
    public function exibirCadastro()
    {
        return view('autenticacao.cadastro');
    }

    public function cadastrar(Request $request)
    {
        $validado = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = User::create([
            'name' => $validado['name'],
            'email' => $validado['email'],
            'password' => Hash::make($validado['password']),
        ]);

        Auth::login($usuario);

        return redirect()->route('dashboard')->with('sucesso', 'Cadastro realizado com sucesso!');
    }

    public function exibirLogin()
    {
        return view('autenticacao.login');
    }

    public function fazer_login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = User::where('email', $credenciais['email'])->first();

        if ($usuario && Hash::check($credenciais['password'], $usuario->password)) {
            Auth::login($usuario);
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('sucesso', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('sucesso', 'Logout realizado com sucesso!');
    }
}

