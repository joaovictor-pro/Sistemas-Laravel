@extends('layouts.app')

@section('titulo', 'Novo Empréstimo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="mb-4">Novo Empréstimo</h1>

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if (session('erro'))
                    <div class="alert alert-warning">{{ session('erro') }}</div>
                @endif

                <form method="POST" action="{{ route('emprestimos.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Livro</label>
                        <select class="form-select" name="livro_id" required>
                            <option value="">Selecione um livro</option>
                            @foreach ($livros as $livro)
                                <option value="{{ $livro->id }}">
                                    {{ $livro->titulo }} ({{ $livro->quantidadeDisponivel() }} disponível)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nome do Leitor</label>
                        <input type="text" class="form-control" name="nome_leitor" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Devolução</label>
                        <input type="date" class="form-control" name="data_devolucao" min="{{ now()->addDay()->format('Y-m-d') }}" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Registrar</button>
                    <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection