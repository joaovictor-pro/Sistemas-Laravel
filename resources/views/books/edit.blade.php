@extends('layouts.app')

@section('titulo', 'Editar Livro')

@section('conteudo')
    <div class="form-container">
        <h2 style="color: #667eea; margin-bottom: 30px;">Editar Livro</h2>

        <form action="{{ route('livros.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="titulo">Título *</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $book->titulo) }}" required>
                @error('titulo')
                    <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="autor">Autor *</label>
                <input type="text" id="autor" name="autor" value="{{ old('autor', $book->autor) }}" required>
                @error('autor')
                    <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ano_publicacao">Ano de Publicação *</label>
                <input type="number" id="ano_publicacao" name="ano_publicacao" value="{{ old('ano_publicacao', $book->ano_publicacao) }}" min="1000" max="{{ date('Y') }}" required>
                @error('ano_publicacao')
                    <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="genero">Gênero *</label>
                <input type="text" id="genero" name="genero" value="{{ old('genero', $book->genero) }}" required>
                @error('genero')
                    <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="paginas">Quantidade de Páginas *</label>
                <input type="number" id="paginas" name="paginas" value="{{ old('paginas', $book->paginas) }}" min="1" required>
                @error('paginas')
                    <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="">Selecione um status</option>
                    <option value="Disponível" {{ old('status', $book->status) == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                    <option value="Emprestado" {{ old('status', $book->status) == 'Emprestado' ? 'selected' : '' }}>Emprestado</option>
                    <option value="Reservado" {{ old('status', $book->status) == 'Reservado' ? 'selected' : '' }}>Reservado</option>
                </select>
                @error('status')
                    <span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Atualizar Livro</button>
                <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
