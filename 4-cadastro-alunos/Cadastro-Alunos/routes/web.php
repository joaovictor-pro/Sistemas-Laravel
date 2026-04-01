<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
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

    // Alunos
    Route::get('/alunos', [StudentController::class, 'index'])->name('alunos.index');
    Route::get('/alunos/criar', [StudentController::class, 'create'])->name('alunos.create');
    Route::post('/alunos', [StudentController::class, 'store'])->name('alunos.store');
    Route::get('/alunos/{student}', [StudentController::class, 'show'])->name('alunos.show');
    Route::get('/alunos/{student}/editar', [StudentController::class, 'edit'])->name('alunos.edit');
    Route::put('/alunos/{student}', [StudentController::class, 'update'])->name('alunos.update');
    Route::delete('/alunos/{student}', [StudentController::class, 'destroy'])->name('alunos.destroy');
});