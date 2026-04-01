@extends('layout')

@section('title', 'Produtos')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Produtos</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('produtos.create') }}" class="btn btn-primary">Novo Produto</a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Fornecedor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produtos as $produto)
                    <tr class="@if($produto->isEstoqueBaixo()) table-warning @endif">
                        <td><strong>{{ $produto->nome }}</strong></td>
                        <td>{{ $produto->categoria }}</td>
                        <td>
                            {{ $produto->quantidade }}
                            @if($produto->isEstoqueBaixo())
                                <span class="badge bg-danger">Baixo</span>
                            @endif
                        </td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->fornecedor }}</td>
                        <td>
                            @if($produto->isEstoqueBaixo())
                                <span class="badge bg-danger">Estoque Baixo</span>
                            @else
                                <span class="badge bg-success">OK</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted p-4">Nenhum produto cadastrado</td>
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