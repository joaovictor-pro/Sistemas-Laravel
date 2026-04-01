@extends('layout')

@section('title', 'Novo Agendamento')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2>Criar Novo Agendamento</h2>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('agendamentos.store') }}" method="POST">
            @csrf

            <h5 class="mb-3">Dados do Cliente</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome do Cliente *</label>
                    <input type="text" name="cliente" class="form-control @error('cliente') is-invalid @enderror" value="{{ old('cliente') }}" required>
                    @error('cliente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email_cliente" class="form-control @error('email_cliente') is-invalid @enderror" value="{{ old('email_cliente') }}" required>
                    @error('email_cliente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefone *</label>
                    <input type="tel" name="telefone_cliente" class="form-control @error('telefone_cliente') is-invalid @enderror" value="{{ old('telefone_cliente') }}" placeholder="(00) 9 0000-0000" required>
                    @error('telefone_cliente') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Dados do Agendamento</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Serviço *</label>
                    <select name="servico" class="form-select @error('servico') is-invalid @enderror" required>
                        <option value="">-- Selecione um serviço --</option>
                        @foreach($servicos as $servico)
                            <option value="{{ $servico }}" @if(old('servico') === $servico) selected @endif>{{ $servico }}</option>
                        @endforeach
                    </select>
                    @error('servico') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Data *</label>
                    <input type="date" name="data" class="form-control @error('data') is-invalid @enderror" value="{{ old('data') }}" required>
                    @error('data') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Horário *</label>
                    <input type="time" name="horario" class="form-control @error('horario') is-invalid @enderror" value="{{ old('horario') }}" required>
                    @error('horario') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="pendente">Pendente</option>
                        <option value="confirmado">Confirmado</option>
                        <option value="em_atendimento">Em Atendimento</option>
                        <option value="concluido">Concluído</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                    @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Observações</label>
                <textarea name="observacao" class="form-control @error('observacao') is-invalid @enderror" rows="4">{{ old('observacao') }}</textarea>
                @error('observacao') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Criar Agendamento</button>
                <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection