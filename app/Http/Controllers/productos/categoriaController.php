<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\categoriaproductosrequest;
use App\Models\categoria;
use Illuminate\Support\Facades\DB;


class categoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar categorias|Registrar categoria|editar categoria|borrar categoria',['only'=>['index']]);
        $this->middleware('permission:Registrar categoria',['only'=>['create','store']]);
        $this->middleware('permission:editar categoria',['only'=>['edit','update']]);
        $this->middleware('permission:borrar categoria',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = DB::table('categoria')
        ->select('idcategoria','nombre','descripcion')->orderBy('idcategoria', 'desc')->get();
        $user = Auth::user();
        $fecha = now();
        return view('productos.categoria.index',["categorias"=>$categorias, "user"=>$user, "fecha"=>$fecha]);
        
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

        $categoria = new categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

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
    public function edit($idcategoria)
    {
        $categorias = categoria::findOrFail($idcategoria);
        return view ('productos.categoria.edit',['categorias'=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idcategoria)
    {
        $categoria = categoria::findOrFail($idcategoria);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        return redirect()->route('categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idcategoria)
    {
        $categoria = categoria::findOrFail($idcategoria);
        $categoria->delete();
        return redirect()->route('categoria.index')->with('eliminar', 'Ok');
    }
}