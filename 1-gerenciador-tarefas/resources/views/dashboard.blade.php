@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Minhas Tarefas</h1>
            <p class="text-muted">Organize e acompanhe suas atividades</p>
        </div>
    </div>

       <!-- FILTRO POR STATUS -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Filtrar por Status</h5>
                </div>
                <div class="card-body">
                    <div class="btn-group" role="group">
                        <a href="{{ route('dashboard') }}" 
                           class="btn btn-outline-primary {{ request('status') ? '' : 'active' }}">
                            Todas ({{ $tarefas->count() }})
                        </a>
                        <a href="{{ route('dashboard', ['status' => 'pendentes']) }}" 
                           class="btn btn-outline-warning {{ request('status') === 'pendentes' ? 'active' : '' }}">
                            Pendentes ({{ $tarefas->where('status', 'pendente')->count() }})
                        </a>
                        <a href="{{ route('dashboard', ['status' => 'em_andamento']) }}" 
                           class="btn btn-outline-info {{ request('status') === 'em_andamento' ? 'active' : '' }}">
                            Em andamento ({{ $tarefas->where('status', 'em_andamento')->count() }})
                        </a>
                        <a href="{{ route('dashboard', ['status' => 'concluidas']) }}" 
                           class="btn btn-outline-success {{ request('status') === 'concluidas' ? 'active' : '' }}">
                            Concluídas ({{ $tarefas->where('status', 'concluida')->count() }})
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- FORMULÁRIO -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Nova Tarefa</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cadastrar.tarefa') }}" novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    name="titulo" 
                                    id="titulo"
                                    class="form-control @error('titulo') is-invalid @enderror" 
                                    placeholder="Ex: Estudar Laravel"
                                    required>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="prioridade" class="form-label">Prioridade <span class="text-danger">*</span></label>
                                <select name="prioridade" id="prioridade" class="form-select @error('prioridade') is-invalid @enderror" required>
                                    <option value="">Selecione uma prioridade</option>
                                    <option value="baixa">Baixa</option>
                                    <option value="media">Média</option>
                                    <option value="alta">Alta</option>
                                </select>
                                @error('prioridade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pendente">Pendente</option>
                                    <option value="em_andamento">Em andamento</option>
                                    <option value="concluida">Concluída</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="data_entrega" class="form-label">Data de entrega</label>
                                <input 
                                    type="date" 
                                    name="data_entrega" 
                                    id="data_entrega"
                                    class="form-control @error('data_entrega') is-invalid @enderror">
                                @error('data_entrega')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea 
                                name="descricao" 
                                id="descricao"
                                class="form-control @error('descricao') is-invalid @enderror"
                                rows="3"
                                placeholder="Descreva os detalhes da tarefa..."></textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Cadastrar Tarefa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- LISTA DE TAREFAS -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Lista de Tarefas</h5>
                </div>

                <div class="card-body">
                    @if($tarefas->isEmpty())
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle"></i>
                            <strong>Nenhuma tarefa cadastrada.</strong> Crie uma nova tarefa para começar!
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Título</th>
                                        <th>Descrição</th>
                                        <th>Status</th>
                                        <th>Prioridade</th>
                                        <th>Entrega</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tarefas as $tarefa)
                                        <tr>
                                            <td><strong>#{{ $tarefa->id }}</strong></td>
                                            <td>
                                                <strong>{{ $tarefa->titulo }}</strong>
                                            </td>
                                            <td>
                                                {{ Str::limit($tarefa->descricao, 30) ?? '-' }}
                                            </td>
                                            <td>
                                                @if($tarefa->status === 'pendente')
                                                    <span class="badge bg-warning">⏳ Pendente</span>
                                                @elseif($tarefa->status === 'em_andamento')
                                                    <span class="badge bg-info">Em andamento</span>
                                                @elseif($tarefa->status === 'concluida')
                                                    <span class="badge bg-success">Concluída</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($tarefa->prioridade === 'alta')
                                                    <span class="badge bg-danger">Alta</span>
                                                @elseif($tarefa->prioridade === 'media')
                                                    <span class="badge bg-warning">Média</span>
                                                @elseif($tarefa->prioridade === 'baixa')
                                                    <span class="badge bg-success">Baixa</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $tarefa->data_entrega 
                                                    ? \Carbon\Carbon::parse($tarefa->data_entrega)->format('d/m/Y') 
                                                    : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <!-- Botão Editar -->
                                                <button 
                                                    type="button" 
                                                    class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editarTarefaModal{{ $tarefa->id }}"
                                                    title="Editar tarefa">
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>

                                                <!-- Botão Concluir -->
                                                @if($tarefa->status !== 'concluida')
                                                    <form 
                                                        method="POST" 
                                                        action="{{ route('tarefas.concluir', $tarefa->id) }}"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button 
                                                            type="submit" 
                                                            class="btn btn-sm btn-success"
                                                            title="Marcar como concluída">
                                                            <i class="bi bi-check-circle"></i> Concluir
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Botão Deletar -->
                                                <form 
                                                    method="POST" 
                                                    action="{{ route('tarefas.destroy', $tarefa->id) }}"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Tem certeza que deseja deletar esta tarefa?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-sm btn-danger"
                                                        title="Deletar tarefa">
                                                        <i class="bi bi-trash"></i> Deletar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Editar -->
                                        <div class="modal fade" id="editarTarefaModal{{ $tarefa->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Tarefa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('tarefas.update', $tarefa->id) ?? '#' }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Título</label>
                                                                <input type="text" name="titulo" class="form-control" value="{{ $tarefa->titulo }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Descrição</label>
                                                                <textarea name="descricao" class="form-control" rows="3">{{ $tarefa->descricao }}</textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select name="status" class="form-select">
                                                                    <option value="pendente" {{ $tarefa->status === 'pendente' ? 'selected' : '' }}>Pendente</option>
                                                                    <option value="em_andamento" {{ $tarefa->status === 'em_andamento' ? 'selected' : '' }}>Em andamento</option>
                                                                    <option value="concluida" {{ $tarefa->status === 'concluida' ? 'selected' : '' }}>Concluída</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Prioridade</label>
                                                                <select name="prioridade" class="form-select">
                                                                    <option value="baixa" {{ $tarefa->prioridade === 'baixa' ? 'selected' : '' }}>Baixa</option>
                                                                    <option value="media" {{ $tarefa->prioridade === 'media' ? 'selected' : '' }}>Média</option>
                                                                    <option value="alta" {{ $tarefa->prioridade === 'alta' ? 'selected' : '' }}>Alta</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Data de entrega</label>
                                                                <input type="date" name="data_entrega" class="form-control" value="{{ $tarefa->data_entrega }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        border-radius: 8px;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>

@endsection