@extends('layout')

@section('title', 'Produtos com Estoque Baixo')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Produtos com Estoque Baixo</h2>
        <p class="text-muted">Produtos que precisam de reabastecimento</p>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-danger">
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Quantidade Atual</th>
                    <th>Estoque Mínimo</th>
                    <th>Falta</th>
                    <th>Preço</th>
                    <th>Fornecedor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produtos as $produto)
                    <tr class="table-warning">
                        <td><strong>{{ $produto->nome }}</strong></td>
                        <td>{{ $produto->categoria }}</td>
                        <td>{{ $produto->quantidade }}</td>
                        <td>{{ $produto->estoque_minimo }}</td>
                        <td>
                            <span class="badge bg-danger">
                                {{ $produto->estoque_minimo - $produto->quantidade }} unidades
                            </span>
                        </td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->fornecedor }}</td>
                        <td>
                            <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted p-4">Nenhum produto com estoque baixo</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $produtos->links() }}
</div>
@endsection