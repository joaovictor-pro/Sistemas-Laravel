@extends('layouts.app')

@section('titulo', 'Detalhes do Livro')

@section('conteudo')
    <div class="card">
        <h2 style="color: #667eea; margin-bottom: 30px;">{{ $book->titulo }}</h2>

        <div style="margin-bottom: 30px;">
            <div style="margin-bottom: 20px;">
                <strong>Autor:</strong>
                <p style="color: #666;">{{ $book->autor }}</p>
            </div>

            <div style="margin-bottom: 20px;">
                <strong>Ano de Publicação:</strong>
                <p style="color: #666;">{{ $book->ano_publicacao }}</p>
            </div>

            <div style="margin-bottom: 20px;">
                <strong>Gênero:</strong>
                <p style="color: #666;">{{ $book->genero }}</p>
            </div>

            <div style="margin-bottom: 20px;">
                <strong>Quantidade de Páginas:</strong>
                <p style="color: #666;">{{ $book->paginas }}</p>
            </div>

            <div style="margin-bottom: 20px;">
                <strong>Status:</strong>
                <p>
                    <span class="status-badge status-{{ strtolower(str_replace('á', 'a', $book->status)) }}">
                        {{ $book->status }}
                    </span>
                </p>
            </div>

            <div style="margin-bottom: 20px;">
                <strong>Cadastrado em:</strong>
                <p style="color: #666;">{{ $book->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div style="margin-bottom: 20px;">
                <strong>Última atualização:</strong>
                <p style="color: #666;">{{ $book->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="{{ route('livros.edit', $book->id) }}" class="btn btn-secondary">Editar</a>
            <a href="{{ route('livros.index') }}" class="btn btn-primary">Voltar</a>
            <form action="{{ route('livros.destroy', $book->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja deletar este livro?')">Deletar</button>
            </form>
        </div>
    </div>
@endsection
