@extends('layout')

@section('title', 'Agendamentos')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Agendamentos</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('agendamentos.create') }}" class="btn btn-primary">Novo Agendamento</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('agendamentos.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Data</label>
                <input type="date" name="data" class="form-control" value="{{ $filtro_data }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">-- Todos --</option>
                    <option value="pendente" @if($filtro_status === 'pendente') selected @endif>Pendente</option>
                    <option value="confirmado" @if($filtro_status === 'confirmado') selected @endif>Confirmado</option>
                    <option value="em_atendimento" @if($filtro_status === 'em_atendimento') selected @endif>Em Atendimento</option>
                    <option value="concluido" @if($filtro_status === 'concluido') selected @endif>Concluído</option>
                    <option value="cancelado" @if($filtro_status === 'cancelado') selected @endif>Cancelado</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-info w-100">Buscar</button>
            </div>
        </form>
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
                            <a href="{{ route('agendamentos.show', $agendamento) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('agendamentos.edit', $agendamento) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('agendamentos.destroy', $agendamento) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">Nenhum agendamento encontrado</td>
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