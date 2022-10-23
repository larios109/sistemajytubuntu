<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\categoriaproductosrequest;


class categoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->categoria|crear->categoria|editar->categoria|borrar->categoria',['only'=>['index']]);
        $this->middleware('permission:crear->categoria',['only'=>['create','store']]);
        $this->middleware('permission:editar->categoria',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->categoria',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/categoria_productos');
        return view('productos.categoria.index')
        ->with('categoria', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categoriaproductosrequest $request)
    {

        $response = Http::post('http://localhost:3000/categoria_productos/insertar', [
            'nom_cat' => $request->categoria,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('categoria.index');
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
    public function edit($cod_cate_produc)
    {
        $response=Http::get('http://localhost:3000/categoria_productos/'.$cod_cate_produc);
        $actualizarcategoria=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizarcategoria']=$actualizarcategoria;

        return view ('productos.categoria.edit',['actualizarcategoria'=>$actualizarcategoria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(categoriaproductosrequest $request, $cod_cate_produc)
    {

        $response = Http::put('http://localhost:3000/categoria_productos/actualizar/' . $cod_cate_produc, [
            'nom_cat' => $request->categoria,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_cate_produc)
    {
        $eliminar = Http::delete('http://localhost:3000/categoria_productos/eliminar/'.$cod_cate_produc);
        return redirect()->route('categoria.index')->with('eliminar', 'Ok');
    }
}