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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
