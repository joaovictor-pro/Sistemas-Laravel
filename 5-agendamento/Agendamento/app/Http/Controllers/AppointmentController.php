<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar agendamentos
    public function index(Request $request)
    {
        $filtro_data = $request->input('data');
        $filtro_status = $request->input('status');

        $agendamentos = Appointment::query();

        if ($filtro_data) {
            $agendamentos->porData($filtro_data);
        } else {
            $agendamentos->orderByDesc('data')->orderByDesc('horario');
        }

        if ($filtro_status && $filtro_status !== 'todos') {
            $agendamentos->where('status', $filtro_status);
        }

        $agendamentos = $agendamentos->paginate(15);

        return view('agendamentos.index', compact('agendamentos', 'filtro_data', 'filtro_status'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        $servicos = [
            'Corte de Cabelo',
            'Escova Progressiva',
            'Coloração',
            'Alisamento',
            'Penteado',
            'Limpeza de Pele',
            'Depilação',
            'Manicure',
            'Pedicure',
            'Massagem',
        ];

        return view('agendamentos.create', compact('servicos'));
    }

    // Salvar agendamento
    public function store(Request $request)
    {
        $validado = $request->validate([
            'cliente' => 'required|string|max:255',
            'email_cliente' => 'required|string|email|max:255',
            'telefone_cliente' => 'required|string|max:20',
            'servico' => 'required|string|max:100',
            'data' => 'required|date|after_or_equal:today',
            'horario' => 'required|date_format:H:i',
            'observacao' => 'nullable|string',
            'status' => 'required|in:pendente,confirmado,em_atendimento,concluido,cancelado',
        ], [
            'cliente.required' => 'O nome do cliente é obrigatório.',
            'email_cliente.required' => 'O email do cliente é obrigatório.',
            'email_cliente.email' => 'O email deve ser válido.',
            'telefone_cliente.required' => 'O telefone é obrigatório.',
            'servico.required' => 'O serviço é obrigatório.',
            'data.required' => 'A data é obrigatória.',
            'data.after_or_equal' => 'A data deve ser hoje ou no futuro.',
            'horario.required' => 'O horário é obrigatório.',
            'status.required' => 'O status é obrigatório.',
        ]);

        try {
            Appointment::create($validado);
            return redirect()->route('agendamentos.index')->with('sucesso', 'Agendamento criado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao criar agendamento: ' . $e->getMessage())->withInput();
        }
    }

    // Mostrar detalhes do agendamento
    public function show(Appointment $appointment)
    {
        return view('agendamentos.show', compact('appointment'));
    }

    // Mostrar formulário de edição
    public function edit(Appointment $appointment)
    {
        $servicos = [
            'Corte de Cabelo',
            'Escova Progressiva',
            'Coloração',
            'Alisamento',
            'Penteado',
            'Limpeza de Pele',
            'Depilação',
            'Manicure',
            'Pedicure',
            'Massagem',
        ];

        return view('agendamentos.edit', compact('appointment', 'servicos'));
    }

    // Atualizar agendamento
    public function update(Request $request, Appointment $appointment)
    {
        $validado = $request->validate([
            'cliente' => 'required|string|max:255',
            'email_cliente' => 'required|string|email|max:255',
            'telefone_cliente' => 'required|string|max:20',
            'servico' => 'required|string|max:100',
            'data' => 'required|date|after_or_equal:today',
            'horario' => 'required|date_format:H:i',
            'observacao' => 'nullable|string',
            'status' => 'required|in:pendente,confirmado,em_atendimento,concluido,cancelado',
        ]);

        try {
            $appointment->update($validado);
            return redirect()->route('agendamentos.show', $appointment)->with('sucesso', 'Agendamento atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao atualizar agendamento: ' . $e->getMessage())->withInput();
        }
    }

    // Deletar agendamento
    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();
            return redirect()->route('agendamentos.index')->with('sucesso', 'Agendamento deletado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao deletar agendamento: ' . $e->getMessage());
        }
    }

    // Mudar status do agendamento
    public function mudarStatus(Request $request, Appointment $appointment)
    {
        $validado = $request->validate([
            'status' => 'required|in:pendente,confirmado,em_atendimento,concluido,cancelado',
        ]);

        try {
            $appointment->update(['status' => $validado['status']]);
            return back()->with('sucesso', 'Status atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao atualizar status: ' . $e->getMessage());
        }
    }

    // Agendamentos de hoje
    public function hoje()
    {
        $agendamentos = Appointment::hoje()->orderBy('horario')->paginate(15);
        return view('agendamentos.hoje', compact('agendamentos'));
    }

    // Agendamentos futuros
    public function futuros()
    {
        $agendamentos = Appointment::futuros()->paginate(15);
        return view('agendamentos.futuros', compact('agendamentos'));
    }
}