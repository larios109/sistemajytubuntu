<?php

namespace App\Http\Controllers\materiaprima;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;

class materiasalienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar materia saliente|Registrar materia saliente|editar materia saliente|borrar materia saliente',['only'=>['index']]);
        $this->middleware('permission:Registrar materia saliente',['only'=>['create','store']]);
        $this->middleware('permission:editar materia saliente',['only'=>['edit','update']]);
        $this->middleware('permission:borrar materia saliente',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/materia_saliente');
        $user = Auth::user();
        $fecha = now();
        return view('materiaprima.materiasaliente.index',["user"=>$user, "fecha"=>$fecha])
        ->with('materiasaliente', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiaentrante=DB::table('materia_prima_entrante')->get();
        return view('materiaprima.materiasaliente.create',["materiaentrante"=>$materiaentrante]);
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
            'Materia'=>'required',
            'Descripcion'=>'required',
            'cantidad'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/materia_saliente/insertar', [
            'pi_cod_materia_e' => $request->Materia,
            'descripcion_s' => $request->Descripcion,
            'cant_saliente' => $request->cantidad,
            'usr_registro' =>  auth()->user()->name,
        ]);

        return redirect()->route('materiasaliente.index'); 
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
    public function edit($cod_materia_s)
    {
        $materiaentrante=DB::table('materia_prima_entrante')->get();

        $response=Http::get('http://localhost:3000/materia_saliente/'.$cod_materia_s);
        $materiasalientes=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['materiasalientes']=$materiasalientes;

        return view('materiaprima.materiasaliente.edit',['materiasalientes'=>$materiasalientes, "materiaentrante"=>$materiaentrante]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_materia_s)
    {
        $request->validate([
            'Materia'=>'required',
            'Descripcion'=>'required',
            'cantidad'=>'required'
        ]);

        $response = Http::put('http://localhost:3000/materia_saliente/actualizar/' . $cod_materia_s, [
            'cod_materia_e' => $request->Materia,
            'descripcion_s' => $request->Descripcion,
            'cant_saliente' => $request->cantidad,
            'usr_registro' =>  auth()->user()->name,
        ]);

        return redirect()->route('materiasaliente.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_materia_s)
    {
        $eliminar = Http::delete('http://localhost:3000/materia_saliente/eliminar/'.$cod_materia_s);
        return redirect()->route('materiasaliente.index')->with('eliminar', 'Ok'); 
    }
}