<?php

namespace App\Http\Controllers\seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\presguntasrequest;
use App\Models\preguntas;

class preguntasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar preguntas|crear pregunta|editar pregunta|editar estado preguntas',['only'=>['index']]);
        $this->middleware('permission:crear pregunta',['only'=>['create','store']]);
        $this->middleware('permission:editar pregunta',['only'=>['edit','update']]);
        $this->middleware('permission:editar estado preguntas',['only'=>['changestatus']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas = DB::table('preguntas')->get();
        $user = Auth::user();
        $fecha = now();
        return view('seguridad.preguntas.index',["user"=>$user, "fecha"=>$fecha, "preguntas"=>$preguntas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seguridad.preguntas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(presguntasrequest $request)
    {
        $pregunta = new preguntas;
        $pregunta -> pregunta = $request -> get('pregunta');
        $pregunta -> respuesta = $request -> get('respuesta');
        $pregunta -> estado = 1;
        $pregunta -> usr_registro = auth()->user()->name;
        $pregunta -> save();

        return redirect()->route('preguntas.index')->with('store', 'registro');
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
     * @param  int  $cod_detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_pregunta)
    {
        $actualizarpregunta = preguntas::findOrFail($cod_pregunta);

        return view ('seguridad.preguntas.edit',['actualizarpregunta'=>$actualizarpregunta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_pregunta)
    {
        $request->validate([
            'pregunta'=>'required',
            'respuesta'=>'required'
        ]);

        $preguntas = preguntas::findOrFail($cod_pregunta);
        $preguntas ->pregunta = $request->pregunta;
        $preguntas ->respuesta = $request->respuesta;
        $preguntas ->update();

        return redirect()->route('preguntas.index')->with('update', 'editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_pregunta)
    {

    }

    public function changestatus($cod_pregunta){ 

        $estadoupdate = preguntas::select('estado')->where('cod_pregunta', $cod_pregunta)->first();
    
        if($estadoupdate->estado == 1)  {
            $estado = 0;
        }else{
            $estado = 1;
        }
        preguntas::where('cod_pregunta', $cod_pregunta)->update(['estado' => $estado]);
        return redirect()->route('preguntas.index')->with('eliminar', 'Ok');
    }
}