<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\DoctorController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Role;

//Candado directo y explícito en este archivo
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

Route::get('/', function(){
    return view("admin.dashboard");
})->name('dashboard');

//Gestión de roles
Route::resource('roles', RoleController::class);
//Gestión de usuarios
Route::resource('users', UserController::class);
});
//Gestión de pacientes
Route::resource('patients', PatientController::class);
//Gestión de doctores
Route::resource('doctors', DoctorController::class);
