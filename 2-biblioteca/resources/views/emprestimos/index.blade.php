@extends('layouts.app')

@section('titulo', 'Empréstimos')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Empréstimos</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">+ Novo Empréstimo</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Empréstimos Ativos</h5>
    </div>
    <div class="card-body p-0">
        @php
            $emprestimosAtivos = $emprestimos->where('status', 'ativo');
        @endphp

        @if ($emprestimosAtivos->count())
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Livro</th>
                            <th>Leitor</th>
                            <th>Data Empréstimo</th>
                            <th>Data Devolução</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emprestimosAtivos as $emprestimo)
                            <tr>
                                <td><strong>{{ $emprestimo->livro->titulo }}</strong></td>
                                <td>{{ $emprestimo->nome_leitor }}</td>
                                <td>{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</td>
                                <td>
                                    @if ($emprestimo->estaAtrasado())
                                        <span class="badge bg-danger">{{ $emprestimo->data_devolucao->format('d/m/Y') }}</span>
                                    @else
                                        {{ $emprestimo->data_devolucao->format('d/m/Y') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($emprestimo->estaAtrasado())
                                        <span class="badge bg-danger">Atrasado</span>
                                    @else
                                        <span class="badge bg-warning">Ativo</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('emprestimos.update', $emprestimo) }}" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">Devolver</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="p-3 mb-0 text-muted">Nenhum empréstimo ativo</p>
        @endif
    </div>
</div>
@endsection