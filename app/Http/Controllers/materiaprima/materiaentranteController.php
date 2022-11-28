<?php

namespace App\Http\Controllers\materiaprima;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\materiaentranterequest;
use Illuminate\Support\Facades\DB;
use App\Models\mateiraentrante;

class materiaentranteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar materia entrante|Registrar materia entrante|editar materia entrante|editar estado materia',['only'=>['index']]);
        $this->middleware('permission:Registrar materia entrante',['only'=>['create','store']]);
        $this->middleware('permission:editar materia entrante',['only'=>['edit','update']]);
        $this->middleware('permission:editar estado materia',['only'=>['changestatus']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiaentrante = DB::table('materia_prima_entrante')->get();
        $user = Auth::user();
        $fecha = now();
        return view('materiaprima.materiaentrante.index',["user"=>$user, "fecha"=>$fecha, 
        "materiaentrante"=>$materiaentrante]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materiaprima.materiaentrante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(materiaentranterequest $request)
    {
        $materiaentrante = new mateiraentrante;
        $materiaentrante -> nom_materia = $request -> get('Materia');
        $materiaentrante -> descripcion = $request -> get('Descripcion');
        $materiaentrante -> tip_medida = $request -> get('Medida');
        $materiaentrante -> pre_compra = $request -> get('Precio');
        $materiaentrante -> cant = $request -> get('cantidad');
        $materiaentrante -> fec_compra = now();
        $materiaentrante -> fec_caducidad  = $request -> get('caducidad');
        $materiaentrante -> estado = 1;
        $materiaentrante -> usr_registro = auth()->user()->name;
        $materiaentrante -> save();

        return redirect()->route('materiaentrante.index')->with('store', 'registro'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $cod_detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_materia_e)
    {
        $response=Http::get('http://localhost:3000/materia_entrante/'.$cod_materia_e);
        $materiae=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['materiae']=$materiae;

        return view ('materiaprima.materiaentrante.edit',['materiae'=>$materiae]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_materia_e)
    {
        $request->validate([
            'Materia'=>'required',
            'Descripcion'=>'required',
            'Medida'=>'required',
            'Precio'=>'required',
            'cantidad'=>'required',
            'caducidad'=>'required',
        ]);

        $response = Http::put('http://localhost:3000/materia_entrante/actualizar/' . $cod_materia_e, [
            'nom_materia' => $request->Materia,
            'descripcion' => $request->Descripcion,
            'tip_medida' => $request->Medida,
            'pre_compra' => $request->Precio,
            'cant' => $request->cantidad,
            'fec_caducidad' => $request->caducidad,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('materiaentrante.index')->with('update', 'editado'); 
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_materia_e)
    {
 
    }

    public function changestatus($cod_materia_e){ 

        $estadoupdate = mateiraentrante::select('estado')->where('cod_materia_e', $cod_materia_e)->first();
    
        if($estadoupdate->estado == 1)  {
            $estado = 0;
        }else{
            $estado = 1;
        }
        mateiraentrante::where('cod_materia_e', $cod_materia_e)->update(['estado' => $estado]);
        return redirect()->route('materiaentrante.index')->with('eliminar', 'Ok');
    }
}