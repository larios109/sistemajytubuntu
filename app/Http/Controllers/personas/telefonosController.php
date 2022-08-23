<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\telefono;

class telefonosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->telefonos|crear->telefonos|editar->telefonos|borrar->telefonos',['only'=>['index']]);
        $this->middleware('permission:crear->telefonos',['only'=>['create','store']]);
        $this->middleware('permission:editar->telefonos',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->telefonos',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/telefono');
        return view('personas.telefonos.index')
        ->with('telefonos', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/users');
        $response2 = Http::get('http://localhost:3000/personas');
        return view('personas.telefonos.create')
        ->with('users', json_decode($response,true))
        ->with('personas', json_decode($response2,true));
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
            'persona'=>'required',
            'tipotelefono'=>'required',
            'Telefono'=>'required',
            'Registro'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/telefono/insertar', [
            'cod_persona' => $request->persona,
            'tip_telefono' => $request->tipotelefono,
            'telefono' => $request->Telefono,
            'usr_registro' =>  auth()->user()->name,
            'fec_registro' => $request->Registro
        ]);

        return redirect()->route('telefonos.index');
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
    public function edit($cod_telefono)
    {
        $response2 = Http::get('http://localhost:3000/users');
        $response3 = Http::get('http://localhost:3000/personas');

        $response  =Http::get('http://localhost:3000/telefono/'.$cod_telefono);
        $actualizartelefono = json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizartelefono']=$actualizartelefono;

        return view ('personas.telefonos.edit',['actualizartelefono'=>$actualizartelefono])
        ->with('users', json_decode($response2,true))
        ->with('personas', json_decode($response3,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_telefono)
    {
        $request->validate([
            'persona'=>'required',
            'tipotelefono'=>'required',
            'Telefono'=>'required',
        ]);
    
        $response = Http::put('http://localhost:3000/telefono/actualizar/' . $cod_telefono, [
            'cod_persona' => $request->persona,
            'tip_telefono' => $request->tipotelefono,
            'telefono' => $request->Telefono,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('telefonos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_telefono)
    {
        $eliminar = Http::delete('http://localhost:3000/telefono/eliminar/'.$cod_telefono);
        return redirect()->route('telefonos.index')->with('eliminar', 'Ok');
    }
}