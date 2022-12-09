<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\colaboradoresrequest;
use Illuminate\Support\Facades\DB;
use App\Models\colaboradores;

class colaboradoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar Colaboradores|Registrar Colaborador|editar Colaborador|editar estado colaborador',['only'=>['index']]);
        $this->middleware('permission:Registrar Colaborador',['only'=>['create','store']]);
        $this->middleware('permission:editar Colaborador',['only'=>['edit','update']]);
        $this->middleware('permission:editar estado colaborador',['only'=>['changestatus']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request)
        {
            $colaboradores = DB::table('colaboradores as c')
            ->join('persona as p','c.cod_persona','=','p.cod_persona')
            ->join('correos as cr','c.cod_persona','=','cr.cod_persona')
            ->join('telefonos as t','c.cod_persona','=','t.cod_persona')
            ->select('c.cod_empleado','p.primer_nom', 'p.primer_apellido', 'cr.correo', 't.telefono', 'c.estado','c.sueldo_bruto', 'c.fecha_registro')
            ->orderBy('c.cod_empleado', 'desc')->get();
            $user = Auth::user();
            $fecha = now(); 
            return view('empleados.colaboradores.index',["colaboradores"=>$colaboradores, "user"=>$user, "fecha"=>$fecha]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $personas = DB::table('persona')
        ->where('tipo_persona', '=', 'Colaborador')
        ->where([['tipo_persona', '=', 'Colaborador'], ['estado', '=', '1'],])
        ->get();
        return view('empleados.colaboradores.create',["personas"=>$personas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(colaboradoresrequest $request)
    {
        $colaborador = new colaboradores;
        $colaborador -> cod_persona  = $request -> get('codp');
        $colaborador -> sueldo_bruto = $request -> get('Sueldo');
        $colaborador -> fecha_registro = $request -> get('Fecha');
        $colaborador -> estado = 1;
        $colaborador -> usr_registro = auth()->user()->name;
        $colaborador -> save();

        return redirect()->route('colaboradores.index')->with('store', 'registro');
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
    public function edit($cod_empleado)
    {
        $colaborador = DB::table('colaboradores as c')
        ->join('persona as p','c.cod_persona','=','p.cod_persona')
        ->select('c.cod_empleado', DB::raw('CONCAT(p.primer_nom," ",p.primer_apellido) as nombre'), 'c.sueldo_bruto', 
        'c.motivo_salida', 'c.fecha_registro')
        ->where('c.cod_empleado', '=', $cod_empleado)->first();

        $personas = DB::table('persona')
        ->where('tipo_persona', '=', 'Colaborador')
        ->where([['tipo_persona', '=', 'Colaborador'], ['estado', '=', '1'],])
        ->get();

        return view("empleados.colaboradores.edit", ["colaborador" => $colaborador, "personas" => $personas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_empleado)
    {
        $colaborador = colaboradores::findOrFail($cod_empleado);
        $colaborador -> cod_persona  = $request -> get('codp');
        $colaborador -> sueldo_bruto = $request -> get('Sueldo');
        $colaborador -> fecha_registro = $request -> get('Fecha');
        $colaborador -> fecha_salida = $request -> get('salida');
        $colaborador -> motivo_salida = $request -> get('motivo');
        $colaborador -> update();
        return redirect()->route('colaboradores.index')->with('update', 'editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_empleado)
    {

    }

    public function changestatus($cod_empleado){ 

        $estadoupdate = colaboradores::select('estado')->where('cod_empleado', $cod_empleado)->first();
    
        if($estadoupdate->estado == 1)  {
            $estado = 0;
        }else{
            $estado = 1;
        }
        colaboradores::where('cod_empleado', $cod_empleado)->update(['estado' => $estado]);
        return redirect()->route('colaboradores.index')->with('eliminar', 'Ok');
    }
}