<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.roles.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.roles.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Valida que se cree bien
        $request->validate(['name' => 'required|unique:roles,name']);

        //Si pasa la validación, creará el rol
        Role::create(['name'=> $request->name]);

        //Confirmación de operación exitosa
        session()->flash('swal', ['icon' => 'success', 'title' => 'Rol creado correctamente',
        'text' => 'El rol ha sido creado correctamente.']);

        //Redireccionará a la tabla principal
        return redirect(route('admin.roles.index'))->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //Valida que se inserte bien y que excluya la fila que se edita
        $request->validate(['name' => 'required|unique:roles,name,']);

        //Si pasa la validación, actualizará el rol
        $role->update(['name' => $request->name]);

        //Confirmación de operación exitosa
        session()->flash('swal', ['icon' => 'success', 'title' => 'Rol actualizado correctamente',
        'text' => 'El rol ha sido actualizado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //1.- Definir los roles protegidos
        $protectedRoles = ['', '', '', '', ''];

        //Borrar el elemento
        $role->delete();

        //2.- Revisar si el rol actual está protegido
        if(in_array($role->id, $protectedRoles)){
            session()->flash('swal', [
                'icon'=> 'error', 'title'=> 'Error',
                'text'=> 'No puedes eliminar este rol.']);
            return redirect()->route('admin.roles.index');
        }

        //Confirmación de eliminación exitosa
        if($role->delete <=5){
            session()->flash('swal', [
                'icon'=> 'success', 'title'=> 'Rol eliminado correctamente.',
                'text'=> 'El rol ha sido eliminado correctamente.'
            ]);
            return redirect()->route('admin.roles.index');
        }
    }
}
