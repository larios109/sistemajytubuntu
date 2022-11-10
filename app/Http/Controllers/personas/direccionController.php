<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\DB;

class direccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar direcciones|Registrar direccion|editar direccion|borrar direccion',['only'=>['index']]);
        $this->middleware('permission:Registrar direccion',['only'=>['create','store']]);
        $this->middleware('permission:editar direccion',['only'=>['edit','update']]);
        $this->middleware('permission:borrar direccion',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $fecha = now();
        $response = Http::get('http://localhost:3000/direccion');
        return view('personas.direccion.index', ["user"=>$user, "fecha"=>$fecha])
        ->with('direccion', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/personas');
        $response2 = Http::get('http://localhost:3000/departamento');
        $response3 = Http::get('http://localhost:3000/municipio');
        return view('personas.direccion.create')
        ->with('personas', json_decode($response,true))
        ->with('departamento', json_decode($response2,true))
        ->with('municipio', json_decode($response3,true));
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
            'direccion'=>'required',
            'Departamento'=>'required',
            'Municipio'=>'required',
        ]);

        $response = Http::post('http://localhost:3000/direccion/insertar', [
            'cod_persona' => $request->persona,
            'ref_direccion' => $request->direccion,
            'departamento_id' => $request->Departamento,
            'municipio_id' => $request->Municipio,
            'usr_registro' => auth()->user()->name
        ]);

        return redirect()->route('direccion.index');
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
    public function edit($cod_direccion)
    {
        $personas = DB::table('persona')->get();
        $response3 = Http::get('http://localhost:3000/departamento');
        $response4 = Http::get('http://localhost:3000/municipio');

        $response = Http::get('http://localhost:3000/direccion/'.$cod_direccion);
        $direccionactu = json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['direccionactu']=$direccionactu;

        return view('personas.direccion.edit',['direccionactu'=>$direccionactu, 'personas'=>$personas])
        ->with('departamento', json_decode($response3,true))
        ->with('municipio', json_decode($response4,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_direccion)
    {
        $request->validate([
            'persona'=>'required',
            'direccion'=>'required',
            'Departamento'=>'required',
            'Municipio'=>'required',
        ]);

        $response = Http::put('http://localhost:3000/direccion/actualizar/' . $cod_direccion, [
            'cod_persona' => $request->persona,
            'ref_direccion' => $request->direccion,
            'departamento_id' => $request->Departamento,
            'municipio_id' => $request->Municipio,
            'usr_registro' => auth()->user()->name
        ]);

        return redirect()->route('direccion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_direccion)
    {
        $eliminar = Http::delete('http://localhost:3000/direccion/eliminar/'.$cod_direccion);
        return redirect()->route('direccion.index')->with('eliminar', 'Ok');
    }
}