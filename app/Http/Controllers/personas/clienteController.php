<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\cliente;
use App\Http\Requests\clientesrequest;
use Illuminate\Support\Facades\DB;

class clienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar clientes|Registrar cliente|editar cliente|borrar cliente',['only'=>['index']]);
        $this->middleware('permission:Registrar cliente',['only'=>['create','store']]);
        $this->middleware('permission:editar cliente',['only'=>['edit','update']]);
        $this->middleware('permission:borrar cliente',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = DB::table('cliente')->get();
        $user = Auth::user();
        $fecha = now();
        return view("personas.cliente.index", ["clientes" => $clientes, "user"=>$user, "fecha"=>$fecha]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('personas.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(clientesrequest $request)
    {
        $cliente = new cliente;
        $cliente -> primer_nom = $request -> get('Nombre');
        $cliente -> segund_nom = $request -> get('Nombre2');
        $cliente -> primer_apellido = $request -> get('Apellido');
        $cliente -> segund_apellido = $request -> get('Apellido2');
        $cliente -> dni = $request -> get('DNI');
        $cliente -> genero = $request -> get('Genero');
        $cliente -> fecha_registro = now();
        $cliente -> usr_registro = auth()->user()->name;
        $cliente -> save();

        return redirect()->route('cliente.index');
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
    public function edit($cod_cliente)
    {
        $cliente = cliente::findOrFail($cod_cliente);
        return view('personas.cliente.edit', ["cliente" => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_cliente)
    {
        $request->validate([
            'Nombre'=>'required',
            'Nombre2'=>'required',
            'Apellido'=>'required',
            'Apellido2'=>'required',
            'DNI'=>'required',
            'Genero'=>'required',
        ]);

        $cliente = cliente::findOrFail($cod_cliente);
        $cliente -> primer_nom = $request -> get('Nombre');
        $cliente -> segund_nom = $request -> get('Nombre2');
        $cliente -> primer_apellido = $request -> get('Apellido');
        $cliente -> segund_apellido = $request -> get('Apellido2');
        $cliente -> dni = $request -> get('DNI');
        $cliente -> genero = $request -> get('Genero');
        $cliente -> usr_registro = auth()->user()->name;
        $cliente -> update();
        return redirect()->route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_cliente)
    {
        $cliente = cliente::findOrFail($cod_cliente);
        $cliente->delete();
        return redirect()->route('cliente.index')->with('eliminar', 'Ok');
    }
}
