@extends('layout')

@section('title', 'Agendamentos Futuros')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Agendamentos Futuros</h2>
        <p class="text-muted">Próximos agendamentos confirmados</p>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Data/Hora</th>
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
                        <td>
                            <strong>{{ $agendamento->data->format('d/m/Y') }}</strong><br>
                            <small class="text-muted">{{ $agendamento->horario->format('H:i') }}</small>
                        </td>
                        <td>{{ $agendamento->cliente }}</td>
                        <td>{{ $agendamento->telefone_cliente }}</td>
                        <td>{{ $agendamento->servico }}</td>
                        <td>
                            <span class="badge badge-status bg-{{ $agendamento->status_color }}">
                                {{ $agendamento->status_label }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('agendamentos.show', $agendamento) }}" class="btn btn-sm btn-info">👁️ Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">Nenhum agendamento futuro</td>
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