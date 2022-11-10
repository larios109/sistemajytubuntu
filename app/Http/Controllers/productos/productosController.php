<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\productorequest;
use Illuminate\Support\Facades\DB;
use App\Models\productos;

class productosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar productos|Registrar producto|editar producto|borrar producto',['only'=>['index']]);
        $this->middleware('permission:Registrar producto',['only'=>['create','store']]);
        $this->middleware('permission:editar producto',['only'=>['edit','update']]);
        $this->middleware('permission:borrar producto',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request)
        {
            $productos=DB::table('articulo as a')
            ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
            ->select('a.idarticulo', 'c.nombre AS categoria', 'a.nombre', 'a.precio_producto', 'a.stock', 'a.descripcion')
            ->orderBy('a.idarticulo','desc')->get();
            $user = Auth::user();
            $fecha = now();
            return view('productos.productos.index',["productos"=>$productos, "user"=>$user, "fecha"=>$fecha]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categorias = DB::table('categoria')->get();
        return view('productos.productos.create',["categorias"=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(productorequest $request)
    {
        $producto = new productos;
        $producto -> idcategoria = $request -> get('idcategoria');
        $producto -> nombre = $request -> get('nombre');
        $producto -> precio_producto = $request -> get('precio_producto');
        $producto -> stock = $request -> get('stock');
        $producto -> descripcion = $request -> get('descripcion');
        $producto -> usr_registro = auth()->user()->name;
        $producto -> save();

        return redirect()->route('productos.index');
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
    public function edit($idarticulo)
    {
        $producto = productos::findOrFail($idarticulo);
        $categorias = DB::table('categoria')->get();
        return view("productos.productos.edit", ["producto" => $producto, "categorias" => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idarticulo)
    {
        $producto = productos::findOrFail($idarticulo);
        $producto -> idcategoria = $request -> get('idcategoria');
        $producto -> nombre = $request -> get('nombre');
        $producto -> precio_producto = $request -> get('precio_producto');
        $producto -> descripcion = $request -> get('descripcion');
        $producto -> stock = $request -> get('stock');
        $producto -> update();
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idarticulo)
    {
        $producto = productos::findOrFail($idarticulo);
        $producto->delete();
        return redirect()->route('productos.index')->with('eliminar', 'Ok');
    }
}
