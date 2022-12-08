<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\pagosalario;
use App\Http\Requests\pagorequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PagosalarioExport;
use App\Imports\PagosalarioImport;

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
        ->select('ps.cod_pago', 'c.cod_empleado', DB::raw('CONCAT(p.primer_nom," ",p.primer_apellido) as nombre'), 'ps.sueldo_bruto', 'ps.IHSS', 'ps.RAP', 'ps.otras_deducciones' , 'ps.vacaciones', 'ps.descripcion_vacaciones', 'ps.salario', 'ps.fecha_registro', 'ps.estado',
        'ps.periodo_pago')
        ->get();
        $user = Auth::user();
        $fecha = now();
        return view('empleados.pagosalario.index',["user"=>$user, "fecha"=>$fecha, "pagosaalario"=>$pagosaalario]);
    }

    public function plantilla()
    {
        $colaboradores = DB::table('colaboradores as c')
        ->join('persona as p','c.cod_persona','=','p.cod_persona')
        ->select('c.cod_empleado', 'c.sueldo_bruto', 'p.primer_nom', 'p.segund_nom', 'p.primer_apellido', 'p.segund_apellido', 'p.dni')
        ->where('c.estado', '=', '1')
        ->get();
        return view('empleados.pagosalario.plantilla',["colaboradores"=>$colaboradores]);
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
        ->select('c.cod_empleado', 'c.sueldo_bruto', 'p.primer_nom', 'p.segund_nom', 'p.primer_apellido', 'p.segund_apellido', 'p.dni')
        ->where('c.estado', '=', '1')
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
            'codc'=>'required',
            'SueldoB'=>'required',
            'IHSS'=>'required',
            'RAP'=>'required',
            'deducciones'=>'required',
            'vacaciones'=>'required',
            'Descripcion'=>'required',
            'periodo' => 'required',
            'Sueldo'=>'required'
        ]);

        $pago = new pagosalario;
        $pago -> cod_empleado = $request -> get('codc');
        $pago -> sueldo_bruto = $request -> get('SueldoB');
        $pago -> IHSS = $request -> get('IHSS');
        $pago -> RAP = $request -> get('RAP');
        $pago -> otras_deducciones = $request -> get('deducciones');
        $pago -> vacaciones = $request -> get('vacaciones');
        $pago -> descripcion_vacaciones = $request -> get('Descripcion');
        $pago -> periodo_pago = $request -> get('periodo');
        $pago -> salario = $request -> get('Sueldo');
        $pago -> estado = 1;
        $pago -> usr_registro = auth()->user()->name;
        $pago -> fecha_registro = now();
        $pago -> save();

        return redirect()->route('pagosalario.index')->with('store', 'registro');
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
        $tabla_colaboradores = DB::table('colaboradores as c')
        ->join('persona as p', 'c.cod_persona', '=', 'p.cod_persona')
        ->select('c.cod_empleado', 'p.primer_nom', 'p.primer_apellido', 'c.sueldo_bruto')
        ->where('c.estado', '=', '1')
        ->get();

        $pagosalarioactu = DB::table('pago_salario as ps')
        ->join('colaboradores as c', 'ps.cod_empleado', '=', 'c.cod_empleado')
        ->join('persona as p','c.cod_persona','=','p.cod_persona')
        ->select('ps.cod_empleado', DB::raw('CONCAT(p.primer_nom," ",p.primer_apellido) as nombre'), 'ps.cod_pago',
        'ps.sueldo_bruto', 'ps.IHSS', 'ps.RAP', 'ps.otras_deducciones', 'ps.vacaciones', 'ps.descripcion_vacaciones',
        'ps.salario', 'ps.periodo_pago', 'ps.fecha_registro')
        ->where('ps.cod_pago', '=', $cod_pago)->first();

        return view('empleados.pagosalario.edit',['pagosalarioactu'=>$pagosalarioactu, 'tabla_colaboradores'=>$tabla_colaboradores]);
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
            'codc'=>'required',
            'SueldoB'=>'required',
            'IHSS'=>'required',
            'RAP'=>'required',
            'deducciones'=>'required',
            'vacaciones'=>'required',
            'Descripcion'=>'required',
            'periodo' => 'required',
            'fecha_pago' => 'required',
            'Sueldo'=>'required'
        ]);

        $pago = pagosalario::findOrFail($cod_pago);
        $pago -> cod_empleado = $request -> get('codc');
        $pago -> sueldo_bruto = $request -> get('SueldoB');
        $pago -> IHSS = $request -> get('IHSS');
        $pago -> RAP = $request -> get('RAP');
        $pago -> otras_deducciones = $request -> get('deducciones');
        $pago -> vacaciones = $request -> get('vacaciones');
        $pago -> descripcion_vacaciones = $request -> get('Descripcion');
        $pago -> periodo_pago = $request -> get('periodo');
        $pago -> fecha_registro = $request -> get('fecha_pago');
        $pago -> salario = $request -> get('Sueldo');
        $pago -> update();

        return redirect()->route('pagosalario.index')->with('update', 'editado');
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

    public function exportexcel()
    {
        return Excel::download(new PagosalarioExport, 'planilla.xlsx');
    }

    public function importexcel(Request $request)
    {
        $file = $request->file('import_file');

        Excel::import(new PagosalarioImport, $file);

        return redirect()->route('pagosalario.index')->with('succes', 'Ok');
    }

    public function changestatus($cod_pago){ 

        $estadoupdate = pagosalario::select('estado')->where('cod_pago', $cod_pago)->first();
    
        if($estadoupdate->estado == 1)  {
            $estado = 0;
        }else{
            $estado = 1;
        }
        pagosalario::where('cod_pago', $cod_pago)->update(['estado' => $estado]);
        return redirect()->route('pagosalario.index')->with('eliminar', 'Ok');
    }
}
