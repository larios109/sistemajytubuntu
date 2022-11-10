<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\correo;
use Illuminate\Support\Facades\DB;

class correosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar correos|Registrar correo|editar correo|borrar correo',['only'=>['index']]);
        $this->middleware('permission:Registrar correo',['only'=>['create','store']]);
        $this->middleware('permission:editar correo',['only'=>['edit','update']]);
        $this->middleware('permission:borrar correo',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/correo');
        $user = Auth::user();
        $fecha = now();
        return view('personas.correos.index',["user"=>$user, "fecha"=>$fecha])
        ->with('correos', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/users');
        $response2 = Http::get('http://localhost:3000/personas');
        return view('personas.correos.create')
        ->with('users', json_decode($response,true))
        ->with('personas', json_decode($response2,true));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'persona'=>'required',
            'Correo'=>'required',
            'Registro'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/correo/insertar', [
            'cod_persona' => $request->persona,
            'correo' => $request->Correo,
            'usr_registro' =>  auth()->user()->name,
            'fec_registro' => $request->Registro
        ]);

        return redirect()->route('correos.index');
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
    public function edit($cod_correo)
    {
        $response2 = Http::get('http://localhost:3000/users');
        $personas = DB::table('persona')->get();

        $response=Http::get('http://localhost:3000/correo/'.$cod_correo);
        $actualizarcorreo=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizarcorreo']=$actualizarcorreo;

        return view ('personas.correos.edit',['actualizarcorreo'=>$actualizarcorreo, 'personas'=>$personas])
        ->with('users', json_decode($response2,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_correo)
    {
        $request->validate([
            'persona'=>'required',
            'Correo'=>'required',
        ]);


        $response = Http::put('http://localhost:3000/correo/actualizar/'. $cod_correo, [
            'cod_persona' => $request->persona,
            'correo' => $request->Correo,
            'usr_registro' =>  auth()->user()->name,
            'fec_registro' => $request->Registro
        ]);

        return redirect()->route('correos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_correo)
    {
        $eliminar = Http::delete('http://localhost:3000/correo/eliminar/'.$cod_correo);
        return redirect()->route('correos.index')->with('eliminar', 'Ok');
    }
}