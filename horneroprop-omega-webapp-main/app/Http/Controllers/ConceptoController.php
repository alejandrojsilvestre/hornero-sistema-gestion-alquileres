<?php

namespace App\Http\Controllers;

use App\Concepto;
use Illuminate\Http\Request;

class ConceptoController extends SisController
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
        return response()->json(Concepto::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Concepto  $Concepto
     * @return \Illuminate\Http\Response
     */
    public function show(Concepto $Concepto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Concepto  $Concepto
     * @return \Illuminate\Http\Response
     */
    public function edit(Concepto $Concepto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Concepto  $Concepto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concepto $Concepto)
    {
        return response()->json(Concepto::find($request->id)->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Concepto  $Concepto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concepto $Concepto)
    {
        //
    }
}
