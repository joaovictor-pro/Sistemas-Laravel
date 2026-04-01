@extends('layout')

@section('title', 'Detalhes do Agendamento')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2>{{ $appointment->cliente }}</h2>
        <p class="text-muted">Agendamento para {{ $appointment->data->format('d/m/Y') }} às {{ $appointment->horario->format('H:i') }}</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('agendamentos.edit', $appointment) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('agendamentos.destroy', $appointment) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?')"> Deletar</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Informações do Agendamento</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Cliente:</strong>
                        <p>{{ $appointment->cliente }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p>{{ $appointment->email_cliente }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Telefone:</strong>
                        <p>{{ $appointment->telefone_cliente }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Serviço:</strong>
                        <p>{{ $appointment->servico }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Data:</strong>
                        <p>{{ $appointment->data->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Horário:</strong>
                        <p>{{ $appointment->horario->format('H:i') }}</p>
                    </div>
                </div>

                @if($appointment->observacao)
                    <div class="mb-3">
                        <strong>Observações:</strong>
                        <p>{{ $appointment->observacao }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Status do Atendimento</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <p class="mb-2">
                        <strong>Status Atual:</strong>
                        <span class="badge badge-status bg-{{ $appointment->status_color }} fs-6">
                            {{ $appointment->status_label }}
                        </span>
                    </p>
                </div>

                <form action="{{ route('agendamentos.status', $appointment) }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-8">
                        <select name="status" class="form-select">
                            <option value="pendente" @if($appointment->status === 'pendente') selected @endif>Pendente</option>
                            <option value="confirmado" @if($appointment->status === 'confirmado') selected @endif>Confirmado</option>
                            <option value="em_atendimento" @if($appointment->status === 'em_atendimento') selected @endif>Em Atendimento</option>
                            <option value="concluido" @if($appointment->status === 'concluido') selected @endif>Concluído</option>
                            <option value="cancelado" @if($appointment->status === 'cancelado') selected @endif>Cancelado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Atualizar Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Timeline</h5>
            </div>
            <div class="card-body">
                <p class="small">
                    <strong>Criado em:</strong><br>
                    {{ $appointment->created_at->format('d/m/Y H:i') }}
                </p>
                <p class="small">
                    <strong>Última atualização:</strong><br>
                    {{ $appointment->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">← Voltar</a>
</div>
@endsection