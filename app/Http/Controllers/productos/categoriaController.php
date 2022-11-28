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
        $this->middleware('permission:visualizar categorias|Registrar categoria|editar categoria|editar estado categoria',['only'=>['index']]);
        $this->middleware('permission:Registrar categoria',['only'=>['create','store']]);
        $this->middleware('permission:editar categoria',['only'=>['edit','update']]);
        $this->middleware('permission:editar estado categoria',['only'=>['changestatus']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = DB::table('categoria')
        ->select('idcategoria','nombre','descripcion', 'estado')->orderBy('idcategoria', 'desc')->get();
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
        $categoria -> estado = 1;
        $categoria->save();

        return redirect()->route('categoria.index')->with('store', 'registro');
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

        return redirect()->route('categoria.index')->with('update', 'editado');
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

    public function changestatus($idcategoria){ 

        $estadoupdate = categoria::select('estado')->where('idcategoria', $idcategoria)->first();
    
        if($estadoupdate->estado == 1)  {
            $estado = 0;
        }else{
            $estado = 1;
        }
        categoria::where('idcategoria', $idcategoria)->update(['estado' => $estado]);
        return redirect()->route('categoria.index')->with('eliminar', 'Ok');
    }
}