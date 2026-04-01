<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $livros = Livro::all();
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        $validado = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'ano' => 'required|integer|min:1000|max:' . now()->year,
            'categoria' => 'required|string|max:100',
            'quantidade' => 'required|integer|min:1',
        ]);

        Livro::create($validado);
        return redirect()->route('livros.index')->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    public function show(Livro $livro)
    {
        $livro->load('emprestimos');
        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, Livro $livro)
    {
        $validado = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'ano' => 'required|integer|min:1000|max:' . now()->year,
            'categoria' => 'required|string|max:100',
            'quantidade' => 'required|integer|min:1',
        ]);

        $livro->update($validado);
        return redirect()->route('livros.index')->with('sucesso', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();
        return redirect()->route('livros.index')->with('sucesso', 'Livro deletado com sucesso!');
    }
}