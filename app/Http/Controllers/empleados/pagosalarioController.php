<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\pagosalario;
use App\Http\Requests\pagorequest;
use Illuminate\Support\Facades\DB;

class pagosalarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar pago salario|Registrar pago salario|editar pago salario|borrar pago salario',['only'=>['index']]);
        $this->middleware('permission:Registrar pago salario',['only'=>['create','store']]);
        $this->middleware('permission:editar pago salario',['only'=>['edit','update']]);
        $this->middleware('permission:borrar pago salario',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagosaalario = DB::table('pago_salario as ps')
        ->join('colaboradores as c','c.cod_empleado','=','ps.cod_empleado')
        ->join('persona as p','c.cod_persona','=','p.cod_persona')
        ->select('ps.cod_pago', 'c.cod_empleado', DB::raw('CONCAT(p.primer_nom," ",p.primer_apellido) as nombre'), 'ps.sueldo_bruto', 'ps.IHSS', 'ps.RAP', 'ps.otras_deducciones' , 'ps.vacaciones', 'ps.descripcion_vacaciones', 'ps.salario')
        ->get();
        $user = Auth::user();
        $fecha = now();
        return view('empleados.pagosalario.index',["user"=>$user, "fecha"=>$fecha, "pagosaalario"=>$pagosaalario]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colaboradores = DB::table('colaboradores as c')
        ->join('persona as p','c.cod_persona','=','p.cod_persona')
        ->select('c.cod_empleado', 'c.sueldo_bruto', DB::raw('CONCAT(p.primer_nom," ",p.primer_apellido) as nombre'))
        ->get();
        return view('empleados.pagosalario.create',["colaboradores"=>$colaboradores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Empleado'=>'required',
            'SueldoB'=>'required',
            'IHSS'=>'required',
            'RAP'=>'required',
            'deducciones'=>'required',
            'vacaciones'=>'required',
            'Descripcion'=>'required',
            'Sueldo'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/pago_salario/insertar', [
            'cod_empleado' => $request->Empleado,
            'sueldo_bruto' => $request->SueldoB,
            'IHSS' => $request->IHSS,
            'RAP' => $request->RAP,
            'otras_deducciones' => $request->deducciones,
            'vacaciones' => $request->vacaciones,
            'descripcion_vacaciones' => $request->Descripcion,
            'salario' => $request->Sueldo,
            'usr_registro' =>  auth()->user()->name,
        ]);

        return redirect()->route('pagosalario.index');
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
    public function edit($cod_pago)
    {
        $colaboradores = DB::table('colaboradores as c')
        ->join('persona as p','c.cod_persona','=','p.cod_persona')
        ->select('c.cod_empleado', 'c.sueldo_bruto', DB::raw('CONCAT(p.primer_nom," ",p.primer_apellido) as nombre'))
        ->get();
        $pagosalarioactu = pagosalario::findOrFail($cod_pago);

        return view('empleados.pagosalario.edit',['pagosalarioactu'=>$pagosalarioactu, 'colaboradores'=>$colaboradores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_pago)
    {
        $request->validate([
            'Empleado'=>'required',
            'SueldoB'=>'required',
            'IHSS'=>'required',
            'RAP'=>'required',
            'deducciones'=>'required',
            'vacaciones'=>'required',
            'Descripcion'=>'required',
            'Sueldo'=>'required'
        ]);

        $response = Http::put('http://localhost:3000/pago_salario/actualizar/' . $cod_pago, [
            'cod_empleado' => $request->Empleado,
            'sueldo_bruto' => $request->SueldoB,
            'IHSS' => $request->IHSS,
            'RAP' => $request->RAP,
            'otras_deducciones' => $request->deducciones,
            'vacaciones' => $request->vacaciones,
            'descripcion_vacaciones' => $request->Descripcion,
            'salario' => $request->Sueldo,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('pagosalario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_pago)
    {
        $eliminar = Http::delete('http://localhost:3000/pago_salario/eliminar/'.$cod_pago); 
        return redirect()->route('pagosalario.index')->with('eliminar', 'Ok');
    }
}
