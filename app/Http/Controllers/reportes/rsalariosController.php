<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;


class rsalariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportesalarios = DB::table('pago_salario as ps')
        ->join('colaboradores as c','c.cod_empleado','=','ps.cod_empleado')
        ->join('persona as p','c.cod_persona','=','p.cod_persona')
        ->select('ps.cod_pago', 'c.cod_empleado', DB::raw('CONCAT(p.primer_nom," ",p.primer_apellido) as nombre'), 'ps.sueldo_bruto', 'ps.IHSS', 'ps.RAP', 'ps.otras_deducciones' , 'ps.vacaciones', 'ps.descripcion_vacaciones', 'ps.salario', 'ps.usr_registro', 'ps.fecha_registro')
        ->get();
        $user = Auth::user();
        $fecha = now();
        return view('reportes.reportesalarios.index',["user"=>$user, "fecha"=>$fecha, "reportesalarios"=>$reportesalarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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
}