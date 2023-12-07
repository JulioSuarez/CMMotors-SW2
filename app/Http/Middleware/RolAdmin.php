<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $r, Closure $next)
    {
        // dd($r);
        $id = Auth::user()->id;
        // dd($id);
        $logueado = DB::table('users')->join('model_has_roles as m','m.model_id','=','users.id')
        ->where('users.id',$id)->get();

        // dd($logueado[0]->role_id);
       foreach ($logueado as $l) {
            if(  $l->role_id == 1 ||   $l->role_id ==2){
                return $next($r);
            }
       }
       return redirect()->route('Dashboard')->with('soloLoguin','No tienes Acceso a esa ruta!');

    }
}
