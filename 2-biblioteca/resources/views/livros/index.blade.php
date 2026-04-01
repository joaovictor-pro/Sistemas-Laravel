@extends('layouts.app')

@section('titulo', 'Livros')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Livros</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('livros.create') }}" class="btn btn-primary">+ Novo Livro</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Lista de Livros</h5>
    </div>
    <div class="card-body p-0">
        @if ($livros->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editora</th>
                            <th>Ano</th>
                            <th>Categoria</th>
                            <th>Quantidade</th>
                            <th>Disponível</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($livros as $livro)
                            <tr>
                                <td><strong>{{ $livro->titulo }}</strong></td>
                                <td>{{ $livro->autor }}</td>
                                <td>{{ $livro->editora }}</td>
                                <td>{{ $livro->ano }}</td>
                                <td><span class="badge bg-secondary">{{ $livro->categoria }}</span></td>
                                <td>{{ $livro->quantidade }}</td>
                                <td>
                                    @if ($livro->estaDisponivel())
                                        <span class="badge bg-success">{{ $livro->quantidadeDisponivel() }}</span>
                                    @else
                                        <span class="badge bg-danger">0</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('livros.show', $livro) }}" class="btn btn-sm btn-info">Ver</a>
                                    <a href="{{ route('livros.edit', $livro) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form method="POST" action="{{ route('livros.destroy', $livro) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar?')">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="p-3 text-muted mb-0">Nenhum livro cadastrado</p>
        @endif
    </div>
</div>
@endsection