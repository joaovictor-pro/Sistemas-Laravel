@extends('layout')

@section('title', 'Alunos')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Alunos</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('alunos.create') }}" class="btn btn-primary">Novo Aluno</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('alunos.index') }}" class="row g-3">
            <div class="col-md-10">
                <input type="text" name="busca" class="form-control" placeholder="Buscar por nome, email ou matrícula..." value="{{ $busca }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-info w-100">Buscar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Curso</th>
                    <th>Matrícula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alunos as $aluno)
                    <tr>
                        <td><strong>{{ $aluno->nome }}</strong></td>
                        <td>{{ $aluno->email }}</td>
                        <td>{{ $aluno->telefone }}</td>
                        <td><span class="badge bg-secondary">{{ $aluno->curso }}</span></td>
                        <td>{{ $aluno->matricula }}</td>
                        <td>
                            <a href="{{ route('alunos.show', $aluno) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">Nenhum aluno cadastrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $alunos->links() }}
</div>
@endsection