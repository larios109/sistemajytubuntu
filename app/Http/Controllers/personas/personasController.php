<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\personasrequest;
use Illuminate\Support\Facades\DB;
use App\Models\persona;
use App\Models\correo;
use App\Models\direcciones;
use App\Models\telefonos;
use Illuminate\Support\Collection;

class personasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar personas|Registrar persona|editar persona|editar estado persona',['only'=>['index']]);
        $this->middleware('permission:Registrar persona',['only'=>['create','store']]);
        $this->middleware('permission:editar persona',['only'=>['edit','update', 'show']]);
        $this->middleware('permission:editar estado persona',['only'=>['changestatus']]);
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
        $personas = DB::table('persona')->get();
        return view('personas.personas.index',["user"=>$user, "fecha"=>$fecha, "personas"=>$personas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personas.personas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personasrequest $request)
    {
        $persona = new persona;
        $persona -> primer_nom = $request -> get('Nombre');
        $persona -> segund_nom = $request -> get('Nombre2');
        $persona -> primer_apellido = $request -> get('Apellido');
        $persona -> segund_apellido = $request -> get('Apellido2');
        $persona -> dni = $request -> get('DNI');
        $persona -> genero = $request -> get('Genero');
        $persona -> tipo_persona = $request -> get('tipo');
        $persona -> estado = 1;
        $persona -> fecha_registro = now();
        $persona -> usr_registro = auth()->user()->name;
        $persona -> save();

        $correo = new correo;
        $correo -> cod_persona = $persona -> cod_persona;
        $correo -> correo = $request -> get('Correo');
        $correo -> usr_registro = auth()->user()->name;
        $correo -> fec_registro = now();
        $correo -> save();

        $telefono = new telefonos;
        $telefono -> cod_persona = $persona -> cod_persona;
        $telefono -> tip_telefono = $request -> get('tipotelefono');
        $telefono -> telefono = $request -> get('Telefono');
        $telefono -> usr_registro = auth()->user()->name;
        $telefono -> fec_registro = now();
        $telefono -> save();

        $direccion = new direcciones;
        $direccion -> cod_persona = $persona -> cod_persona;
        $direccion -> ref_direccion = $request -> get('direccion');
        $direccion -> departamento_id = $request -> get('Departamento');
        $direccion -> municipio_id = $request -> get('Municipio');
        $direccion -> usr_registro = auth()->user()->name;
        $direccion -> save();

        return redirect()->route('personas.index')->with('store', 'registro');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cod_persona)
    {
        $actualizarpersona = DB::table('persona as p')
        ->join('telefonos as t', 't.cod_persona', '=', 'p.cod_persona')
        ->join('correos as c', 'c.cod_persona', '=', 'p.cod_persona')
        ->join('direcciones as d', 'd.cod_persona', '=', 'p.cod_persona')
        ->select('p.cod_persona', 'p.primer_nom', 'p.segund_nom', 'p.primer_apellido', 'p.segund_apellido',
        'p.dni', 'p.genero', 'p.tipo_persona', 'c.cod_correo', 'c.correo', 't.cod_telefono', 't.telefono', 't.tip_telefono', 'd.cod_direccion'
        ,'d.ref_direccion', 'd.departamento_id', 'd.municipio_id')
        ->where('p.cod_persona', '=', $cod_persona)->first();

        return view('personas.personas.show',['actualizarpersona'=>$actualizarpersona]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $cod_detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_persona)
    {
        $actualizarpersona = DB::table('persona as p')
        ->join('telefonos as t', 't.cod_persona', '=', 'p.cod_persona')
        ->join('correos as c', 'c.cod_persona', '=', 'p.cod_persona')
        ->join('direcciones as d', 'd.cod_persona', '=', 'p.cod_persona')
        ->select('p.cod_persona', 'p.primer_nom', 'p.segund_nom', 'p.primer_apellido', 'p.segund_apellido',
        'p.dni', 'p.genero', 'p.tipo_persona', 'c.cod_correo', 'c.correo', 't.cod_telefono', 't.telefono', 't.tip_telefono', 'd.cod_direccion'
        ,'d.ref_direccion', 'd.departamento_id', 'd.municipio_id')
        ->where('p.cod_persona', '=', $cod_persona)->first();

        return view('personas.personas.show',['actualizarpersona'=>$actualizarpersona]);
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

        $persona = persona::findOrFail($cod_persona);
        $persona -> primer_nom = $request -> get('Nombre');
        $persona -> segund_nom = $request -> get('Nombre2');
        $persona -> primer_apellido = $request -> get('Apellido');
        $persona -> segund_apellido = $request -> get('Apellido2');
        $persona -> dni = $request -> get('DNI');
        $persona -> genero = $request -> get('Genero');
        $persona -> tipo_persona = $request -> get('tipo');
        $persona -> update();

        $correo = correo::findOrFail($cod_persona);
        $correo -> correo = $request -> get('Correo');
        $correo -> usr_registro = auth()->user()->name;
        $correo -> fec_registro = now();
        $correo -> update();

        $telefono = telefonos::findOrFail($cod_persona);
        $telefono -> tip_telefono = $request -> get('tipotelefono');
        $telefono -> telefono = $request -> get('Telefono');
        $telefono -> update();

        return redirect()->route('personas.index')->with('update', 'editado');
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

    public function changestatus($cod_persona){ 

        $estadoupdate = persona::select('estado')->where('cod_persona', $cod_persona)->first();
    
        if($estadoupdate->estado == 1)  {
            $estado = 0;
        }else{
            $estado = 1;
        }
        persona::where('cod_persona', $cod_persona)->update(['estado' => $estado]);
        return redirect()->route('personas.index')->with('eliminar', 'Ok');
    }
}