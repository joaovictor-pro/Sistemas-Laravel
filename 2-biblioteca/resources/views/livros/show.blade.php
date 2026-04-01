@extends('layouts.app')

@section('titulo', $livro->titulo)

@section('content')
<h1 class="mb-4">{{ $livro->titulo }}</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Autor:</strong> {{ $livro->autor }}</p>
                <p><strong>Editora:</strong> {{ $livro->editora }}</p>
                <p><strong>Ano:</strong> {{ $livro->ano }}</p>
                <p><strong>Categoria:</strong> <span class="badge bg-secondary">{{ $livro->categoria }}</span></p>
                <p><strong>Quantidade Total:</strong> {{ $livro->quantidade }}</p>
                <p>
                    <strong>Disponível:</strong>
                    @if ($livro->estaDisponivel())
                        <span class="badge bg-success">{{ $livro->quantidadeDisponivel() }}</span>
                    @else
                        <span class="badge bg-danger">0</span>
                    @endif
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Histórico de Empréstimos</h5>
            </div>
            <div class="card-body p-0">
                @if ($livro->emprestimos->count())
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Leitor</th>
                                <th>Data Empréstimo</th>
                                <th>Data Devolução</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livro->emprestimos as $emprestimo)
                                <tr>
                                    <td>{{ $emprestimo->nome_leitor }}</td>
                                    <td>{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($emprestimo->data_devolucao)
                                            {{ $emprestimo->data_devolucao->format('d/m/Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($emprestimo->status === 'ativo')
                                            <span class="badge bg-warning">Ativo</span>
                                        @else
                                            <span class="badge bg-success">Devolvido</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-3 mb-0 text-muted">Sem empréstimos</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('livros.edit', $livro) }}" class="btn btn-warning w-100 mb-2">Editar</a>
                <form method="POST" action="{{ route('livros.destroy', $livro) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Confirmar?')">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('livros.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection