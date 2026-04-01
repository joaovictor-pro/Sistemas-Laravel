@extends('layouts.app')

@section('titulo', 'Histórico de Empréstimos')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Histórico de Empréstimos</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Empréstimos Devolvidos</h5>
    </div>
    <div class="card-body p-0">
        @if ($emprestimos->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Livro</th>
                            <th>Autor</th>
                            <th>Leitor</th>
                            <th>Data Empréstimo</th>
                            <th>Data Devolução</th>
                            <th>Dias Emprestado</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emprestimos as $emprestimo)
                            @php
                                $dias = $emprestimo->data_emprestimo->diffInDays($emprestimo->updated_at);
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $emprestimo->livro->titulo }}</strong>
                                </td>
                                <td>{{ $emprestimo->livro->autor }}</td>
                                <td>{{ $emprestimo->nome_leitor }}</td>
                                <td>{{ $emprestimo->data_emprestimo->format('d/m/Y H:i') }}</td>
                                <td>{{ $emprestimo->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $dias }} dia(s)</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Devolvido</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="p-3 mb-0 text-muted text-center">Nenhum empréstimo devolvido ainda</p>
        @endif
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Resumo</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="text-center">
                    <h3 class="text-success">{{ $emprestimos->count() }}</h3>
                    <p class="text-muted mb-0">Total Devolvido</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h3 class="text-info">
                        {{ $emprestimos->sum(function($e) { return $e->data_emprestimo->diffInDays($e->updated_at); }) }}
                    </h3>
                    <p class="text-muted mb-0">Dias Totais</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h3 class="text-warning">
                        {{ $emprestimos->count() > 0 ? round($emprestimos->sum(function($e) { return $e->data_emprestimo->diffInDays($e->updated_at); }) / $emprestimos->count(), 0) : 0 }}
                    </h3>
                    <p class="text-muted mb-0">Média de Dias</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <h3 class="text-secondary">{{ $emprestimos->groupBy('nome_leitor')->count() }}</h3>
                    <p class="text-muted mb-0">Leitores</p>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="{{ route('emprestimos.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection