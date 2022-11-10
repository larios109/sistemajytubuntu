@extends('adminlte::page')
<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Detalle solicitud pedido')

@section('content_header')
    <h1 class="text-center">Detalle Solicitud Pedidos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
<div class="row mb-3">
    <label for="nombre" class="col-sm-2 col-form-label">Cliente</label>
    <p>{{$venta->primer_nom}} {{$venta->primer_apellido}}</p>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
        <thead style="background-color: #A9D0F5">
            <th>Articulo</th>
            <th>Cantidad</th>
            <th>Precio Venta</th>
            <th>Subtotal</th>
        </thead>
        <tfoot>
        <th><h4>ISV</h4> <h4>Total</h4></th>
        <th></th>
        <th></th>
        <th><h4 id="isv">{{$venta->impuesto}}</h4><h4 id="total">{{$venta->total_venta}}</h4></th>
        </tfoot>
        <tbody>
            @foreach($detalles as $det)
              <tr>
                <td>{{$det->articulo}}</td>
                <td>{{$det->cantidad}}</td>
                <td>{{$det->precio_venta}}</td>
                <td>{{$det->cantidad*$det->precio_venta}}</td>
              </tr>
            @endforeach              
        </tbody>
    </table>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">         
      <div class="form-group">
          <a href="{{route('solicitudpedidos.index')}}" class="btn btn-danger"
          >Regresar</a>
      </div>
    </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop