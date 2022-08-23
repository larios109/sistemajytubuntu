<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;

class inventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->inventario|crear->inventario|editar->inventario|borrar->inventario',['only'=>['index']]);
        $this->middleware('permission:crear->inventario',['only'=>['create','store']]);
        $this->middleware('permission:editar->inventario',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->inventario',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/inventario');
        return view('productos.inventario.index')
        ->with('productosinventario', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/lista_productos');
        return view('productos.inventario.create')
        ->with('productos', json_decode($response,true));
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
            'Producto'=>'required',
            'cantidad'=>'required',
            'caducidad'=>'required',
        ]);

        $response = Http::post('http://localhost:3000/inventario/insertar', [
            'cod_producto' => $request->Producto,
            'cant_invent' => $request->cantidad,
            'fech_caducidad' => $request->caducidad,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('inventario.index');
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
    public function edit($cod_invent)
    {
        $response2 = Http::get('http://localhost:3000/lista_productos');

        $response=Http::get('http://localhost:3000/inventario/'.$cod_invent);
        $productoinvent=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['productoinvent']=$productoinvent;

        return view ('productos.inventario.edit',['productoinvent'=>$productoinvent])
        ->with('productos', json_decode($response2,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_invent)
    {
        $request->validate([
            'Producto'=>'required',
            'cantidad'=>'required',
            'caducidad'=>'required',
        ]);

        $actualizarproductint = Http::put('http://localhost:3000/inventario/actualizar/' . $cod_invent, [
            'cod_producto' => $request->Producto,
            'cant_invent' => $request->cantidad,
            'fech_caducidad' => $request->caducidad,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('inventario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_invent)
    {
        $eliminar = Http::delete('http://localhost:3000/inventario/eliminar/'.$cod_invent);
        return redirect()->route('inventario.index')->with('eliminar', 'Ok');
    }
}