<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\DashboardController;

// Página inicial → LOGIN
Route::get('/', [AutenticacaoController::class, 'exibirLogin'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// AUTENTICAÇÃO 
Route::middleware('guest')->group(function () {

    Route::get('/cadastro', [AutenticacaoController::class, 'exibirCadastro'])->name('cadastro');
    Route::post('/cadastro', [AutenticacaoController::class, 'cadastrar'])->name('cadastro.submit');

    Route::get('/login', [AutenticacaoController::class, 'exibirLogin'])->name('login');
    Route::post('/login', [AutenticacaoController::class, 'fazer_login'])->name('login.submit');

});

Route::post('/tarefa', [DashboardController::class, 'cadastrarTarefa'])
    ->name('cadastrar.tarefa')
    ->middleware('auth');

Route::post('/logout', [AutenticacaoController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::delete('/tarefas/{id}', [DashboardController::class, 'destroy'])->name('tarefas.destroy');
Route::patch('/tarefas/{id}/concluir', [DashboardController::class, 'concluir'])->name('tarefas.concluir');
Route::put('/tarefas/{id}', [DashboardController::class, 'update'])->name('tarefas.update')->middleware('auth');