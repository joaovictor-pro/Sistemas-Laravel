<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Exibir o dashboard com lista de tarefas
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->query('status');

        // Filtrar tarefas por status
        $query = $user->tarefas();

        if ($status === 'concluidas') {
            $query->where('status', 'concluida');
        } elseif ($status === 'pendentes') {
            $query->where('status', 'pendente');
        } elseif ($status === 'em_andamento') {
            $query->where('status', 'em_andamento');
        }

        $tarefas = $query->orderBy('prioridade', 'desc')
                         ->orderBy('data_entrega', 'asc')
                         ->get();

        return view('dashboard', compact('tarefas'));
    }

    /**
     * Cadastrar uma nova tarefa
     */
    public function cadastrarTarefa(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'status' => 'required|in:pendente,em_andamento,concluida',
            'prioridade' => 'required|in:baixa,media,alta',
            'data_entrega' => 'nullable|date|after_or_equal:today',
        ], [
            'titulo.required' => 'O título é obrigatório',
            'titulo.max' => 'O título não pode ter mais de 255 caracteres',
            'status.in' => 'Status inválido',
            'prioridade.in' => 'Prioridade inválida',
            'data_entrega.after_or_equal' => 'A data de entrega não pode ser no passado',
        ]);

        try {
            Auth::user()->tarefas()->create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'status' => $request->status,
                'prioridade' => $request->prioridade,
                'data_entrega' => $request->data_entrega,
            ]);

            return redirect()->route('dashboard')->with('success', ' Tarefa cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ' Erro ao cadastrar tarefa: ' . $e->getMessage());
        }
    }

    /**
     * Atualizar uma tarefa existente
     */
    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);

        // Verificar se o usuário é o dono da tarefa
        if ($tarefa->user_id !== Auth::id()) {
            return redirect()->back()->with('error', ' Você não tem permissão para editar esta tarefa');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
            'status' => 'required|in:pendente,em_andamento,concluida',
            'prioridade' => 'required|in:baixa,media,alta',
            'data_entrega' => 'nullable|date|after_or_equal:today',
        ], [
            'titulo.required' => 'O título é obrigatório',
            'titulo.max' => 'O título não pode ter mais de 255 caracteres',
            'status.in' => 'Status inválido',
            'prioridade.in' => 'Prioridade inválida',
            'data_entrega.after_or_equal' => 'A data de entrega não pode ser no passado',
        ]);

        try {
            $tarefa->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'status' => $request->status,
                'prioridade' => $request->prioridade,
                'data_entrega' => $request->data_entrega,
            ]);

            return redirect()->route('dashboard')->with('success', ' Tarefa atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ' Erro ao atualizar tarefa: ' . $e->getMessage());
        }
    }

    /**
     * Deletar uma tarefa
     */
    public function destroy($id)
    {
        $tarefa = Tarefa::findOrFail($id);

        // Verificar se o usuário é o dono da tarefa
        if ($tarefa->user_id !== Auth::id()) {
            return redirect()->back()->with('error', ' Você não tem permissão para deletar esta tarefa');
        }

        try {
            $tarefa->delete();
            return redirect()->route('dashboard')->with('success', ' Tarefa deletada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ' Erro ao deletar tarefa: ' . $e->getMessage());
        }
    }

    /**
     * Marcar uma tarefa como concluída
     */
    public function concluir($id)
    {
        $tarefa = Tarefa::findOrFail($id);

        // Verificar se o usuário é o dono da tarefa
        if ($tarefa->user_id !== Auth::id()) {
            return redirect()->back()->with('error', ' Você não tem permissão para concluir esta tarefa');
        }

        try {
            $tarefa->update(['status' => 'concluida']);
            return redirect()->back()->with('success', ' Tarefa marcada como concluída!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ' Erro ao concluir tarefa: ' . $e->getMessage());
        }
    }

    /**
     * Restaurar uma tarefa (desconcluir)
     */
    public function restaurar($id)
    {
        $tarefa = Tarefa::findOrFail($id);

        // Verificar se o usuário é o dono da tarefa
        if ($tarefa->user_id !== Auth::id()) {
            return redirect()->back()->with('error', ' Você não tem permissão para restaurar esta tarefa');
        }

        try {
            $tarefa->update(['status' => 'pendente']);
            return redirect()->back()->with('success', ' Tarefa restaurada!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao restaurar tarefa: ' . $e->getMessage());
        }
    }
}