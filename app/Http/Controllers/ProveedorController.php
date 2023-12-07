<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

use PDF;
class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = DB::table('proveedors')
            ->where('estado','=','Habilitado')
            ->paginate(20);
        return view('VistaProveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('VistaProveedores.create');
    }


    public function store(Request $r)
    {
        // dd('entre a 1',$r);
        $r->validate([
                'empresa' => 'required',
                'nit' => 'required|unique:proveedors,nit',
        ]);

        $p = new Proveedor();
        $p->nombre_proveedor  = $r->empresa;
        $p->proveedor_direccion  = $r->direccion ?? '';
        $p->proveedor_telefono  = $r->telefono ?? '';
        $p->proveedor_correo  = $r->correo ?? '';
        $p->nombre_proveedor_contacto  = $r->contacto ?? '';
        $p->nit = $r->nit;
        $p->tipo = $r->tipo ?? '';
        $p->estado = "Habilitado";
        $p->save();
        return redirect()->Route('Proveedor.index')
            ->with('ProveedorRegistrado', 'Proveedor Registrado con exito');
    }

    // public function store2(Request $r)
    // {
    //     dd('entre a store2',$r);
    //     $len = count($r->id);
    //     for ($i = 0; $i < $len; $i++) {
    //         $p =  Proveedor::where('id', $r->id[$i])->first();
    //         if (is_null($p)) {
    //             $p = new Proveedor();
    //         }

    //         // $p = new Proveedor();
    //         $p->id  = $r->id[$i];
    //         $p->nombre_proveedor  = $r->nombre_proveedor[$i];
    //         $p->proveedor_direccion  = $r->proveedor_direccion[$i];
    //         $p->proveedor_telefono  = $r->proveedor_telefono[$i];
    //         $p->proveedor_correo  = $r->proveedor_correo[$i];
    //         $p->nombre_proveedor_contacto  = $r->nombre_proveedor_contacto[$i];
    //         $p->nit = $r->nit[$i];
    //         $p->tipo = $r->tipo[$i];
    //         $p->estado = 'Habilitado';
    //         $p->save();
    //     }
    //     return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Proveedores Cargados Correctamente');
    // }

    public function show($id)
    {
        //
    }

    public function edit(Proveedor $p)
    {
        return view('VistaProveedores.edit', compact('p'));
    }

    public function update(Request $r, Proveedor $p)
    {
        //validacoiens 
        $r->validate([
            'nombre_proveedor' => 'required',
            'nit' => 'required|unique:proveedors,nit,' . $p->id,
        ]);

        $p->nombre_proveedor  = $r->nombre_proveedor;
        $p->proveedor_direccion  = $r->direccion ?? '';
        $p->proveedor_telefono  = $r->proveedor_telefono ?? '';
        $p->proveedor_correo  = $r->proveedor_correo ?? '';
        $p->nombre_proveedor_contacto  = $r->nombre_proveedor_contacto ?? '';
        $p->nit = $r->nit;
        $p->tipo = $r->tipo ?? '';

        $p->save();
        return redirect()->Route('Proveedor.index');
    }

    public function destroy(Proveedor $p)
    {
        $p->estado = "Deshabilitado";
        $p->save();
        return redirect()->Route('Proveedor.index');
    }

    public function habilitar(Proveedor $p)
    {
        $p->estado = "Habilitado";
        $p->save();
        return redirect()->Route('Proveedor.index');
    }

    public function ExisteProveedor(Request $r)
    {
        //consulta de busqeiuda
        $p = Proveedor::where('nit', $r->valor)->first();

        if ($p != null) {
            $p = true;
        } else {
            $p = false;
        }

        return response()->Json([
            "result" => $p,
        ]);
    }

    public function ExisteProveedor2(Request $r)
    {

        //consulta de busqeiuda
        $p = Proveedor::where('nit', $r->dato)->first();

        if ($p != null) {
            $p = true;
        } else {
            $p = false;
        }

        //  dd($p);
        return view('prueba');
    }
    public function deshabilitadoIndex()
    {
        $proveedores = DB::table('proveedors')->where('estado','=','Deshabilitado')->paginate(10);
        return view('VistaProveedores.deshabilitados', compact('proveedores'));
    }

    public function proveedor_pdf(Proveedor $p)
    {
        $fecha = date('d-m-Y');
        $proveedores = Proveedor::get();
            $pdf = PDF::loadView('VistaClientes.listaProveedores', ['proveedores' => $proveedores])
            ->setPaper('letter', 'portrait');
        return $pdf->stream('Listado de Proveedores-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }
}
