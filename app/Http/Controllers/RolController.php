<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10); //mostrame los datos de la tabla rol
        // dd($roles);
        $permisos = Permission::paginate(20);
        return view('VistasRol.indexd', compact('permisos', 'roles')); //retornamos la vista y le pasamos los datos de la tabla rol
    }
    public function create(){
        $permissions = Permission::all()->pluck('name','id'); //obtenemos todos los permisos de la tabla permiso y los pasamos a una variable
        // dd($permisos);
        return view('VistasRol.create', compact('permissions')); //retornamos la vista y le pasamos los datos de la variable permisos
    }

    public function store(Request $request){
        // dd($request->all());
        $role = Role::create($request->only('name')); //creamos un nuevo rol con los datos que nos lleguen del formulario
        // dd($request->permissions);
        $role->permissions()->sync($request->input('permissions',[])); //asignamos los permisos que nos lleguen del formulario
        // dd($role);
        return redirect()->route('Rol.index'); //retornamos a la vista index
    }


    public function edit($id){
        $role = Role::find($id); //obtenemos el rol que nos llega por parametro
        $permissions = Permission::all()->pluck('name','id'); //obtenemos todos los permisos de la tabla permiso y los pasamos a una variable
        $role->load('permissions'); //cargamos los permisos del rol
        // dd($role);
        return view('VistasRol.edit', compact('role', 'permissions')); //retornamos la vista y le pasamos los datos de la variable permisos

    }

    public function update($id,Request $request,Role $role){
    $role = Role::find($id); //obtenemos el rol que nos llega por parametro
    $role->update($request->only('name')); //actualizamos el rol con los datos que nos lleguen del formulario
    $role->permissions()->sync($request->input('permissions',[])); //asignamos los permisos que nos lleguen del formulario
    // dd($role);
    return redirect()->route('Rol.index'); //retornamos a la vista index
    }


    public function destroy($id){
        $Rol = Role::find($id);
        $Rol->delete();
        return redirect()->Route('Rol.index');
    }

/////////////////////////////////////////////////////// metodos para asignar permisos a un rol
    public function crearPermisos(){
        return view('VistasRol.crearPermisos');
    }
    public function storePermisos(Request $request, Permission $p){
        $p = Permission::create($request->only('name'));
        return redirect()->Route('Rol.index');
    }
    public function editPermisos($id){
        $permiso = Permission::find($id);
        return view('VistasRol.editPermisos', compact('permiso'));
    }
    public function updatePermisos($id, Permission $p, Request $request){
        $p = Permission::find($id);
        // dd($request->all());
        $p->update($request->only('name'));

        return redirect()->Route('Rol.index');
    }
    public function deletePermisos($p){
        $permiso = Permission::find($p);
        $permiso->delete();
        return redirect()->Route('Rol.index');
    }
}
