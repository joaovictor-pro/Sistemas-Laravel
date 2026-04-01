@extends('layout')

@section('title', 'Editar Agendamento')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2>Editar Agendamento</h2>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('agendamentos.update', $appointment) }}" method="POST">
            @csrf
            @method('PUT')

            <h5 class="mb-3">Dados do Cliente</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome do Cliente *</label>
                    <input type="text" name="cliente" class="form-control @error('cliente') is-invalid @enderror" value="{{ old('cliente', $appointment->cliente) }}" required>
                    @error('cliente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email_cliente" class="form-control @error('email_cliente') is-invalid @enderror" value="{{ old('email_cliente', $appointment->email_cliente) }}" required>
                    @error('email_cliente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefone *</label>
                    <input type="tel" name="telefone_cliente" class="form-control @error('telefone_cliente') is-invalid @enderror" value="{{ old('telefone_cliente', $appointment->telefone_cliente) }}" required>
                    @error('telefone_cliente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Dados do Agendamento</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Serviço *</label>
                    <select name="servico" class="form-select @error('servico') is-invalid @enderror" required>
                        @foreach($servicos as $servico)
                            <option value="{{ $servico }}" @if(old('servico', $appointment->servico) === $servico) selected @endif>{{ $servico }}</option>
                        @endforeach
                    </select>
                    @error('servico') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Data *</label>
                    <input type="date" name="data" class="form-control @error('data') is-invalid @enderror" value="{{ old('data', $appointment->data->format('Y-m-d')) }}" required>
                    @error('data') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Horário *</label>
                    <input type="time" name="horario" class="form-control @error('horario') is-invalid @enderror" value="{{ old('horario', $appointment->horario->format('H:i')) }}" required>
                    @error('horario') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="pendente" @if(old('status', $appointment->status) === 'pendente') selected @endif>Pendente</option>
                        <option value="confirmado" @if(old('status', $appointment->status) === 'confirmado') selected @endif>Confirmado</option>
                        <option value="em_atendimento" @if(old('status', $appointment->status) === 'em_atendimento') selected @endif>Em Atendimento</option>
                        <option value="concluido" @if(old('status', $appointment->status) === 'concluido') selected @endif>Concluído</option>
                        <option value="cancelado" @if(old('status', $appointment->status) === 'cancelado') selected @endif>Cancelado</option>
                    </select>
                    @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Observações</label>
                <textarea name="observacao" class="form-control @error('observacao') is-invalid @enderror" rows="4">{{ old('observacao', $appointment->observacao) }}</textarea>
                @error('observacao') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Atualizar Agendamento</button>
                <a href="{{ route('agendamentos.show', $appointment) }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection