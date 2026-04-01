@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Dashboard</h2>
        <p class="text-muted">Bem-vindo ao Sistema de Controle de Estoque</p>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title">Total de Produtos</h6>
                <h2>{{ \App\Models\Product::count() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h6 class="card-title">Estoque Baixo</h6>
                <h2>{{ \App\Models\Product::whereRaw('quantidade <= estoque_minimo')->count() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6 class="card-title">Valor Total em Estoque</h6>
                <h2>R$ {{ number_format(\App\Models\Product::selectRaw('SUM(quantidade * preco) as total')->first()->total ?? 0, 2, ',', '.') }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6 class="card-title">Categorias</h6>
                <h2>{{ \App\Models\Product::distinct('categoria')->count('categoria') }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Produtos com Estoque Baixo</h5>
            </div>
            <div class="card-body">
                @php
                    $produtosBaixo = \App\Models\Product::whereRaw('quantidade <= estoque_minimo')->take(5)->get();
                @endphp
                @forelse($produtosBaixo as $produto)
                    <div class="mb-2 pb-2 border-bottom">
                        <strong>{{ $produto->nome }}</strong>
                        <span class="badge bg-danger">{{ $produto->quantidade }} unidades</span>
                    </div>
                @empty
                    <p class="text-muted">Nenhum produto com estoque baixo</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ações Rápidas</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('produtos.create') }}" class="btn btn-primary w-100 mb-2">Adicionar Novo Produto</a>
                <a href="{{ route('produtos.index') }}" class="btn btn-info w-100 mb-2">Ver Todos os Produtos</a>
                <a href="{{ route('produtos.estoque-baixo') }}" class="btn btn-warning w-100">Ver Estoque Baixo</a>
            </div>
        </div>
    </div>
</div>
@endsection