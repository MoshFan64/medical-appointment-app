<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.users.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view("admin.users.create", compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos que vienen del formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // 2. Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'id_number' => $request->id_number,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'role'      => $request->role
        ]);

        // 3. Asignar el rol (usando Spatie)
        $user->assignRole($request->role);

        // 4. AQUÍ VA TU BLOQUE IF
        if ($user->hasRole('Paciente')) {
            // Creamos el registro en la tabla pacientes
            $patient = $user->patient()->create();

            // Redirigimos a completar su perfil médico
            return redirect()->route('admin.patients.edit', $patient)
                            ->with('info', 'Usuario creado como paciente. Por favor, complete su información.');
        }

        // Si no es paciente, regresamos al índice de usuarios
        return redirect()->route('admin.users.index')
                        ->with('info', 'Usuario creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view("admin.users.edit", compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // 1. Validar los datos
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'id_number' => 'required',
        'phone' => 'required',
        'role' => 'required' // Asegúrate de que el select en tu vista se llame "role"
    ]);

    // 2. Actualizar datos básicos del usuario
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'id_number' => $request->id_number,
        'phone' => $request->phone,
        'address' => $request->address,
    ]);

    // 3. ¡IMPORTANTE! Sincronizar el rol antes de preguntar por él
    $user->syncRoles($request->role);

    // 4. Lógica de redirección
    // Usamos el usuario actualizado para verificar el rol recién asignado
    if ($user->hasRole('Paciente')) {

        // Verificamos si ya existe el registro de paciente para no duplicarlo
        if (!$user->patient) {
            $user->patient()->create();
        }

        return redirect()->route('admin.users.index')
            ->with('info', 'Usuario actualizado y vinculado como Paciente.');
    }

    return redirect()->route('admin.users.index')
        ->with('info', 'Usuario actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
