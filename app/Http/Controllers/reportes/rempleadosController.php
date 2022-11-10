<?php

namespace App\Http\Controllers\reportes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;


class rempleadosController extends Controller
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
        $reportempleado = DB::table('colaboradores as c')
        ->join('persona as p','c.cod_persona','=','p.cod_persona')
        ->join('correos as cr','c.cod_persona','=','cr.cod_persona')
        ->join('telefonos as t','c.cod_persona','=','t.cod_persona')
        ->select('c.cod_empleado','p.primer_nom', 'p.primer_apellido', 'p.segund_nom', 'p.segund_apellido','cr.correo', 't.telefono', 'c.sueldo_bruto', 'c.usr_registro','c.fecha_registro')
        ->orderBy('c.cod_empleado', 'desc')->get();
        $user = Auth::user();
        $fecha = now();
        return view('reportes.reportempleado.index',["user"=>$user, "fecha"=>$fecha, "reportempleado"=>$reportempleado]);
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