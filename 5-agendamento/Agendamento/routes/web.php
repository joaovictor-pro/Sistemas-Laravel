<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
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

    // Agendamentos
    Route::get('/agendamentos', [AppointmentController::class, 'index'])->name('agendamentos.index');
    Route::get('/agendamentos/criar', [AppointmentController::class, 'create'])->name('agendamentos.create');
    Route::post('/agendamentos', [AppointmentController::class, 'store'])->name('agendamentos.store');
    Route::get('/agendamentos/{appointment}', [AppointmentController::class, 'show'])->name('agendamentos.show');
    Route::get('/agendamentos/{appointment}/editar', [AppointmentController::class, 'edit'])->name('agendamentos.edit');
    Route::put('/agendamentos/{appointment}', [AppointmentController::class, 'update'])->name('agendamentos.update');
    Route::delete('/agendamentos/{appointment}', [AppointmentController::class, 'destroy'])->name('agendamentos.destroy');
    Route::post('/agendamentos/{appointment}/status', [AppointmentController::class, 'mudarStatus'])->name('agendamentos.status');
    
    Route::get('/agendamentos-hoje', [AppointmentController::class, 'hoje'])->name('agendamentos.hoje');
    Route::get('/agendamentos-futuros', [AppointmentController::class, 'futuros'])->name('agendamentos.futuros');
});