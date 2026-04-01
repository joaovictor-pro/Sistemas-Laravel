<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Listar alunos
    public function index(Request $request)
    {
        $busca = $request->input('busca');
        
        if ($busca) {
            $alunos = Student::where('nome', 'like', "%{$busca}%")
                            ->orWhere('email', 'like', "%{$busca}%")
                            ->orWhere('matricula', 'like', "%{$busca}%")
                            ->paginate(10);
        } else {
            $alunos = Student::paginate(10);
        }

        return view('alunos.index', compact('alunos', 'busca'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view('alunos.create');
    }

    // Salvar aluno
    public function store(Request $request)
    {
        $validado = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date|before:today',
            'curso' => 'required|string|max:100',
            'matricula' => 'required|string|max:50|unique:students',
            'observacoes' => 'nullable|string',
        ], [
            'nome.required' => 'O nome do aluno é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'Este email já está cadastrado.',
            'telefone.required' => 'O telefone é obrigatório.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.before' => 'A data de nascimento deve ser no passado.',
            'curso.required' => 'O curso é obrigatório.',
            'matricula.required' => 'A matrícula é obrigatória.',
            'matricula.unique' => 'Esta matrícula já está cadastrada.',
        ]);

        try {
            Student::create($validado);
            return redirect()->route('alunos.index')->with('sucesso', 'Aluno cadastrado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao salvar aluno: ' . $e->getMessage())->withInput();
        }
    }

    // Visualizar detalhes do aluno
    public function show(Student $student)
    {
        return view('alunos.show', compact('student'));
    }

    // Mostrar formulário de edição
    public function edit(Student $student)
    {
        return view('alunos.edit', compact('student'));
    }

    // Atualizar aluno
    public function update(Request $request, Student $student)
    {
        $validado = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date|before:today',
            'curso' => 'required|string|max:100',
            'matricula' => 'required|string|max:50|unique:students,matricula,' . $student->id,
            'observacoes' => 'nullable|string',
        ]);

        try {
            $student->update($validado);
            return redirect()->route('alunos.show', $student)->with('sucesso', 'Aluno atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao atualizar aluno: ' . $e->getMessage())->withInput();
        }
    }

    // Deletar aluno
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('alunos.index')->with('sucesso', 'Aluno deletado com sucesso!');
        } catch (\Exception $e) {
            return back()->withErrors('Erro ao deletar aluno: ' . $e->getMessage());
        }
    }
}