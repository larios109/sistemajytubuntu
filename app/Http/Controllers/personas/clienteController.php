<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\cliente;
use App\Http\Requests\clientesrequest;

class clienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->cliente|crear->cliente|editar->cliente|borrar->cliente',['only'=>['index']]);
        $this->middleware('permission:crear->cliente',['only'=>['create','store']]);
        $this->middleware('permission:editar->cliente',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->cliente',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/cliente');
        return view('personas.cliente.index')->with('clientes', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $response = Http::get('http://localhost:3000/personas');
        return view('personas.cliente.create')
        ->with('personas', json_decode($response,true));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(clientesrequest $request)
    {
        $response = Http::post('http://localhost:3000/cliente/insertar', [
            'cod_persona' => $request->persona,
            'fecha_registro' => $request->Ingreso,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('cliente.index');
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
    public function destroy($cod_cliente)
    {
        $eliminar = Http::delete('http://localhost:3000/cliente/eliminar/'.$cod_cliente);
        return redirect()->route('cliente.index')->with('eliminar', 'Ok');
    }
}
