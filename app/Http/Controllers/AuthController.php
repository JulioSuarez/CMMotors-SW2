<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Venta;
use App\Models\Backup;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Cotizacion;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use App\Exports\ExportBackup;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash; //para encriptar contrasenas
use Illuminate\Validation\ValidationException; //para enviar mensajes de error

class AuthController extends Controller
{
    public function login()
    {
        //  dd('llegue !!1');

        return view('VistasAuth.login');
    }

    public function loginStore(Request $r)
    {
        //del request solo sacame correo y contrasena
        $credenciales = $r->validate([
            'correo_electronico' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);  //NO SE ESTA OCUPANDO CREDENCIALES

        //filled, devuelve V o F si se dio click al inout recordar
        //$recordar = $r->filled('recordar');
        //TAMPOSE SE SETA USADNO DE MONETNO

        //sacar la tabla donde este esee correo


        $user = User::where('correo_electronico', $r->correo_electronico)
            ->join('empleados as e', 'e.id_usuario', '=', 'users.id')->first();


        if (is_null($user)) {
            $user = User::where('nombre_usuario', $r->correo_electronico)
                ->join('empleados as e', 'e.id_usuario', '=', 'users.id')->first();
        }

        //usandon el Hash::check
        //Hash::check //recibe texo plano password, luego la encriptada en la Tabla
        if ($user != null and Hash::check($r->password, $user->password)) {
            //hacer login
            Auth::login($user);

            //generar el token csrf
            $r->session()->regenerate();

            $bienvenida = 'Bienvenido ' . ($user->nombre);
            //redirecciona a dashboard con una variable status

            return //intended, por sin entra ua una url protegida
                redirect()->intended(Route('Dashboard'))
                ->with('status', $bienvenida);
        } //false, login incorrecto redireccionar devuelta login


        //distafar un error de validacion
        if ($user == null) { //si es nulo, significa que no encontro el correo
            throw ValidationException::withMessages([
                //meustra el eeroror del correo
                'correo' => 'Correo no encontrado',
            ]);
        } else {
            throw ValidationException::withMessages([
                //meustra el eeroror del correo
                'password' => 'Contrasena Incorrecta',
            ]);
        }
    }



    public function loginStoreApi(Request $r)
    {
        //del request solo sacame correo y contrasena
        $r->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);  //NO SE ESTA OCUPANDO CREDENCIALES

        //buscar por correo
        $user = User::where('correo_electronico', $r->usuario)
            ->join('empleados as e', 'e.id_usuario', '=', 'users.id')->first();

        if (is_null($user))   //si no encontro entra a buscar por usuario
            $user = User::where('nombre_usuario', $r->usuario)
                ->join('empleados as e', 'e.id_usuario', '=', 'users.id')->first();

        //Hash::check //recibe texo plano password, luego la encriptada en la Tabla
        if ($user != null and Hash::check($r->password, $user->password)) {
            Auth::login($user);
            return response()->json([
                'estado' => 'Login Existo',
                'token' => $r->user()->createToken($user->nombre_usuario)->plainTextToken,
                'mensaje' => 'Bienvenido ' . ($user->nombre),
                'id_usuario' => $user->id_usuario,
            ]);
        } //false, login incorrecto redireccionar devuelta login

        //distafar un error de validacion
        if ($user == null) { //si es nulo, significa que no encontro el correo
            $mensaje =  'Correo o Usuario no encontrado';
        } else {
            $mensaje = 'Contrasena Incorrecta';
        }
        return response()->json([
            'estado' => 'falla',
            'mensaje' => $mensaje,
        ], 401);
    }


