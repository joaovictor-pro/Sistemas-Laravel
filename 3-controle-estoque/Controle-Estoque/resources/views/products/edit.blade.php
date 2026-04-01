@extends('layout')

@section('title', 'Editar Produto')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2>Editar Produto</h2>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('produtos.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome *</label>
                    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $product->nome) }}" required>
                    @error('nome') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Categoria *</label>
                    <input type="text" name="categoria" class="form-control @error('categoria') is-invalid @enderror" value="{{ old('categoria', $product->categoria) }}" required>
                    @error('categoria') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="4">{{ old('descricao', $product->descricao) }}</textarea>
                @error('descricao') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Quantidade *</label>
                    <input type="number" name="quantidade" class="form-control @error('quantidade') is-invalid @enderror" value="{{ old('quantidade', $product->quantidade) }}" min="0" required>
                    @error('quantidade') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Preço (R$) *</label>
                    <input type="number" name="preco" class="form-control @error('preco') is-invalid @enderror" value="{{ old('preco', $product->preco) }}" min="0" step="0.01" required>
                    @error('preco') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Estoque Mínimo *</label>
                    <input type="number" name="estoque_minimo" class="form-control @error('estoque_minimo') is-invalid @enderror" value="{{ old('estoque_minimo', $product->estoque_minimo) }}" min="0" required>
                    @error('estoque_minimo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Fornecedor *</label>
                    <input type="text" name="fornecedor" class="form-control @error('fornecedor') is-invalid @enderror" value="{{ old('fornecedor', $product->fornecedor) }}" required>
                    @error('fornecedor') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Atualizar Produto</button>
                <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection