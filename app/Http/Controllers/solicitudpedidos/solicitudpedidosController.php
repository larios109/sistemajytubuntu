<?php

namespace App\Http\Controllers\solicitudpedidos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Http\Requests\solicitudrequest;
use Illuminate\Support\Facades\DB;
use App\Models\detallesolicitudpedido;
use App\Models\solicitudpedido;
use App\Models\kardex;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use PDF;

class solicitudpedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:visualizar solicitud pedidos|Registrar solicitud|borrar solicitud|visualizar detalle solicitud pedidos',['only'=>['index']]);
        $this->middleware('permission:Registrar solicitud',['only'=>['create','store']]);
        $this->middleware('permission:visualizar detalle solicitud pedidos',['only'=>['show']]);
        $this->middleware('permission:borrar solicitud',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request)
        {
           $ventas=DB::table('venta as v')
            ->join('persona as p','v.cod_persona','=','p.cod_persona')
            ->select('v.idventa','v.cod_persona','p.primer_nom','p.primer_apellido', 'v.fecha_hora','v.impuesto', 'v.total_venta')
            ->orderBy('v.idventa')->get();
            $user = Auth::user();
            $fecha = now();
            return view('solicitudpedidos.solicitudpedidos.index',["ventas"=>$ventas, "user"=>$user, "fecha"=>$fecha]);

        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes=DB::table('persona')->where('estado','=','1')->get();

        $articulos=DB::table('articulo as art')
            ->join('categoria as c', 'art.idcategoria', '=', 'c.idcategoria')
            ->select('art.nombre AS articulo', 'c.nombre as categoria','art.idarticulo','art.stock','art.precio_producto')
            ->where([['art.stock', '>', '0'], ['art.estado', '=', '1'],])
            ->get();

        return view("solicitudpedidos.solicitudpedidos.create",["clientes"=>$clientes,"articulos"=>$articulos]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(solicitudrequest $request)
    {        
        try {
            DB::beginTransaction();
            $solicitudpedido = new solicitudpedido;
            $solicitudpedido->cod_persona=$request->get('codc');
            $solicitudpedido->fecha_hora=now();
            $solicitudpedido->impuesto = $request->get('isv_total');
            $solicitudpedido->total_venta=$request->get('total_venta');
            $solicitudpedido->usr_registro=auth()->user()->name;
            $solicitudpedido->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_producto');

            $cont = 0;

            while ($cont<count($idarticulo)) {
                $detallesolicitudpedido=new detallesolicitudpedido();
                $detallesolicitudpedido->idventa=$solicitudpedido->idventa;
                $detallesolicitudpedido->idarticulo=$idarticulo[$cont];
                $detallesolicitudpedido->cantidad=$cantidad[$cont];
                $detallesolicitudpedido->precio_venta=$precio_venta[$cont];
                $detallesolicitudpedido->save();

                $kardex = new kardex;
                $kardex -> idarticulo = $idarticulo[$cont];
                $kardex -> movimiento = 'Salida';
                $kardex -> cant = $cantidad[$cont];
                $kardex -> usr_registro = auth()->user()->name;
                $kardex -> fecha_registro = now();
                $kardex -> save();

                $cont=$cont+1;
            }

            DB::commit();
        } catch (Exception $e) 
        {
            DB::rollback();
        }
        
        return redirect()->route('solicitudpedidos.index')->with('store', 'registro');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta=DB::table('venta as v')
        ->join('persona as p','v.cod_persona','=','p.cod_persona')
        ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
        ->select('v.idventa','p.cod_persona','p.primer_nom','p.primer_apellido', 'v.fecha_hora','v.impuesto', 'v.total_venta')
        ->where('v.idventa','=',$id)
        ->first();

        $detalles=DB::table('detalle_venta as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','d.cantidad','d.precio_venta')
        ->where('d.idventa','=',$id)
        ->get();

        return view("solicitudpedidos.solicitudpedidos.show",["venta"=>$venta,"detalles"=>$detalles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idventa)
    {
        $solicitupedido=solicitudpedido::findOrFail($idventa);
        $solicitupedido->delete();
        return redirect()->route('solicitudpedidos.index')->with('eliminar', 'Ok');
    }

    public function downloadPDF($idventa)
    {
        $venta=DB::table('venta as v')
        ->join('persona as p','v.cod_persona','=','p.cod_persona')
        ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
        ->select('v.idventa','p.cod_persona','p.primer_nom','p.primer_apellido', 'v.fecha_hora','v.impuesto', 'v.total_venta')
        ->where('v.idventa','=',$idventa)
        ->first();

        $detalles=DB::table('detalle_venta as d')
        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
        ->select('a.nombre as articulo','d.cantidad','d.precio_venta')
        ->where('d.idventa','=',$idventa)
        ->get();

        view()->share('solicitudpedidos.solicitudpedidos.download', ["venta"=>$venta,"detalles"=>$detalles]); 

        $pdf = PDF::loadView('solicitudpedidos.solicitudpedidos.download',["venta"=>$venta,"detalles"=>$detalles]); 

        return $pdf->download();
    }
}