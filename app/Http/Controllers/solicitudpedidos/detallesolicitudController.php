<?php

namespace App\Http\Controllers\solicitudpedidos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;

class detallesolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver->detalleventa|crear->detalleventa|editar->detalleventa|borrar->detalleventa',['only'=>['index']]);
        $this->middleware('permission:crear->detalleventa',['only'=>['create','store']]);
        $this->middleware('permission:editar->detalleventa',['only'=>['edit','update']]);
        $this->middleware('permission:borrar->detalleventa',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://localhost:3000/detalle_venta');
        return view('solicitudpedidos.detallesolicitud.index')
        ->with('detalleventas', json_decode($response,true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('http://localhost:3000/ventas');
        $response2 = Http::get('http://localhost:3000/lista_productos');
        return view('solicitudpedidos.detallesolicitud.create')
        ->with('ventas', json_decode($response,true))
        ->with('producto', json_decode($response2,true));

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
            'codv'=>'required',
            'codigop'=>'required',
            'cantidad'=>'required',
            'precio'=>'required',
            'Impuesto'=>'required',
            'total'=>'required',
            'pago'=>'required',
        ]);

        $response = Http::post('http://localhost:3000/detalle_venta/insertar', [
            'cod_venta' => $request->codv,
            'pi_cod_producto' => $request->codigop,
            'cantidad' => $request->cantidad,
            'precio_venta' => $request->precio,
            'descuento' => $request->descuento,
            'impuesto_sobre_venta' => $request->Impuesto,
            'subtotal' => $request->total,
            'forma_pago' =>$request->pago,
            'usr_registro' =>  auth()->user()->name
        ]);
        
        return redirect()->route('detallesolicitud.index');
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
    public function edit($cod_detalle_venta)
    {
        $response3 = Http::get('http://localhost:3000/ventas');
        $response2 = Http::get('http://localhost:3000/lista_productos');

        $response=Http::get('http://localhost:3000/detalle_venta/'.$cod_detalle_venta);
        $detalleventa=json_decode($response->getbody()->getcontents())[0];

        $data=[];
        $data['detalleventa']=$detalleventa;

        return view ('solicitudpedidos.detallesolicitud.edit',['detalleventa'=>$detalleventa])
        ->with('ventas', json_decode($response3,true))
        ->with('producto', json_decode($response2,true));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_detalle_venta)
    {
        $request->validate([
            'codv'=>'required',
            'codigop'=>'required',
            'cantidad'=>'required',
            'precio'=>'required',
            'Impuesto'=>'required',
            'total'=>'required',
            'pago'=>'required',
        ]);

        $detalleventa = Http::put('http://localhost:3000/detalle_venta/actualizar/' . $cod_detalle_venta, [
            'cod_venta' => $request->codv,
            'cod_producto' => $request->codigop,
            'cantidad' => $request->cantidad,
            'precio_venta' => $request->precio,
            'descuento' => $request->descuento,
            'impuesto_sobre_venta' => $request->Impuesto,
            'subtotal' => $request->total,
            'forma_pago' =>$request->pago,
            'usr_registro' =>  auth()->user()->name
        ]);

        return redirect()->route('detallesolicitud.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_detalle_venta)
    {
        $eliminar = Http::delete('http://localhost:3000/detalle_venta/eliminar/'.$cod_detalle_venta);
        return redirect()->route('detallesolicitud.index')->with('eliminar', 'Ok');
    }
}
