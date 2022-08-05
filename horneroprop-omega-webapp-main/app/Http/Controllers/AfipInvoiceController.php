<?php

namespace App\Http\Controllers;

use App\AfipInvoice;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AfipInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('afip.invoices.list');
    }

    /**
     * List of resources
     *
     * @return json data 
     */
    public function datatable(Request $request)
    {
        $model = AfipInvoice::all();
        return Datatables::of($model)->make(true);
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
     * @param  \App\AfipInvoice  $afipInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(AfipInvoice $afipInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AfipInvoice  $afipInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(AfipInvoice $afipInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AfipInvoice  $afipInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AfipInvoice $afipInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AfipInvoice  $afipInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(AfipInvoice $afipInvoice)
    {
        //
    }
}
