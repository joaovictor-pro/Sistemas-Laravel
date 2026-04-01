@extends('layouts.app')

@section('titulo', 'Disponibilidade')

@section('content')
<h1 class="mb-4">Disponibilidade de Livros</h1>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3>{{ count($livros) }}</h3>
                <p class="text-muted mb-0">Total</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-success">{{ collect($livros)->sum('disponivel') }}</h3>
                <p class="text-muted mb-0">Disponíveis</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-warning">{{ collect($livros)->sum('total') - collect($livros)->sum('disponivel') }}</h3>
                <p class="text-muted mb-0">Emprestados</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-danger">{{ collect($livros)->filter(fn($l) => $l['disponivel'] == 0)->count() }}</h3>
                <p class="text-muted mb-0">Indisponíveis</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if (count($livros) > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Livro</th>
                            <th>Autor</th>
                            <th>Total</th>
                            <th>Disponível</th>
                            <th>Emprestados</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($livros as $livro)
                            @php
                                $emprestados = $livro['total'] - $livro['disponivel'];
                            @endphp
                            <tr>
                                <td>{{ $livro['titulo'] }}</td>
                                <td>{{ $livro['autor'] }}</td>
                                <td>{{ $livro['total'] }}</td>
                                <td>
                                    @if ($livro['disponivel'] > 0)
                                        <span class="badge bg-success">{{ $livro['disponivel'] }}</span>
                                    @else
                                        <span class="badge bg-danger">0</span>
                                    @endif
                                </td>
                                <td><span class="badge bg-warning">{{ $emprestados }}</span></td>
                                <td>
                                    @if ($livro['disponivel'] > 0)
                                        <span class="badge bg-success">Disponível</span>
                                    @else
                                        <span class="badge bg-danger">Indisponível</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="p-3 mb-0 text-muted">Sem livros</p>
        @endif
    </div>
</div>

<a href="{{ route('livros.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection