<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Emprestimo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalLivros = Livro::count();
        $totalUsuarios = Usuario::count();
        $emprestimosAtivos = Emprestimo::where('status', 'ativo')->count();
        $emprestimosDevolve = Emprestimo::where('status', 'devolvido')->count();

        $livrosPopulares = Livro::withCount('emprestimos')
            ->orderByDesc('emprestimos_count')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalLivros',
            'totalUsuarios',
            'emprestimosAtivos',
            'emprestimosDevolve',
            'livrosPopulares'
        ));
    }
}