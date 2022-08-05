<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Archivo;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class ContratoController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contratos.list');
    }
    /**
     * Lista registros de la base de datos 
     *
     * @return json data 
     */
    public function datatable()
    {
        $model = Contrato::with('inmueble')->with('propietarios')->with('inquilinos')->get();
        return Datatables::of($model)
            ->addColumn('accion', function ($row) {
                return '<a class="btn btn-primary" href="'.route('contratos.edit',$row->id).'">Ver</a>
                    <a class="btn btn-danger btn-delete" data-remote="'.route('contratos.destroy',$row->id).'"><i class="la la-trash white"></a>';
            })
            ->addColumn('direccion', function ($row) {
                return ($row->inmueble->direccion)?? '';
            })
            ->addColumn('propietarios', function ($row) {
                return $row->propietarios->map(function($propietario) {
                    return $propietario->getFullName().(($propietario->nro_documento)?' ('.$propietario->nro_documento.')':'');
                })->implode('</br>');
            })
            ->addColumn('inquilinos', function ($row) {
                return $row->inquilinos->map(function($inquilino) {
                    return $inquilino->getFullName().(($inquilino->nro_documento)?' ('.$inquilino->nro_documento.')':'');
                })->implode('</br>');
            })
            ->addColumn('garantes', function ($row) {
                return $row->garantes->map(function($garantes) {
                    return $garantes->getFullName();
                })->implode('</br>');
            })
            ->rawColumns(['accion','propietarios','inquilinos'])
            ->make(true);
    }
    /**
     * Lista registros de la base de datos para seleccionar registro
     *
     * @return json data 
     */
    public function datatableSearch(Request $request)
    {
        $model = Contrato::with('inmueble')->with('propietarios')->with('inquilinos')->get();
        return Datatables::of($model)
            ->addColumn('accion', function ($row) {
                return '<button class="btn btn-xs btn-primary" onclick="seleccionarContrato($(this))" data-remote="'.route('contratos.show',$row->id).'">Seleccionar</button>';
            })
            ->addColumn('direccion', function ($row) {
                return $row->inmueble->direccion;
            })
            ->addColumn('propietarios', function ($row) {
                return $row->propietarios->map(function($propietario) {
                    return $propietario->getFullName().(($propietario->nro_documento)?' ('.$propietario->nro_documento.')':'');
                })->implode('</br>');
            })
            ->addColumn('inquilinos', function ($row) {
                return $row->inquilinos->map(function($inquilino) {
                    return $inquilino->getFullName().(($inquilino->nro_documento)?' ('.$inquilino->nro_documento.')':'');
                })->implode('</br>');
            })
            ->addColumn('garantes', function ($row) {
                return $row->garantes->map(function($garantes) {
                    return $garantes->getFullName();
                })->implode('</br>');
            })
            ->rawColumns(['accion','propietarios','inquilinos'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contrato = new Contrato;
        return view('contratos.form')
                ->with('contrato',$contrato);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Ingreso registro via ajax */
        $contrato = new Contrato($request->all());
        $contrato->save();
        $contrato->propietarios()->sync($request->propietarios);
        $contrato->inquilinos()->sync($request->inquilinos);
        $contrato->garantes()->sync($request->garantes);
        if(!empty($request->montos)){
          $contrato->montos()->createMany($request->montos);
        }elseif ($request->monto) {
          $contrato->montos()->create([
                  'monto' => $request->monto,
                  'desde' => $request->inicio,
                  'hasta' => $request->fin,
              ]);
        }  
        return response()->json($contrato);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      echo Contrato::with('inmueble')
                    ->with('propietarios')
                    ->with(array('cobros' => function($query) {
                        $query->orderByRaw('ano , mes');
                      }))
                    ->with('inquilinos')
                    ->find($id)
                    ->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrato = Contrato::find($id);
        $propietarios = $contrato->propietarios()->orderBy('id')->get();
        $inquilinos = $contrato->inquilinos()->orderBy('id')->get();
        $garantes = $contrato->garantes()->orderBy('id')->get();
        $cobros = $contrato->cobros()->orderByRaw('ano , mes')->get();
        $periodos = $contrato->cobros()->where('liquidado',0)->orderByRaw('ano , mes')->get()->pluck('periodo_desc', 'id');
        $montos = $contrato->montos()->orderBy('desde','ASC')->get();
        $gastos = $contrato->gastos()->with('cobro')->get();
        $impuestos = $contrato->impuestos()->get();
        return view('contratos.form')
                ->with('contrato',$contrato)
                ->with('propietarios',$propietarios)
                ->with('inquilinos',$inquilinos)
                ->with('garantes',$garantes)
                ->with('cobros',$cobros)
                ->with('periodos',$periodos)
                ->with('montos',$montos)
                ->with('gastos',$gastos)
                ->with('impuestos',$impuestos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* Actualizo registro via ajax */
        $contrato = Contrato::find($id); 
        $contrato->fill($request->input());
        $contrato->imputa_iva_honorarios = ($request->imputa_iva_honorarios) ? 1 : 0;
        $contrato->imputa_iva_punitorios = ($request->imputa_iva_punitorios) ? 1 : 0;
        $contrato->imputa_iva = ($request->imputa_iva) ? 1 : 0;
        $contrato->punitorios_administracion = ($request->punitorios_administracion) ? 1 : 0;
        $contrato->punitorios_habil = ($request->punitorios_habil) ? 1 : 0;
        $contrato->honorarios_sobre_punitorios = ($request->honorarios_sobre_punitorios) ? 1 : 0;
        $contrato->interes_acumulativo = ($request->interes_acumulativo) ? 1 : 0;
        $contrato->honorarios_sobre_cobrado = ($request->honorarios_sobre_cobrado) ? 1 : 0;
        $contrato->save();
        $contrato->propietarios()->sync($request->propietarios);
        $contrato->inquilinos()->sync($request->inquilinos);
        $contrato->garantes()->sync($request->garantes);
        if(!$contrato->montos()->count()){
          if(!empty($request->montos)){
            $contrato->montos()->createMany($request->montos);
          }elseif ($request->monto) {
            $contrato->montos()->create([
                    'monto' => $request->monto,
                    'desde' => $request->inicio,
                    'hasta' => $request->fin,
                ]);
          }
        }
        return response()->json($contrato);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato)
    {
        //

    }
    public function calcularMontos(Request $request) 
    {
      $dates = array();
      $fecha_fin = date('Y-m-d', strtotime($request->fin));
      $fecha_ini = date('Y-m-d', strtotime($request->inicio));
      $ultima_fecha='';
      $periodo = $request->cada;
      $porcentaje = $request->porcentaje;
      $precio = $request->monto;
      $i = 1;
      $primero=1;
      while (strtotime($fecha_fin)>strtotime($fecha_ini)):
        $fecha_fin_dia = date('d', strtotime($fecha_fin . ' +' . $periodo . ' months'));
        $fecha_ini_dia = date('d', strtotime($fecha_ini . ' +' . $periodo . ' months'));
        $fecha_time=strtotime($fecha_ini . ' +' . $periodo . ' months');
        if($fecha_fin_dia < $fecha_ini_dia)
          $fecha_ini_dia=$fecha_fin_dia;
        $fecha_ini = date('Y-m', $fecha_time).'-'.$fecha_ini_dia;
        if ($fecha_ini <= $fecha_fin) {
          $dates[$i]['fecha'] = date('d-m-Y', strtotime($fecha_ini));
          $dates[$i]['fecha'] = date('d-m-Y',strtotime( '-1 month',strtotime($dates[$i]['fecha'])));
          $dates[$i]['fecha'] = date('d-m-Y',strtotime( '+29 day',strtotime($dates[$i]['fecha'])));
          if ($i !== 1) {
              $_porcentaje = ($precio * $porcentaje) / 100;
              $precio = $precio + $_porcentaje;
              $dates[$i]['monto'] = (int)$precio;
          } else {
              $dates[$i]['monto'] = (int)$precio;
          }
          $ultima_fecha=date('d-m-Y', strtotime($fecha_ini));
        }else{
          if(date('m', strtotime($fecha_ini))!=date('m', strtotime($fecha_fin)) and $primero){
            if ($i !== 1) {
              $_porcentaje = ($precio * $porcentaje) / 100;
              $precio = $precio + $_porcentaje;
              $mes_ultima_fecha=date('mY', strtotime($ultima_fecha));
              if($mes_ultima_fecha==date('mY', strtotime($fecha_fin))){
                  $dates[$i]['fecha'] ='';
                  $dates[$i]['monto'] ='';
                  $dates[($i-1)]['fecha'] =date('d-m-Y', strtotime($fecha_fin));
              }else{
                  $dates[$i]['monto'] = (int)$precio;
                  $dates[$i]['fecha'] =date('d-m-Y', strtotime($fecha_fin));
              }
              $primero=0;
            }
           }else{
            $dates[$i]['monto'] ='';
            $dates[$i]['fecha'] = '';
          }
        }
        $i++;
      endwhile;
      echo json_encode($dates);
    }
    public function generarCuotas(Request $request){
      $data = array();
      $contrato = Contrato::find($request->id);
      $hasCobrados = $contrato->cobros()->count();
      // Si ya cobro no se pueden actualizar los periodos
      if(!$hasCobrados){
          // Elimino periodos para cargarlos nuevamente
          $contrato->cobros()->delete();
          $date = $contrato->inicio;
          $end_date = $contrato->fin;
          while (strtotime($date) <= strtotime($end_date)) {
            $monto = $contrato->montos()->where('desde','<=',date('Y-m-d',strtotime($date)))->where('hasta','>',date('Y-m-d',strtotime($date)))->first();
            if(isset($monto)){
                $contrato->cobros()->create([
                    'monto' => $monto->monto,
                    'mes' => date('m', strtotime($date)),
                    'ano' => date('Y', strtotime($date)),
                    'honorarios' => ($contrato->honorarios_fijos) ? $contrato->honorarios_fijos : $monto->monto*$contrato->honorarios/100,
                ]);
            }
            $date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
          }
          $data['error'] = 0;
          $data['cuotas'] = $contrato->cobros()->get();
          echo json_encode($data);
      }else{
          $data['error'] = 1;
          echo json_encode($data);
      }
    }
    public function eliminarCuotas(Request $request){
      $data = array();
      $contrato = Contrato::find($request->id);
      $hasCobrados = $contrato->cobros()->where('liquidado',1)->count();
      // Si ya cobro no se pueden actualizar los periodos
      if(!$hasCobrados){
          // Elimino periodos para cargarlos nuevamente
          $contrato->cobros()->delete();
          $data['error'] = 0;
          echo json_encode($data);
      }else{
          $data['error'] = 1;
          echo json_encode($data);
      }
    }
    public function modificarMonto(Request $request){
        $error = [];

        $monto = \App\Monto::find($request->monto_id);
        
        if ($monto->contrato->cobros()->count()) {
          $error = ['code' => 1, 'text' => 'Las cuotas ya fueron generadas, no puede modificar montos.'];
        } else {
          if($monto && ($monto->contrato_id == $request->contrato_id)) {
            $monto->monto = $request->monto;
            $monto->save();
          } elseif ($monto) {
            $monto = \App\Monto::where('contrato_id', $request->contrato_id)->where('monto',$request->monto_anterior)->first();
            $monto->monto = $request->monto;
            $monto->save();
          } else {
            $error = ['code' => 1, 'text' => 'Las cuotas ya fueron generadas, no puede modificar montos.'];
          }
        }
        return response()->json($error);
    }

    public function uploadFiles(Request $request){
      $contrato = Contrato::find($request->contrato_id);
      if($request->hasFile('file')){
          //guardo el archivo
          $file = $request->file('file');
          $filename = time() . '.' . $file->getClientOriginalExtension();
          $path = $file->store('uploads/contratos/'.$filename);
          // Lo guardo en la base de datos y lo agrego a los archivos del contrato
          $archivo = new Archivo;
          $archivo->ruta = $path;
          $archivo->nombre_original = $file->getClientOriginalName();
          $archivo->tipo = $file->getMimeType();
          $archivo->extension = $file->getClientOriginalExtension();
          $archivo->tamano = $file->getClientSize();
          $archivo->fecha = date('Y-m-d');
          $archivo->save();
          $contrato->archivos()->attach($archivo);
          $response = array('error'=>0,'text'=>'El achivo se subio correctamente');
      }
    }
    public function getFiles(Request $request){
      $contrato = Contrato::find($request->contrato_id);
      $files = $contrato->archivos()->get();
      return response()->json($files);
    }
}
