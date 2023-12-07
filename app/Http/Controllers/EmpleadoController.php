<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PDF;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\;modelHasRole
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mostrar todos los empleados habilitados
        $empleados = Empleado::where('estado', 'Habilitado')
            ->where('ci', '<>', '9000002')->get();

        return view('VistaEmpleados.index', compact('empleados'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all()->pluck('name', 'id');
        return view('VistaEmpleados.create1', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // dd($r);
        $roles = $r->input('roles', []);

        $user = new User();
        $user->nombre_usuario = $r->usuario;
        $user->correo_electronico = $r->correo;
        $user->password = Hash::make($r->password);
        $user->created_at = now();
        $user->updated_at = now();
        $user->syncRoles($roles);
        $user->save();

        $emp = new Empleado();
        $emp->ci = $r->ci;
        $emp->nombre = $r->nombre;
        $emp->telefono =  $r->telefono;
        $id_user = User::where('nombre_usuario', $user->nombre_usuario)
            ->first();
        $emp->id_usuario = $id_user->id;
        $emp->estado = 'Habilitado';
        $emp->save();

        return redirect()->route('Empleado.index');
    }

    public function storeAPi(Request $r)
    {
        // dd($r);
        // $roles = $r->input('roles', []);
        $roles = 1;

        $user = User::where('nombre_usuario', $r->usuario)->fist();
        if (!is_null($user)) {
            return response()->json(['mensaje' => 'El usuario: ' . $r->usuario . ' ya existe!',]);
        }

        $user = User::where('correo_electronico', $r->correo)->fist();
        if (!is_null($user)) {
            return response()->json(['mensaje' => 'El correo: ' . $r->correo . ' ya existe!',]);
        }

        $user = new User();
        $user->nombre_usuario = $r->usuario;
        $user->correo_electronico = $r->correo;
        $user->password = Hash::make($r->password);
        $user->created_at = now();
        $user->updated_at = now();
        $user->syncRoles($roles);
        $user->save();

        /*  $emp = new Empleado();
        $emp->ci = $r->ci;
        $emp->nombre = $r->nombre;
        $emp->telefono =  $r->telefono;
        $id_user = User::where('nombre_usuario', $user->nombre_usuario)
            ->first();
        $emp->id_usuario = $id_user->id;
        $emp->estado = 'Habilitado';
        $emp->save(); */

        // return redirect()->route('Empleado.index');
        return response()->json([
            'mensaje' => 'Registro exitoso',
            'usuario' =>  $user->nombre_usuario,
        ]);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($empleado)
    {
        //
    }

    public function edit(Empleado $empleado)
    {
        //   dd($empleado);
        $user = User::where('id', $empleado->id_usuario)->first();
        // dd($user);

        $roles = Role::all()->pluck('name', 'id');
        // dd($roles);

        $rol_user = DB::table('users')
            ->join('model_has_roles as m', 'm.model_id', '=', 'users.id')
            ->where('users.id', $user->id)->first();
        // dd($rol_user);


        return view('VistaEmpleados.edit', compact('empleado', 'user', 'roles', 'rol_user'));
    }

    public function update(Request $r, Empleado $empleado)
    {
        // dd($r);
        $roles = $r->input('roles', []);
        $user = User::where('id', $empleado->id_usuario)->first();
        // dd($user->nombre_usuario);
        // dd($r->usuario);
        if ($user->nombre_usuario != $r->usuario)
            $user->nombre_usuario = $r->usuario;

        // $user->nombre_usuario = $r->user;
        if ($user->correo_electronico != $r->correo)
            $user->correo_electronico = $r->correo;
        // $user->correo_electronico = $r->correo;
        if ($r->password != '')
            $user->password = Hash::make($r->password);
        $user->syncRoles($roles);
        //  dd('un toue!!');
        $user->save();

        $emp = $empleado;
        // $emp->ci = $r->ci;
        $emp->nombre = $r->nombre;
        // $emp->apellido =  $r->nombre;
        $emp->telefono =  $r->telefono;
        // $emp->foto = 'foto!!';
        // $emp->sello = 'sello';
        // $emp->firma = 'firma';
        // $id_user = User::where('nombre_usuario', $user->nombre_usuario)
        //     ->first();
        // $emp->id_usuario = $id_user->id;
        $emp->save();


        return redirect()->route('Empleado.index');
    }

    public function destroy(Empleado $empleado)
    {
        $user = User::where('id', $empleado->id_usuario)->first();
        $empleado->estado = 'Deshabilitado';
        $empleado->save();

        return redirect()->route('Empleado.index');
    }


    public function habilitar(Empleado $e)
    {
        $e->estado = "Habilitado";
        $e->save();
        return redirect()->Route('Empleado.index');
    }

    public function deshabilitadoIndex()
    {
        $empleados = DB::table('empleados')->where('estado', '=', 'Deshabilitado')->paginate(100);
        return view('VistaEmpleados.indexDeshabilitados', compact('empleados'));
    }

    public function ExisteEmpleado(Request $r)
    {   //consulta de busqeiuda
        $p = Empleado::where('ci', $r->valor)->first();
        if ($p != null) {
            $p = true;
        } else {
            $p = false;
        }
        return response()->Json([
            "result" => $p,
        ]);
    }

    public function ExisteUsuario(Request $r)
    {

        $p = User::where('nombre_usuario', $r->valor)->first();
        if ($p != null) {
             if($p->id == $r->id_edit){
                $p = false;
             }else{
               $p = true;
             }
        } else {
            $p = false;
        }

        return response()->Json([
            "result" => $p,
        ]);
    }


    public function ExisteCorreo(Request $r)
    { //consulta de busqeiuda
        $p = User::where('correo_electronico', $r->valor)->first();
        if ($p != null) {
            if($p->id == $r->id_edit){
                $p = false;
             }else{
               $p = true;
             }
        } else {
            $p = false;
        }

        return response()->Json([
            "result" => $p,
        ]);
    }

    public function empleado_pdf(Empleado $e)
    {
        $fecha = date('d-m-Y');

        $registroExcluir = 9000002; // ID del registro a excluir

        $empleados = Empleado::where('ci','<>', [$registroExcluir])->get();


        // $empleados = Empleado::get();
        $pdf = PDF::loadView('VistaEmpleados.listaEmpleados', ['empleados' => $empleados])
            ->setPaper('letter', 'portrait');
        return $pdf->stream('Listado de Empleados-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }
}
