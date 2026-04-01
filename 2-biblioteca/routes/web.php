<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\DashboardController;

// Home
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('home');

// ============ AUTENTICAÇÃO ============
Route::middleware('guest')->group(function () {
    Route::get('/cadastro', [AutenticacaoController::class, 'exibirCadastro'])->name('cadastro');
    Route::post('/cadastro', [AutenticacaoController::class, 'cadastrar'])->name('cadastro.submit');

    Route::get('/login', [AutenticacaoController::class, 'exibirLogin'])->name('login');
    Route::post('/login', [AutenticacaoController::class, 'fazer_login'])->name('login.submit');
});

Route::post('/logout', [AutenticacaoController::class, 'logout'])->name('logout')->middleware('auth');

// ============ ROTAS PROTEGIDAS ============
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ========== LIVROS ==========
    Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/livros/criar', [LivroController::class, 'create'])->name('livros.create');
    Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
    Route::get('/livros/{livro}', [LivroController::class, 'show'])->name('livros.show');
    Route::get('/livros/{livro}/editar', [LivroController::class, 'edit'])->name('livros.edit');
    Route::put('/livros/{livro}', [LivroController::class, 'update'])->name('livros.update');
    Route::delete('/livros/{livro}', [LivroController::class, 'destroy'])->name('livros.destroy');

    // ========== EMPRÉSTIMOS ==========
    Route::get('/emprestimos', [EmprestimoController::class, 'index'])->name('emprestimos.index');
    Route::get('/emprestimos/criar', [EmprestimoController::class, 'create'])->name('emprestimos.create');
    Route::post('/emprestimos', [EmprestimoController::class, 'store'])->name('emprestimos.store');
    Route::put('/emprestimos/{emprestimo}', [EmprestimoController::class, 'update'])->name('emprestimos.update');
    Route::get('/emprestimos/historico', [EmprestimoController::class, 'historico'])->name('emprestimos.historico');

    // ========== DISPONIBILIDADE ==========
    Route::get('/livros-disponibilidade', [EmprestimoController::class, 'consultarDisponibilidade'])->name('livros.disponibilidade');
});