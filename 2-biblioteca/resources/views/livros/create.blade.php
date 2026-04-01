@extends('layouts.app')

@section('titulo', 'Novo Livro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="mb-4">Cadastrar Livro</h1>

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('livros.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Autor</label>
                        <input type="text" class="form-control" name="autor" value="{{ old('autor') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Editora</label>
                        <input type="text" class="form-control" name="editora" value="{{ old('editora') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ano</label>
                            <input type="number" class="form-control" name="ano" value="{{ old('ano') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantidade</label>
                            <input type="number" class="form-control" name="quantidade" value="{{ old('quantidade', 1) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <select class="form-select" name="categoria" required>
                            <option value="">Selecione</option>
                            <option value="Ficção">Ficção</option>
                            <option value="Não-Ficção">Não-Ficção</option>
                            <option value="Romance">Romance</option>
                            <option value="Educação">Educação</option>
                            <option value="Tecnologia">Tecnologia</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                    <a href="{{ route('livros.index') }}" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection