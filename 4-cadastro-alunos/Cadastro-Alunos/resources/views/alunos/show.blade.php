@extends('layout')

@section('title', 'Detalhes do Aluno')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>{{ $student->nome }}</h2>
        <p class="text-muted">Detalhes do aluno</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('alunos.edit', $student) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('alunos.destroy', $student) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Deletar</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nome:</strong>
                        <p>{{ $student->nome }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p>{{ $student->email }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Telefone:</strong>
                        <p>{{ $student->telefone }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Data de Nascimento:</strong>
                        <p>{{ $student->data_nascimento->format('d/m/Y') }} ({{ $student->idade }} anos)</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Curso:</strong>
                        <p><span class="badge bg-info">{{ $student->curso }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Matrícula:</strong>
                        <p>{{ $student->matricula }}</p>
                    </div>
                </div>

                @if($student->observacoes)
                    <div class="mb-3">
                        <strong>Observações:</strong>
                        <p>{{ $student->observacoes }}</p>
                    </div>
                @endif

                <div class="row mt-4 text-muted small">
                    <div class="col-md-6">
                        <strong>Cadastrado em:</strong>
                        <p>{{ $student->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Última atualização:</strong>
                        <p>{{ $student->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('alunos.index') }}" class="btn btn-secondary">← Voltar</a>
</div>
@endsection