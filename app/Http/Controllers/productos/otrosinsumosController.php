<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\otrosinsumosrequest;
use Illuminate\Validation\Validator;

class otrosinsumosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar otros insumos|Registrar otros insumos|editar otros insumos|borrar otros insumos',['only'=>['index']]);
        $this->middleware('permission:Registrar otros insumos',['only'=>['create','store']]);
        $this->middleware('permission:editar otros insumos',['only'=>['edit','update']]);
        $this->middleware('permission:borrar otros insumos',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/otros_insumos');
        $user = Auth::user();
        $fecha = now();
        return view('productos.otrosinsumos.index',["user"=>$user, "fecha"=>$fecha])
        ->with('otrosinsumos', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.otrosinsumos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(otrosinsumosrequest $request)
    {

        $response = Http::post('http://localhost:3000/otros_insumos/insertar', [
            'insumo' => $request->insumo,
            'descripcion' => $request->Descripcion,
            'precio' => $request->Precio,
            'cant' => $request->cantidad,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('otrosinsumos.index');
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
    public function edit($cod_insumos)
    {
        $response=Http::get('http://localhost:3000/otros_insumos/'.$cod_insumos);
        $otrosinsumos=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['otrosinsumos']=$otrosinsumos;

        return view ('productos.otrosinsumos.edit',['otrosinsumos'=>$otrosinsumos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_insumos)
    {
        $request->validate([
            'insumo'=>'required',
            'Descripcion'=>'required',
            'Precio'=>'required',
            'cantidad'=>'required'
        ]); 

        $response = Http::put('http://localhost:3000/otros_insumos/actualizar/' . $cod_insumos, [
            'insumo' => $request->insumo,
            'descripcion' => $request->Descripcion,
            'precio' => $request->Precio,
            'cant' => $request->cantidad,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('otrosinsumos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_insumos)
    {
        $eliminar = Http::delete('http://localhost:3000/otros_insumos/eliminar/'.$cod_insumos);
        return redirect()->route('otrosinsumos.index')->with('eliminar', 'Ok');
    }
}