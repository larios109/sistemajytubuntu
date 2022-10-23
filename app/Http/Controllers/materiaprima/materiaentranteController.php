<?php

namespace App\Http\Controllers\materiaprima;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\materiaentranterequest;

class materiaentranteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->materiaentrante|crear->materiaentrante|editar->materiaentrante|borrar->materiaentrante',['only'=>['index']]);
        $this->middleware('permission:crear->materiaentrante',['only'=>['create','store']]);
        $this->middleware('permission:editar->materiaentrante',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->materiaentrante',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/materia_entrante');
        return view('materiaprima.materiaentrante.index')
        ->with('materiaentrante', json_decode($response,true));
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
        $response = Http::post('http://localhost:3000/materia_entrante/insertar', [
            'nom_materia' => $request->Materia,
            'descripcion' => $request->Descripcion,
            'tip_medida' => $request->Medida,
            'pre_compra' => $request->Precio,
            'cant' => $request->cantidad,
            'fec_caducidad' => $request->caducidad,
            'usr_registro' =>  auth()->user()->name,
        ]);

        return redirect()->route('materiaentrante.index'); 
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

        return redirect()->route('materiaentrante.index'); 
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_materia_e)
    {
        $eliminar = Http::delete('http://localhost:3000/materia_entrante/eliminar/'.$cod_materia_e);
        return redirect()->route('materiaentrante.index')->with('eliminar', 'Ok'); 
    }
}