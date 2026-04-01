@extends('layout')

@section('title', 'Agendamentos de Hoje')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Agendamentos de Hoje</h2>
        <p class="text-muted">{{ now()->format('d/m/Y - l') }}</p>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Horário</th>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Serviço</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendamentos as $agendamento)
                    <tr>
                        <td><strong>{{ $agendamento->horario->format('H:i') }}</strong></td>
                        <td>{{ $agendamento->cliente }}</td>
                        <td>{{ $agendamento->telefone_cliente }}</td>
                        <td>{{ $agendamento->servico }}</td>
                        <td>
                            <span class="badge badge-status bg-{{ $agendamento->status_color }}">
                                {{ $agendamento->status_label }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('agendamentos.show', $agendamento) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('agendamentos.edit', $agendamento) }}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">Nenhum agendamento para hoje</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $agendamentos->links() }}
</div>
@endsection