<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class valitacion_contrasenas
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
        if(is_null($r->usuario)){
            // dd('retunar es es nulp');
            return back()->with("usuario","Requerido!!!")->withInput();
        }elseif(is_null($r->email)){
                return back()->with("email","Requerido!!!")->withInput();
            }elseif(is_null($r->password1)){
                return back()->with("password1","Requerido!!!")->withInput();
            }elseif(is_null($r->password)){
                return back()->with("password","Requerido!!!")->withInput();
            }elseif(is_null($r->ci)){
                return back()->with("ci","Requerido!!!")->withInput();
            }elseif(is_null($r->nombre)){
                return back()->with("nombre","Requerido!!!")->withInput();
            }elseif(is_null($r->roles)){
                return back()->with("roles","Requerido!!!")->withInput();
            };

            if($r->password1 != $r->password){
                return back()->with("pass_no_iguales","Las contrasenas deben coinciden")->withInput();
            }

        if($r->password1 != $r->password){
            return back()->with("pass_no_iguales","Las contrasenas deben coinciden")->withInput();
        }
        return $next($r);
    }
}
