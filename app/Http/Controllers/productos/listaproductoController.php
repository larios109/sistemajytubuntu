<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\listaproductosrequest;

class listaproductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->listaproductos|crear->listaproductos|editar->listaproductos|borrar->listaproductos',['only'=>['index']]);
        $this->middleware('permission:crear->listaproductos',['only'=>['create','store']]);
        $this->middleware('permission:editar->listaproductos',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->listaproductos',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/lista_productos');
        return view('productos.listaproductos.index')
        ->with('listaproductos', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $response = Http::get('http://localhost:3000/categoria_productos');
        return view('productos.listaproductos.create')
        ->with('categoria', json_decode($response,true));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(listaproductosrequest $request)
    {
        $response = Http::post('http://localhost:3000/lista_productos/insertar', [
            'cod_cate_produc' => $request->Categoria,
            'nombre_producto' => $request->Nombre,
            'descrip_producto' => $request->Descripcion,
            'precio_producto' => $request->Precio,
            'usr_registro' =>  auth()->user()->name
        ]);
        
        return redirect()->route('listaproductos.index');
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
    public function edit($cod_producto)
    {
        $response2 = Http::get('http://localhost:3000/categoria_productos');
        $response=Http::get('http://localhost:3000/lista_productos/'.$cod_producto);
        $listaproducto=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['listaproducto']=$listaproducto;

        return view ('productos.listaproductos.edit',['listaproducto'=>$listaproducto])
        ->with('categoria', json_decode($response,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_producto)
    {
        $request->validate([
            'Categoria'=>'required',
            'Nombre'=>'required',
            'Descripcion'=>'required',
            'Precio'=>'required',
        ]);

        $response = Http::put('http://localhost:3000/lista_productos/actualizar/' . $cod_producto, [
            'cod_cate_produc' => $request->Categoria,
            'nombre_producto' => $request->Nombre,
            'descrip_producto' => $request->Descripcion,
            'precio_producto' => $request->Precio,
            'usr_registro' =>  auth()->user()->name,
        ]);

        return redirect()->route('listaproductos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_producto)
    {
        $eliminar = Http::delete('http://localhost:3000/lista_productos/eliminar/'.$cod_producto);
        return redirect()->route('listaproductos.index')->with('eliminar', 'Ok');
    }
}
