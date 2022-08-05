<?php

namespace App\Http\Controllers;

use App\AfipCredential;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Storage;
use Auth;

class AfipCredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('afip.credentials.list');
    }

    /**
     * List of resources
     *
     * @return json data 
     */
    public function datatable(Request $request)
    {
        $model = AfipCredential::all();
        return Datatables::of($model)
        ->addColumn('accion', function ($row) {
            return '<button class="btn btn-xs btn-primary editAfipCredential" data-remote="'.route('credenciales.show', $row->id).'">Ver</button>
                <button class="btn btn-xs btn-danger btn-delete" data-remote="'.route('credenciales.destroy', $row->id).'"><i class="la la-trash white"></button>';
        })
        ->rawColumns(['accion'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!($request->hasFile('key') && $request->hasFile('crt')))
            return;

        $afipCredential = new AfipCredential($request->all());
        $afipCredential->save();

        $folder = 'afip/' . Auth::user()->sucursal->id . '/credentials/' . $afipCredential->id;
        $crt = Storage::putFile($folder, $request->crt);
        $key = Storage::putFile($folder, $request->key);

        $afipCredential->crt = $crt;
        $afipCredential->key = $key;
        $afipCredential->update();

        $afipCredential->users()->sync($request->users);
        return response()->json($afipCredential);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $afipCredential = AfipCredential::with('users')->find($id);
        foreach ($afipCredential->users as $user) {
            $afipCredential->users[] = $user->id;
        }
        return response()->json($afipCredential);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!($request->hasFile('key') && $request->hasFile('crt')))
            return;

        $afipCredential = AfipCredential::find($id); 
        $afipCredential->fill($request->all());
        $afipCredential->save();

        $folder = 'afip/' . Auth::user()->sucursal->id . '/credentials/' . $afipCredential->id;
        $crt=Storage::putFile($folder, $request->crt);
        $key=Storage::putFile($folder, $request->key);

        $afipCredential->crt = $crt;
        $afipCredential->key = $key;
        $afipCredential->update();

        $afipCredential->users()->sync($request->users);

        return response()->json($afipCredential);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $afipCredential = AfipCredential::find($id); 

        return response()->json($afipCredential->delete());
    }

    public function search(Request $request) {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $results = Auth::user()->afip_credentials()->where('business_name', 'LIKE', '%' . $term . '%')->get();

        $formatted_result = [];

        foreach ($results as $result) {
            $formatted_result[] = ['id' => $result->id, 'text' => $result->business_name];
        }

        return response()->json($formatted_result);
    }
}
