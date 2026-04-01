<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar produtos
    public function index()
    {
        $produtos = Product::paginate(10);
        return view('products.index', compact('produtos'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view('products.create');
    }

    // Salvar produto
    public function store(Request $request)
    {
        $validado = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria' => 'required|string|max:100',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'fornecedor' => 'required|string|max:255',
            'estoque_minimo' => 'required|integer|min:0',
        ], [
            'nome.required' => 'O nome do produto é obrigatório.',
            'categoria.required' => 'A categoria é obrigatória.',
            'quantidade.required' => 'A quantidade é obrigatória.',
            'preco.required' => 'O preço é obrigatório.',
            'fornecedor.required' => 'O fornecedor é obrigatório.',
            'estoque_minimo.required' => 'O estoque mínimo é obrigatório.',
        ]);

        try {
            Product::create($validado);
            return redirect()->route('produtos.index')->with('sucesso', 'Produto cadastrado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao salvar produto: ' . $e->getMessage())->withInput();
        }
    }

    // Mostrar formulário de edição
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Atualizar produto
    public function update(Request $request, Product $product)
    {
        $validado = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria' => 'required|string|max:100',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'fornecedor' => 'required|string|max:255',
            'estoque_minimo' => 'required|integer|min:0',
        ]);

        try {
            $product->update($validado);
            return redirect()->route('produtos.index')->with('sucesso', 'Produto atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao atualizar produto: ' . $e->getMessage())->withInput();
        }
    }

    // Deletar produto
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('produtos.index')->with('sucesso', 'Produto deletado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao deletar produto: ' . $e->getMessage());
        }
    }

    // Listar produtos com estoque baixo
    public function estoqueBaixo()
    {
        $produtos = Product::whereRaw('quantidade <= estoque_minimo')->paginate(10);
        return view('products.estoque-baixo', compact('produtos'));
    }

    // Atualizar quantidade
    public function atualizarQuantidade(Request $request, Product $product)
    {
        $validado = $request->validate([
            'quantidade' => 'required|integer|min:0',
        ]);

        try {
            $product->update(['quantidade' => $validado['quantidade']]);
            return back()->with('sucesso', 'Quantidade atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao atualizar quantidade: ' . $e->getMessage());
        }
    }
}