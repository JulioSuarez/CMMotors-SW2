<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('Empleado', EmpleadoController::class)->except(['show'])
     ->Parameters(['Empleado'=>'empleado'])->names('ApiEmpleado');


Route::get('ClienteApiJulio', [ClienteController::class,'indexApi']);
Route::get('ClienteApi/{ci}', [ClienteController::class,'showApi']);
Route::post('ProductoApi/', [ProductoController::class,'showApi']);
Route::post('CargarProductosApi', [ProductoController::class,'CargarProductosApi']);
Route::get('GetProductos', [ProductoController::class,'GetProductos']);

Route::post('HayDisponible', [ProductoController::class, 'HayProductos']);


//Route::get('Login', [AuthController::class, 'login'])
//    ->name('Login')->middleware('guest');
Route::post('LoginStore', [AuthController::class, 'loginStoreApi']);
Route::post('UserStore', [EmpleadoController::class, 'storeAPi']);

//Route::get('Dashboard', [AuthController::class, 'dashboard'])
//    ->name('Dashboard')->middleware('auth');
//Route::post('Logout', [AuthController::class, 'logout'])
//    ->name('Logout')->middleware('auth');




Route::get('ClienteApi2', function(){
    $cliente = [
        [
            'nombre' => 'Cristian Cuellar',
            'edad' => 22,
        ],
        [
            'nombre' => 'Alexander Cuellar',
            'edad' => 19,
        ]
    ];
    return response()->json(['data' => $cliente],200);
});

/*
//login post/ loguearse y generar un token
Route::post('LoginApi', function(Request $r){
    //requirimientos, validaciones
    $r->validate([
        'correo' => 'required|email',
        'contrasena' => 'required',
        'nombre' => 'required',
    ]);

    $user = User::where('correo', $r->correo)->first();

    //loguearse!a
   // if(Auth::attempt($r->only('correo','contrasena'))){
    if ($user != null and Hash::check($r->contrasena, $user->contrasena)) {
        Auth::login($user);
       // $r->session()->regenerate();
        return response()->json([
            'token' => $r->user()->createToken($r->nombre)->plainTextToken,
            'mesaje' => 'login exitoso!',
        ]);
    }else{
        return response()->json([
            'mesaje' => 'no autorizado!',
        ],401);
    }

}); */

Route::post('Holaxd', function(){
    return response()->json([
        // 'token' => $r->user()->createToken($r->nombre)->plainTextToken,
         'mesaje' => 'que onda puto!!',
     ]);

});







