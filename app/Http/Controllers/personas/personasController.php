<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\personasrequest;
use Illuminate\Support\Facades\DB;
use App\Models\persona;

class personasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar personas|Registrar persona|editar persona|borrar persona',['only'=>['index']]);
        $this->middleware('permission:Registrar persona',['only'=>['create','store']]);
        $this->middleware('permission:editar persona',['only'=>['edit','update']]);
        $this->middleware('permission:borrar persona',['only'=>['destroy']]);
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
        $response = Http::get('http://localhost:3000/personas');
        return view('personas.personas.index',["user"=>$user, "fecha"=>$fecha])
        ->with('personas', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response2 = Http::get('http://localhost:3000/departamento');
        $response3 = Http::get('http://localhost:3000/municipio');
        return view('personas.personas.create')
        ->with('departamento', json_decode($response2,true))
        ->with('municipio', json_decode($response3,true));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personasrequest $request)
    {

        $response = Http::post('http://localhost:3000/personas/insertar', [
            'primer_nom' => $request->Nombre,
            'segund_nom' => $request->Nombre2,
            'primer_apellido' => $request->Apellido,
            'segund_apellido' => $request->Apellido2,
            'tipo_persona' => $request->tipo,
            'dni' => $request->DNI,
            'genero' => $request->Genero,
            'fecha_nacimiento' => $request->Nacimiento,
            'pv_usr_registro' => auth()->user()->name,
            'tip_telefono' => $request->tipotelefono,
            'telefono' => $request->Telefono,
            'correo' => $request->Correo,
            'ref_direccion' => $request->direccion,
            'departamento_id' => $request->Departamento,
            'municipio_id' => $request->Municipio,
        ]);

        return redirect()->route('personas.index');
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
    public function edit($cod_persona)
    {
        $actualizarpersona = persona::findOrFail($cod_persona);

        return view('personas.personas.edit',['actualizarpersona'=>$actualizarpersona]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_persona)
    {
        $request->validate([
            'Nombre'=>'required',
            'Nombre2'=>'required',
            'Apellido'=>'required',
            'Apellido2'=>'required',
            'tipo'=>'required',
            'DNI'=>'required',
            'Genero'=>'required',
            'Nacimiento'=>'required',
        ]);

        $persona = persona::findOrFail($cod_persona);
        $persona -> primer_nom = $request -> get('Nombre');
        $persona -> segund_nom = $request -> get('Nombre2');
        $persona -> primer_apellido = $request -> get('Apellido');
        $persona -> segund_apellido = $request -> get('Apellido2');
        $persona -> tipo_persona = $request -> get('tipo');
        $persona -> dni = $request -> get('DNI');
        $persona -> genero = $request -> get('Genero');
        $persona -> fecha_nacimiento = $request -> get('Nacimiento');
        $persona -> usr_registro = auth()->user()->name;
        $persona -> update();

        return redirect()->route('personas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_persona)
    {
        $eliminar = Http::delete('http://localhost:3000/personas/eliminar/'.$cod_persona);
        return redirect()->route('personas.index')->with('eliminar', 'Ok');
    }
}