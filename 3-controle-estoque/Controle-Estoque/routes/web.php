<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Redirecionar raiz para login ou dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard.index') : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/cadastro', [AuthController::class, 'register'])->name('register.store');
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Produtos
    Route::get('/produtos', [ProductController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/criar', [ProductController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [ProductController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/{product}/editar', [ProductController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/{product}', [ProductController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{product}', [ProductController::class, 'destroy'])->name('produtos.destroy');
    Route::get('/estoque-baixo', [ProductController::class, 'estoqueBaixo'])->name('produtos.estoque-baixo');
    Route::post('/produtos/{product}/atualizar-quantidade', [ProductController::class, 'atualizarQuantidade'])->name('produtos.atualizar-quantidade');
});