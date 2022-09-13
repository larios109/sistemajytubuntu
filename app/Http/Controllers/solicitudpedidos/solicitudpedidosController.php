<?php

namespace App\Http\Controllers\solicitudpedidos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;

class solicitudpedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->venta|crear->venta|editar->venta|borrar->venta',['only'=>['index']]);
        $this->middleware('permission:crear->venta',['only'=>['create','store']]);
        $this->middleware('permission:editar->venta',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->venta',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/ventas');
        return view('solicitudpedidos.solicitudpedidos.index')
        ->with('ventas', json_decode($response,true));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response2 = Http::get('http://localhost:3000/cliente');
        $response3 = Http::get('http://localhost:3000/lista_productos');

        return view('solicitudpedidos.solicitudpedidos.create')
        ->with('clientes', json_decode($response2,true))
        ->with('productos', json_decode($response3,true));
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
            'cliente'=>'required',
            'producto'=>'required',
            'cantidad'=>'required',
            'precio'=>'required',
            'Impuesto'=>'required',
            'total'=>'required',
            'pago'=>'required',
        ]);

        $response = Http::post('http://localhost:3000/ventas/insertar', [
            'cod_cliente' => $request->cliente,
            'pi_cod_producto' => $request->producto,
            'pv_usr_registro' =>auth()->user()->name,
            'cant' =>$request->cantidad,
            'prec_vent_lote' =>$request->precio,
            'impuesto_sobre_venta' =>$request->Impuesto,
            'subtotal' =>$request->total,
            'pv_forma_pago' =>$request->pago,
        ]);
        
        return redirect()->route('solicitudpedidos.index');
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
    public function edit($cod_venta)
    {
        $response3 = Http::get('http://localhost:3000/cliente');
        $response4 = Http::get('http://localhost:3000/lista_productos');

        $response=Http::get('http://localhost:3000/ventas/'.$cod_venta);
        $actualizarventas=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['actualizarventas']=$actualizarventas;

        return view ('solicitudpedidos.solicitudpedidos.edit',['actualizarventas'=>$actualizarventas])
        ->with('productos', json_decode($response4,true))
        ->with('clientes', json_decode($response3,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_venta)
    {
        $request->validate([
            'cliente'=>'required',
            'producto'=>'required',
            'cantidad'=>'required',
            'precio'=>'required',
        ]);

        $detalleventa = Http::put('http://localhost:3000/ventas/actualizar/' . $cod_venta, [
            'cod_cliente' => $request->cliente,
            'cod_producto' => $request->producto,
            'usr_registro' =>auth()->user()->name,
            'cant' =>$request->cantidad,
            'prec_vent_lote' =>$request->precio,
        ]);

        return redirect()->route('solicitudpedidos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_venta)
    {
        $eliminar = Http::delete('http://localhost:3000/ventas/eliminar/'.$cod_venta);
        return redirect()->route('solicitudpedidos.index')->with('eliminar', 'Ok');
    }
}