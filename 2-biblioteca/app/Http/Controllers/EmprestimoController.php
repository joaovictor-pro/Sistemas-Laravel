<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmprestimoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $emprestimos = Emprestimo::with('livro', 'usuario')->get();
        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create()
    {
        $livros = Livro::where('quantidade', '>', 0)->get();
        return view('emprestimos.create', compact('livros'));
    }

    public function store(Request $request)
    {
        $validado = $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'nome_leitor' => 'required|string|max:255',
            'data_devolucao' => 'required|date|after:today',
        ]);

        $livro = Livro::findOrFail($validado['livro_id']);

        if (!$livro->estaDisponivel()) {
            return back()->with('erro', 'Livro não está disponível no momento.');
        }

        Emprestimo::create([
            'livro_id' => $validado['livro_id'],
            'usuario_id' => Auth::id(),
            'nome_leitor' => $validado['nome_leitor'],
            'data_emprestimo' => now(),
            'data_devolucao' => $validado['data_devolucao'],
            'status' => 'ativo',
        ]);

        return redirect()->route('emprestimos.index')->with('sucesso', 'Empréstimo registrado com sucesso!');
    }

    public function update(Request $request, Emprestimo $emprestimo)
    {
        $emprestimo->update([
            'status' => 'devolvido',
            'data_devolucao' => now(),
        ]);

        return redirect()->route('emprestimos.index')->with('sucesso', 'Livro devolvido com sucesso!');
    }

    public function historico()
    {
        $emprestimos = Emprestimo::with('livro', 'usuario')
            ->where('status', 'devolvido')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('emprestimos.historico', compact('emprestimos'));
    }

  
    public function consultarDisponibilidade()
    {
      
        $livros = collect(Livro::all()->map(function ($livro) {
            return [
                'id' => $livro->id,
                'titulo' => $livro->titulo,
                'autor' => $livro->autor,
                'categoria' => $livro->categoria,
                'disponivel' => $livro->quantidadeDisponivel(),
                'total' => $livro->quantidade,
            ];
        }));

        return view('livros.disponibilidade', compact('livros'));
    }

    public function show(Emprestimo $emprestimo) {}
    public function edit(Emprestimo $emprestimo) {}
    public function destroy(Emprestimo $emprestimo) {}
}