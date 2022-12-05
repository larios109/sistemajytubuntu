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
        $this->middleware('permission:visualizar productos|Registrar producto|editar producto|editar estado producto',['only'=>['index']]);
        $this->middleware('permission:Registrar producto',['only'=>['create','store']]);
        $this->middleware('permission:editar producto',['only'=>['edit','update']]);
        $this->middleware('permission:editar estado producto',['only'=>['changestatus']]);
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
