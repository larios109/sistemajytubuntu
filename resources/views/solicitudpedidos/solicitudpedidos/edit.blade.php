@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Editar Solicitud Pedidos')

@section('content_header')
    <h1 class="text-center">Solicitud Pedidos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('solicitudpedidos.update', $actualizarventas->cod_venta)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cliente</label>
                <select class="col-sm-7" class="form-control" id="cliente" name="cliente" >
                    @foreach($clientes as $client)
                        {
                            <option id=".$client['cliente']">{{$client["cod_cliente"]}}.{{$client["primer_nom"]}} {{$client["segund_nom"]}} {{$client["primer_apellido"]}} {{$client["segund_apellido"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('cliente'))
                    <div     
                        id="cliente-error"                                          
                        class="error text-danger pl-3"
                        for="cliente"
                        style="display: block;">
                        <strong>{{$errors->first('cliente')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Producto</label>
                <select class="col-sm-7" class="form-control" id="producto" name="producto" >
                    @foreach($productos as $product)
                        {
                            <option id=".$producto['product']">{{$product["cod_producto"]}}.{{$product["nombre_producto"]}}, Precio: {{$product["precio_producto"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('producto'))
                    <div     
                        id="producto-error"                                          
                        class="error text-danger pl-3"
                        for="producto"
                        style="display: block;">
                        <strong>{{$errors->first('producto')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad" min="1" max="99999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  
                    onchange="res(this.value);" class="form-control" placeholder="Ingrese la Cantidad" 
                    value="{{$actualizarventas->cant}}">
                </div>
                @if ($errors->has('cantidad'))
                    <div               
                        id="cantidad-error"                               
                        class="error text-danger pl-3"
                        for="cantidad"
                        style="display: block;">
                        <strong>{{$errors->first('cantidad')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Precio de Venta</label>
                 <div class="col-sm-7">
                    <input type="number" id="precio" name="precio"  min="1" max="99999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  
                    onchange="res(this.value);" 
                    class="form-control" placeholder="Ingrese el precio de venta" 
                    value="{{$actualizarventas->prec_vent_lote}}">
                </div>
                @if ($errors->has('precio'))
                    <div                 
                        id="precio-error"                             
                        class="error text-danger pl-3"
                        for="precio"
                        style="display: block;">
                        <strong>{{$errors->first('precio')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('solicitudpedidos.index')}}"
                    class="btn btn-danger w-100"
                    >Cancelar <i class="fa fa-times-circle ml-2"></i></a>
                </div>
                <div class="col-sm-6 col-xs-12 mb-2">
                    <button 
                        type="submit"
                        class="btn btn-success w-100">
                        Actualizar <i class="fa fa-check-circle ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
     </form>
@stop

@section('css')
@stop