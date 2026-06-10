<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Exibir uma listagem de todos os recursos.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Exibir o formulário para criar um novo recurso.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Armazenar um recurso recém-criado no armazenamento.
     */
    public function store(Request $request)
    {
        $validado = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'genero' => 'required|string|max:255',
            'paginas' => 'required|integer|min:1',
            'status' => 'required|in:Disponível,Emprestado,Reservado',
        ], [
            'titulo.required' => 'O título é obrigatório.',
            'autor.required' => 'O autor é obrigatório.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'status.required' => 'O status é obrigatório.',
            'paginas.integer' => 'A quantidade de páginas deve ser um número.',
        ]);

        Book::create($validado);

        return redirect()->route('books.index')->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    /**
     * Exibir o recurso especificado.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Exibir o formulário para editar o recurso especificado.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Atualizar o recurso especificado no armazenamento.
     */
    public function update(Request $request, Book $book)
    {
        $validado = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'ano_publicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'genero' => 'required|string|max:255',
            'paginas' => 'required|integer|min:1',
            'status' => 'required|in:Disponível,Emprestado,Reservado',
        ], [
            'titulo.required' => 'O título é obrigatório.',
            'autor.required' => 'O autor é obrigatório.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'status.required' => 'O status é obrigatório.',
            'paginas.integer' => 'A quantidade de páginas deve ser um número.',
        ]);

        $book->update($validado);

        return redirect()->route('books.index')->with('sucesso', 'Livro atualizado com sucesso!');
    }

    /**
     * Remover o recurso especificado do armazenamento.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('sucesso', 'Livro deletado com sucesso!');
    }
}
