<?php

use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Role;

//Candado directo y explícito en este archivo
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

Route::get('/', function(){
    return view("admin.dashboard");
})->name('dashboard');

//Gestión de roles
Route::resource('roles', RoleController::class);
});
