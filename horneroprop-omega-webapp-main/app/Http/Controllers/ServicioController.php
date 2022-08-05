<?php

namespace App\Http\Controllers;

use App\Sernvicio;
use Illuminate\Http\Request;

class ServicioController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        echo json_encode(Servicio::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $Servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $Servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio  $Servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $Servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $Servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $Servicio)
    {
        echo json_encode(Servicio::find($request->id)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $Servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $Servicio)
    {
        //
    }
}
