<?php

use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Livewire\Admin\ConsultationManager;
use Illuminate\Support\Facades\Route;

// Candado global de seguridad para todo el panel de administración
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Dashboard Principal
    Route::get('/', function(){
        return view("admin.dashboard");
    })->name('dashboard');

    // Gestión de accesos, roles y usuarios
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    // Módulos Médicos Core
    Route::resource('patients', PatientController::class);
    Route::resource('doctors', DoctorController::class);

    // Módulo de Citas (Appointments)
    Route::resource('appointments', AppointmentController::class);

    // Ruta dedicada de Livewire para la atención de consultas médicas
    Route::get('appointments/{appointment}/consultation', ConsultationManager::class)
        ->name('appointments.consultation');

    // Módulo de Convenios de Seguros Médicos
    Route::get('insurances', [InsuranceController::class, 'index'])->name('insurances.index');
    Route::post('insurances', [InsuranceController::class, 'store'])->name('insurances.store');
});
