@extends('layouts.app')

@section('titulo', 'Listar Livros')

@section('conteudo')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-size: 24px; color: #667eea;">Livros Cadastrados</h2>
        <a href="{{ route('livros.create') }}" class="btn btn-primary">+ Adicionar Livro</a>
    </div>

    @if($books->count() == 0)
        <div class="card" style="text-align: center; padding: 50px;">
            <p style="font-size: 18px; color: #999;">Nenhum livro cadastrado. Comece adicionando um novo livro!</p>
            <a href="{{ route('livros.create') }}" class="btn btn-primary" style="margin-top: 20px;">Adicionar Primeiro Livro</a>
        </div>
    @else
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>Gênero</th>
                        <th>Páginas</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $livro)
                        <tr>
                            <td><strong>{{ $livro->titulo }}</strong></td>
                            <td>{{ $livro->autor }}</td>
                            <td>{{ $livro->ano_publicacao }}</td>
                            <td>{{ $livro->genero }}</td>
                            <td>{{ $livro->paginas }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower(str_replace('á', 'a', $livro->status)) }}">
                                    {{ $livro->status }}
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('livros.show', $livro->id) }}" class="btn btn-info" style="font-size: 12px;">Ver</a>
                                    <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-secondary" style="font-size: 12px;">Editar</a>
                                    <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px;" onclick="return confirm('Deseja deletar este livro?')">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
