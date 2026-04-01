@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Dashboard</h2>
        <p class="text-muted">Bem-vindo ao Sistema de Cadastro de Alunos</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title">Total de Alunos</h6>
                <h2>{{ \App\Models\Student::count() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6 class="card-title">Cursos</h6>
                <h2>{{ \App\Models\Student::distinct('curso')->count('curso') }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6 class="card-title">Idade Média</h6>
                <h2>{{ round(\App\Models\Student::selectRaw('AVG(YEAR(CURDATE()) - YEAR(data_nascimento)) as idade_media')->first()->idade_media ?? 0) }} anos</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ações Rápidas</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('alunos.create') }}" class="btn btn-primary">Adicionar Novo Aluno</a>
                <a href="{{ route('alunos.index') }}" class="btn btn-info">Ver Todos os Alunos</a>
            </div>
        </div>
    </div>
</div>
@endsection