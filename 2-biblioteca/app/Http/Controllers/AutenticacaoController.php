<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
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
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'senha' => 'required|string|min:8|confirmed',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:500',
        ]);

        $usuario = Usuario::create([
            'nome' => $validado['nome'],
            'email' => $validado['email'],
            'senha' => Hash::make($validado['senha']),
            'telefone' => $validado['telefone'],
            'endereco' => $validado['endereco'],
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
            'senha' => 'required',
        ]);

        // ✅ Use isto - procure o usuário manualmente
        $usuario = Usuario::where('email', $credenciais['email'])->first();

        if ($usuario && Hash::check($credenciais['senha'], $usuario->senha)) {
            Auth::login($usuario);
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('sucesso', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('sucesso', 'Logout realizado com sucesso!');
    }
}