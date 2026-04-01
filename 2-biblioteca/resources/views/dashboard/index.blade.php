@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-4">Dashboard</h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-primary">{{ $totalLivros }}</h3>
                <p class="text-muted mb-0">Total de Livros</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-success">{{ $totalUsuarios }}</h3>
                <p class="text-muted mb-0">Usuários</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-warning">{{ $emprestimosAtivos }}</h3>
                <p class="text-muted mb-0">Empréstimos Ativos</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-info">{{ $emprestimosDevolve }}</h3>
                <p class="text-muted mb-0">Devolvidos</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Livros Mais Emprestados</h5>
            </div>
            <div class="card-body p-0">
                @if ($livrosPopulares->count())
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Livro</th>
                                <th>Autor</th>
                                <th>Empréstimos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livrosPopulares as $livro)
                                <tr>
                                    <td>{{ $livro->titulo }}</td>
                                    <td>{{ $livro->autor }}</td>
                                    <td><span class="badge bg-primary">{{ $livro->emprestimos_count }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-3 mb-0 text-muted">Sem dados</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Ações Rápidas</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('livros.create') }}" class="btn btn-primary w-100 mb-2">+ Novo Livro</a>
                <a href="{{ route('emprestimos.create') }}" class="btn btn-success w-100 mb-2">+ Novo Empréstimo</a>
                <a href="{{ route('livros.disponibilidade') }}" class="btn btn-info w-100">Ver Disponibilidade</a>
            </div>
        </div>
    </div>
</div>
@endsection