    public function dashboard()
    {
        //////////
        $hoy = date('Y-m-d');
        $mes = date('Y-m-d');
        $NuevaFecha = strtotime('-1 month', strtotime($mes));
        $NuevaFechax = date('Y-m-d', $NuevaFecha);
        // dd($NuevaFechax);
        $ventas_dia = Venta::where('fecha', $hoy)->sum('monto_total');
        $ventas_mes = Venta::where('fecha', '>=', $NuevaFechax)->sum('monto_total');
        $user = Auth::user()->nombre_usuario;
        $producto = Producto::get();

        $array = [];
        foreach ($producto as $p) {
            if ($p->cantidad <= $p->cant_minima) {
                if ($p->estado == 'HABILITADO') {
                    $proveedor = Proveedor::where('id', $p->id_proveedor)->first();
                    $array[] = [
                        "id" => $p->id,
                        "cod_oem" => $p->cod_oem,
                        "cod_producto" => $p->cod_producto,
                        "nombre" => $p->nombre,
                        "marca" => $p->marca,
                        "procedencia" => $p->procedencia,
                        "origen" => $p->origen,
                        "descripcion" => $p->descripcion,
                        "cantidad" => $p->cantidad,
                        "cant_minima" => $p->cant_minima,
                        "precio_venta_con_factura" => $p->precio_venta_con_factura,
                        "precio_venta_sin_factura" => $p->precio_venta_sin_factura,
                        "precio_compra" => $p->precio_compra,
                        "foto" => $p->foto,
                        "fecha_expiracion" => $p->fecha_expiracion,
                        "tienda" => $p->tienda,
                        "unidad" => $p->unidad,
                        "estado" => $p->estado,
                        "estante" => $p->estante,
                        "categoria" => $p->categoria,
                        "id_proveedor" => $p->id_proveedor,
                        "nombre_proveedor" => $proveedor->nombre_proveedor,
                        "proveedor_direccion" => $proveedor->proveedor_direccion,
                        "proveedor_telefono" => $proveedor->proveedor_telefono,
                        "proveedor_correo" => $proveedor->proveedor_correo,
                        "nombre_proveedor_contacto" => $proveedor->nombre_proveedor_contacto,
                        "nit" => $proveedor->nit,
                        "tipo" => $proveedor->tipo,
                    ];
                }
            }
        }
        // dd($array[0]);
        // dd($proveedor);
        // dd($array);
        // $productosAgrupadosCount = DetalleVenta::get()->groupBy('id_producto');

        $productosAgrupados = DetalleVenta::join('productos', 'detalle_ventas.id_producto', '=', 'productos.id')
        ->groupBy('detalle_ventas.id_producto', 'productos.cod_producto')
        ->select('productos.cod_producto as x', DB::raw('count(*) as y'))
        ->orderBy('y', 'desc')
        ->take(15)
        ->get();


        $clientesPorMes = Venta::join('clientes', 'ventas.ci_cliente', '=', 'clientes.ci')
        ->select(
            DB::raw('MONTHNAME(ventas.fecha) as mes'),
            DB::raw('COUNT(DISTINCT clientes.ci) as cantidad_clientes')
        )
        ->groupBy('mes')
        ->orderByRaw('MONTH(ventas.fecha)')
        ->get();


        $cotizaciones = Cotizacion::count();
        $ventas = Venta::count();
        $progreso = number_format(($ventas/200)*100);
        $diasRestantes = date('t') - date('d');

        // dd($ventas_mes);

        return view(
            'VistasAuth.dashboard',
            compact(
                'array',
                'productosAgrupados',
                'user',
                'producto',
                'ventas_dia',
                'ventas_mes',
                'cotizaciones',
                'ventas',
                'progreso',
                'diasRestantes',
                'clientesPorMes'
            )
        );
    }



    public function logout(Request $r)
    {
        //    dd($r);
        Auth::logout();

        //invalidacion la seccion
        $r->session()->invalidate();

        //token crsf
        $r->session()->regenerateToken();

        return redirect()->Route('Login')->with('statusLogout', "Haz cerrado session");
    }
    /*
    By Julico
    funcion para realizar la peticion
    a la Base de Datos y regresar un resultado
    al frontend
    */
    public function show(Request $request)
    {
        $data = trim($request->valor);
        $result = DB::table('productos')
            ->where('cod_oem', 'like', '%' . $data . '%')
            ->orwhere('cod_producto', 'like', '%' . $data . '%')
            ->limit(5)
            ->get();
        return response()->json([
            "estado" => 1,
            "result" => $result
        ]);
    }

    public function hacerBackup()
    {
        //
        $comando = 'backup:run --only-db';
        Artisan::call($comando);

        $b = new Backup();
        $b->url = 'backuop_exitoso';
        $b->fecha = date('Y-m-d');
        $b->save();

        return response()->Json([
            "result" => 'exitoso'
        ]);
    }

    public function hacerBackup2()
    {
        //
        // dd('llegie');
        $comando = "backup:run --only-db --disable-notifications";
        Artisan::call("backup:run --only-db");
        dd(Artisan::output());

        $b = new Backup();
        $b->url = 'backuop_exitoso';
        $b->fecha = date('Y-m-d');
        $b->save();

        return redirect()->route('Dashboard');
    }


    public function exporta2()
    {
        return Excel::download(new ExportBackup, 'backup by Julico.xls');
    }
}
