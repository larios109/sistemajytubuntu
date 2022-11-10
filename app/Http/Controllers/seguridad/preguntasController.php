<?php

namespace App\Http\Controllers\seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\presguntasrequest;

class preguntasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar preguntas|crear pregunta|editar pregunta|borrar pregunta',['only'=>['index']]);
        $this->middleware('permission:crear pregunta',['only'=>['create','store']]);
        $this->middleware('permission:editar pregunta',['only'=>['edit','update']]);
        $this->middleware('permission:borrar pregunta',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/preguntas');
        $user = Auth::user();
        $fecha = now();
        return view('seguridad.preguntas.index',["user"=>$user, "fecha"=>$fecha])
        ->with('preguntas', json_decode($response,true));
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

        $response = Http::post('http://localhost:3000/preguntas/insertar', [
            'pregunta' => $request->pregunta,
            'respuesta' => $request->respuesta,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('preguntas.index');
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
        $response=Http::get('http://localhost:3000/preguntas/'.$cod_pregunta);
        $actualizarpregunta=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizarpregunta']=$actualizarpregunta;

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

        $response = Http::put('http://localhost:3000/preguntas/actualizar/' . $cod_pregunta, [
            'pregunta' => $request->pregunta,
            'respuesta' => $request->respuesta,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('preguntas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_pregunta)
    {
        $eliminar = Http::delete('http://localhost:3000/preguntas/eliminar/'.$cod_pregunta);
        return redirect()->route('preguntas.index')->with('eliminar', 'Ok');
    }
}