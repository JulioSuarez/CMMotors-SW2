<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;
use App\Models\Estante;
use App\Models\Sector;


class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectores = Sector::get();
        $estantes = Estante::join('sectors as s','s.id','=','estantes.id_sector')
                           ->select('estantes.*','s.nombre as nombre_sector')
                               ->get();
      // $estantes =Estante::get();
     //  dd($sectores);

        $ubicaciones = Ubicacion::join('estantes as e','e.id','=',
                                'ubicacions.codigo_estantes')
                                ->join('sectors as s','s.id','=','e.id_sector')
                                ->select('ubicacions.*','e.nombre as nombre_estante',
                                         'e.id_sector','s.nombre as nombre_sector')
                                ->get();

      //  dd($ubicaciones);

        return view('VistaUbicacion.index',compact('ubicaciones','estantes','sectores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estantes = Estante::get();
        $sectores = Sector::get();
        return view('prueba',compact('estantes','sectores'));
        //return view('VistaUbicacion.create',compact('estantes','sectores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //dd($r);
        $ubi = new Ubicacion();
        $ubi->codigo_ubi = $r->codigo_ubi;
        $ubi->codigo_estantes = $r->codigo_estante;
        $ubi->save();

        return redirect()->Route('Ubicacion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //dd($ubicacion);
        $ubicacion = Ubicacion::join('estantes as e','e.id','=',
         'ubicacions.codigo_estantes')
        ->join('sectors as s','s.id','=','e.id_sector')
        ->select('ubicacions.*','e.nombre as nombre_estante',
                  'e.id_sector','s.nombre as nombre_sector')
        ->where('ubicacions.id',$ubicacion->id)->first();

        $estantes = Estante::get();

        return view('VistaUbicacion.edit',compact('ubicacion','estantes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Ubicacion $ubicacion)
    {

        $ubicacion->codigo_ubi = $r->codigo_ubi;
        $ubicacion->codigo_estantes = $r->codigo_estante;
        $ubicacion->save();

         return redirect()->Route('Ubicacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->delete();
        return redirect()->Route('Ubicacion.index');
    }


    public function createEstante() {
        $sectores = Sector::get();
        return view('VistaUbicacion.createEstante',compact('sectores'));
    }

    public function storeSector(Request $r) {
       // dd(' llegue');
        $rr = new Sector();
        $rr->nombre =  $r->nombre;
        $rr->descripcion =  $r->descripcion ;
        $rr->save();
        return redirect()->Route('Ubicacion.index');
    }

    public function editSector(Sector $sector) {
        //dd('kllegue edit ');
            return view('VistaUbicacion.editSector',compact('sector'));
    }

    public function updateSector(Request $r,Sector $sector) {
        $sector->nombre =  $r->nombre;
        $sector->descripcion =  $r->descripcion ;
        $sector->save();
            return redirect()->Route('Ubicacion.index');
    }



    public function storeEstante(Request $r) {
        //dd($r);
        $rr = new Estante();
        $rr->nombre =  $r->nombre;
        $rr->descripcion =  $r->descripcion ;
        $rr->nro_columnas = $r->nro_columnas;
        $rr->nro_filas = $r->nro_filas;
        $rr->id_sector =  $r->id_sector ;
        $rr->save();
        return redirect()->Route('Ubicacion.index');
     }

    public function editEstante(Estante $estante) {

        $estante = Estante::join('sectors as s','s.id','=','estantes.id_sector')
                            ->select('estantes.*','s.nombre as nombre_sector')
                            ->where('estantes.id',$estante->id)->first();

        $sectores = Sector::get();
        return view('VistaUbicacion.editEstante',compact('estante','sectores'));
    }

    public function updateEstante(Request $r,Estante $estante) {

        $estante->nombre =  $r->nombre;
        $estante->descripcion =  $r->descripcion ;
        $estante->nro_columnas = $r->nro_columnas;
        $estante->nro_filas = $r->nro_filas;
        $estante->id_sector =  $r->id_sector ;
        $estante->save();
        return redirect()->Route('Ubicacion.index');
    }

    public function deleteSector(Sector $sector) {
       // dd($sector);
        $sector->delete();
        return redirect()->Route('Ubicacion.index');
    }

    public function deleteEstante(Estante $estante) {
        // dd($sector);
         $estante->delete();
         return redirect()->Route('Ubicacion.index');
     }


}
