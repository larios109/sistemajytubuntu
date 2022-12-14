<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;
use App\Models\productos;
use App\Models\kardex;

class kardexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar kardex|Registrar kardex|editar kardex|',['only'=>['index']]);
        $this->middleware('permission:Registrar kardex',['only'=>['create','store']]);
        $this->middleware('permission:editar kardex',['only'=>['edit','update']]);
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
            $user = Auth::user();

            $fecha = now();

            $movimientos = DB::table('kardex as k')
            ->join('articulo as a', 'k.idarticulo', '=', 'a.idarticulo')
            ->select('k.cod_kardex', 'a.nombre', 'k.movimiento as kardex', 'k.cant', 'k.usr_registro', 'k.fecha_registro')
            ->orderBy('k.cod_kardex','desc')
            ->get();

            return view('productos.kardex.index',["movimientos"=>$movimientos, "user"=>$user, "fecha"=>$fecha]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $articulos=DB::table('articulo as art')
        ->select('idarticulo' ,'nombre', 'stock','tip_medida')
        ->where([['stock', '>', '0'], ['estado', '=', '1'],])
        ->get();

        return view("productos.kardex.create",["articulos"=>$articulos]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $kardex = new kardex;
        $kardex -> idarticulo = $request -> get('codproducto');
        $kardex -> movimiento = $request -> get('movimiento');
        $kardex -> cant = $request -> get('cantidad');
        $idarticulo = $request -> get('codproducto');
        $producto = productos::where('idarticulo', $idarticulo)->first();
        $producto -> stock -= $request -> get('cantidad');
        $producto ->save();
        $kardex -> usr_registro = auth()->user()->name;
        $kardex -> fecha_registro = now();
        $kardex -> save();

        return redirect()->route('kardex.index')->with('store', 'registro');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idarticulo)
    {


        $kardex = new kardex;
        $kardex -> idarticulo = $request -> get('codproducto');
        $kardex -> movimiento = $request -> get('movimiento');
        $kardex -> cant = $request -> get('cantidad');
        $kardex -> usr_registro = auth()->user()->name;
        $kardex -> fecha_registro = now();
        $kardex -> save();



        return redirect()->route('kardex.index')->with('store', 'registro');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
    public function destroy($id)
    {

    }
}
