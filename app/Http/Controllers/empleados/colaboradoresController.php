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
        $this->middleware('permission:visualizar Colaboradores|Registrar Colaborador|editar Colaborador|borrar Colaborador',['only'=>['index']]);
        $this->middleware('permission:Registrar Colaborador',['only'=>['create','store']]);
        $this->middleware('permission:editar Colaborador',['only'=>['edit','update']]);
        $this->middleware('permission:borrar Colaborador',['only'=>['destroy']]);
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
            ->select('c.cod_empleado','p.primer_nom', 'p.primer_apellido', 'cr.correo', 't.telefono', 'c.sueldo_bruto', 'c.fecha_registro')
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
        $personas = DB::table('persona')->where('tipo_persona','=','Colaborador')->get();
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
        $colaborador -> cod_persona  = $request -> get('persona');
        $colaborador -> sueldo_bruto = $request -> get('Sueldo');
        $colaborador -> fecha_registro = now();
        $colaborador -> usr_registro = auth()->user()->name;
        $colaborador -> save();

        return redirect()->route('colaboradores.index');
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
        $colaborador = colaboradores::findOrFail($cod_empleado);
        $personas = DB::table('persona')->where('tipo_persona','=','Colaborador')->get();
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
        $colaborador -> cod_persona  = $request -> get('persona');
        $colaborador -> sueldo_bruto = $request -> get('Sueldo');
        $colaborador -> fecha_salida = $request -> get('salida');
        $colaborador -> motivo_salida = $request -> get('motivo');
        $colaborador -> update();
        return redirect()->route('colaboradores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_empleado)
    {
        $colaborador = colaboradores::findOrFail($cod_empleado);
        $colaborador->delete();
        return redirect()->route('colaboradores.index')->with('eliminar', 'Ok');
    }
}