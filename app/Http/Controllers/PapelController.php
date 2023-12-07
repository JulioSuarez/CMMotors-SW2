<?php

namespace App\Http\Controllers;

use App\Models\papel;
use Illuminate\Http\Request;

class PapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oni = papel::get();
        dd($oni);
        return view('VistaPapel.index',compact('oni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\papel  $papel
     * @return \Illuminate\Http\Response
     */
    public function show(papel $papel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\papel  $papel
     * @return \Illuminate\Http\Response
     */
    public function edit(papel $papel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\papel  $papel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, papel $papel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\papel  $papel
     * @return \Illuminate\Http\Response
     */
    public function destroy(papel $papel)
    {
        //
    }
}
