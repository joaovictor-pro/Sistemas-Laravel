@extends('layout')

@section('title', 'Editar Aluno')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2>Editar Aluno</h2>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('alunos.update', $student) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome *</label>
                    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $student->nome) }}" required>
                    @error('nome') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}" required>
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefone *</label>
                    <input type="tel" name="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone', $student->telefone) }}" required>
                    @error('telefone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Data de Nascimento *</label>
                    <input type="date" name="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{ old('data_nascimento', $student->data_nascimento->format('Y-m-d')) }}" required>
                    @error('data_nascimento') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Curso *</label>
                    <input type="text" name="curso" class="form-control @error('curso') is-invalid @enderror" value="{{ old('curso', $student->curso) }}" required>
                    @error('curso') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Matrícula *</label>
                    <input type="text" name="matricula" class="form-control @error('matricula') is-invalid @enderror" value="{{ old('matricula', $student->matricula) }}" required>
                    @error('matricula') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Observações</label>
                <textarea name="observacoes" class="form-control @error('observacoes') is-invalid @enderror" rows="4">{{ old('observacoes', $student->observacoes) }}</textarea>
                @error('observacoes') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Atualizar Aluno</button>
                <a href="{{ route('alunos.show', $student) }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection