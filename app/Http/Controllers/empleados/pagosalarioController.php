<?php

namespace App\Http\Controllers\empleados;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\pagosalario;

class pagosalarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->pagosalario|crear->pagosalario|editar->pagosalario|borrar->pagosalario',['only'=>['index']]);
        $this->middleware('permission:crear->pagosalario',['only'=>['create','store']]);
        $this->middleware('permission:editar->pagosalario',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->pagosalario',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/pago_salario');
        return view('empleados.pagosalario.index')
        ->with('pagosaalario', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/users');
        return view('empleados.pagosalario.create')
        ->with('users', json_decode($response,true));
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
            'Empleado'=>'required',
            'SueldoB'=>'required',
            'IHSS'=>'required',
            'RAP'=>'required',
            'deducciones'=>'required',
            'vacaciones'=>'required',
            'Descripcion'=>'required',
            'Sueldo'=>'required'
        ]);

        $response = Http::post('http://localhost:3000/pago_salario/insertar', [
            'nom_usr' => $request->Empleado,
            'sueldo_bruto' => $request->SueldoB,
            'IHSS' => $request->IHSS,
            'RAP' => $request->RAP,
            'otras_deducciones' => $request->deducciones,
            'vacaciones' => $request->vacaciones,
            'descripcion_vacaciones' => $request->Descripcion,
            'salario' => $request->Sueldo,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('pagosalario.index');
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
    public function edit($cod_pago)
    {
        $response1 = Http::get('http://localhost:3000/users');

        $response=Http::get('http://localhost:3000/pago_salario/'.$cod_pago);
        $pagosalarioactu=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['pagosalarioactu']=$pagosalarioactu;

        return view('empleados.pagosalario.edit',['pagosalarioactu'=>$pagosalarioactu])
        ->with('users', json_decode($response1,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_pago)
    {
        $request->validate([
            'Empleado'=>'required',
            'SueldoB'=>'required',
            'IHSS'=>'required',
            'RAP'=>'required',
            'deducciones'=>'required',
            'vacaciones'=>'required',
            'Descripcion'=>'required',
            'Sueldo'=>'required'
        ]);

        $response = Http::put('http://localhost:3000/pago_salario/actualizar/' . $cod_pago, [
            'nom_usr' => $request->Empleado,
            'sueldo_bruto' => $request->SueldoB,
            'IHSS' => $request->IHSS,
            'RAP' => $request->RAP,
            'otras_deducciones' => $request->deducciones,
            'vacaciones' => $request->vacaciones,
            'descripcion_vacaciones' => $request->Descripcion,
            'salario' => $request->Sueldo,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('pagosalario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_pago)
    {
        $eliminar = Http::delete('http://localhost:3000/pago_salario/eliminar/'.$cod_pago);
        return redirect()->route('pagosalario.index')->with('eliminar', 'Ok');
    }
}
