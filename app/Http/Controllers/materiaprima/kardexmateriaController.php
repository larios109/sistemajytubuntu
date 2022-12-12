<?php

namespace App\Http\Controllers\materiaprima;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;
use App\Models\mateiraentrante;
use App\Models\materiasaliente;
use App\Models\kardexmateria;

class kardexmateriaController extends Controller
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

            $movimientos = DB::table('kardex_materia as k')
            ->join('materia_prima_entrante as me', 'k.cod_materia_e', '=', 'me.cod_materia_e')
            ->select('k.cod_kardex_materia', 'me.nom_materia', 'k.movimiento as kardex', 'k.cant', 'k.usr_registro', 'k.fecha_registro')
            ->orderBy('k.cod_kardex_materia','desc')
            ->get();

            return view('materiaprima.kardexmateria.index',["movimientos"=>$movimientos, "user"=>$user, "fecha"=>$fecha]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $materiaentratne=DB::table('materia_prima_entrante as me')
        ->select('cod_materia_e' ,'nom_materia', 'cant', 'fec_compra', 'fec_caducidad', 'estado')
        ->where([['cant', '>', '0'], ['estado', '=', '1'],])
        ->get();

        return view("materiaprima.kardexmateria.create",["materiaentratne"=>$materiaentratne]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $kardex = new kardexmateria;
        $kardex -> cod_materia_e = $request -> get('codmateria');
        $kardex -> movimiento = $request -> get('movimiento');
        $kardex -> cant = $request -> get('cantidad');
        $cod_materia_e = $request -> get('codmateria');
        $materia = mateiraentrante::where('cod_materia_e', $cod_materia_e)->first();
        $materia -> cant -= $request -> get('cantidad');
        $materia ->save();
        $kardex -> usr_registro = auth()->user()->name;
        $kardex -> fecha_registro = now();
        $kardex -> save();

        return redirect()->route('kardexmateria.index')->with('store', 'registro');
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
