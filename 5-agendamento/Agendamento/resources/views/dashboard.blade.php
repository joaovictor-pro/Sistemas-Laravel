@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Dashboard</h2>
        <p class="text-muted">Bem-vindo ao Sistema de Agendamento</p>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title">Total de Agendamentos</h6>
                <h2>{{ \App\Models\Appointment::count() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6 class="card-title">Agendamentos Hoje</h6>
                <h2>{{ \App\Models\Appointment::hoje()->count() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h6 class="card-title">Pendentes</h6>
                <h2>{{ \App\Models\Appointment::where('status', 'pendente')->count() }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6 class="card-title">Concluídos</h6>
                <h2>{{ \App\Models\Appointment::where('status', 'concluido')->count() }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Agendamentos de Hoje</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Horário</th>
                            <th>Cliente</th>
                            <th>Serviço</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $agendamentos_hoje = \App\Models\Appointment::hoje()->orderBy('horario')->take(5)->get();
                        @endphp
                        @forelse($agendamentos_hoje as $agendamento)
                            <tr>
                                <td><strong>{{ $agendamento->horario->format('H:i') }}</strong></td>
                                <td>{{ $agendamento->cliente }}</td>
                                <td>{{ $agendamento->servico }}</td>
                                <td>
                                    <span class="badge badge-status bg-{{ $agendamento->status_color }}">
                                        {{ $agendamento->status_label }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('agendamentos.show', $agendamento) }}" class="btn btn-sm btn-info">Ver</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted p-3">Nenhum agendamento para hoje</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
                <a href="{{ route('agendamentos.create') }}" class="btn btn-primary">Novo Agendamento</a>
                <a href="{{ route('agendamentos.hoje') }}" class="btn btn-info">Ver Agendamentos de Hoje</a>
                <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Ver Todos os Agendamentos</a>
            </div>
        </div>
    </div>
</div>
@endsection