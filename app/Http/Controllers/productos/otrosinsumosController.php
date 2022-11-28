<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\otrosinsumosrequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\otrosinsumos;

class otrosinsumosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar otros insumos|Registrar otros insumos|editar otros insumos|editar estado insumos',['only'=>['index']]);
        $this->middleware('permission:Registrar otros insumos',['only'=>['create','store']]);
        $this->middleware('permission:editar otros insumos',['only'=>['edit','update']]);
        $this->middleware('permission:editar estado insumos',['only'=>['changestatus']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $otrosinsumos = DB::table('otros_insumos')->get();
        $user = Auth::user();
        $fecha = now();
        return view('productos.otrosinsumos.index',["user"=>$user, "fecha"=>$fecha, "otrosinsumos"=>$otrosinsumos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.otrosinsumos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(otrosinsumosrequest $request)
    {

        $otrosinsumos = new otrosinsumos;
        $otrosinsumos -> insumo = $request -> get('insumo');
        $otrosinsumos -> descripcion = $request -> get('Descripcion');
        $otrosinsumos -> precio = $request -> get('Precio');
        $otrosinsumos -> cant = $request -> get('cantidad');
        $otrosinsumos -> tip_medida = $request -> get('Medida');
        $otrosinsumos -> estado = 1;
        $otrosinsumos -> fecha_registro  = now();
        $otrosinsumos -> usr_registro = auth()->user()->name;
        $otrosinsumos -> save();

        return redirect()->route('otrosinsumos.index')->with('store', 'registro');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_insumos)
    {
        $otrosinsumos = otrosinsumos::findOrFail($cod_insumos);

        return view ('productos.otrosinsumos.edit',['otrosinsumos'=>$otrosinsumos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_insumos)
    {
        $otrosinsumos = otrosinsumos::findOrFail($cod_insumos);
        $otrosinsumos -> insumo = $request -> get('insumo');
        $otrosinsumos -> descripcion = $request -> get('Descripcion');
        $otrosinsumos -> precio = $request -> get('Precio');
        $otrosinsumos -> cant = $request -> get('cantidad');
        $otrosinsumos -> tip_medida = $request -> get('Medida');
        $otrosinsumos -> update();

        return redirect()->route('otrosinsumos.index')->with('update', 'editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function changestatus($cod_insumos){ 

        $estadoupdate = otrosinsumos::select('estado')->where('cod_insumos', $cod_insumos)->first();
    
        if($estadoupdate->estado == 1)  {
            $estado = 0;
        }else{
            $estado = 1;
        }
        otrosinsumos::where('cod_insumos', $cod_insumos)->update(['estado' => $estado]);
        return redirect()->route('otrosinsumos.index')->with('eliminar', 'Ok');
    }
}