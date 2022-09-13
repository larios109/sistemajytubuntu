@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Crear Detalle Solicitud Pedidos')

@section('content_header')
    <h1 class="text-center">Detalle Solicitud Pedidos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('detallesolicitud.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Codigo Solicitud</label>
                <select class="col-sm-7" class="form-control" id="codv" name="codv">
                    <option disabled selected>Escoja un codigo de solicitud</option>
                    @foreach($ventas as $codvent)
                        {
                            <option id=".$codvent['codv']">{{$codvent["cod_venta"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('codv'))
                    <div     
                        id="codv-error"                                          
                        class="error text-danger pl-3"
                        for="codv"
                        style="display: block;">
                        <strong>{{$errors->first('codv')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Producto</label>
                <select class="col-sm-7" class="form-control"  id="codigop" name="codigop">
                    <option disabled selected>Escoja un codigo de producto</option>
                    @foreach($producto as $product)
                        {
                            <option id=".$product['codigop']">{{$product["cod_producto"]}}.{{$product["nombre_producto"]}}, , Precio: {{$product["precio_producto"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('codigop'))
                    <div     
                        id="codigop-error"                                          
                        class="error text-danger pl-3"
                        for="codigop"
                        style="display: block;">
                        <strong>{{$errors->first('codigop')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad"  min="1" max="99999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  
                    onchange="res(this.value);" class="form-control" placeholder="Ingrese la Cantidad" 
                    value="{{old('cantidad')}}">
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
                    <input type="number" id="precio" name="precio" min="1" max="99999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="res(this.value);" 
                    class="form-control" placeholder="Ingrese el precio de venta" value="{{old('precio')}}">
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

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">ISV</label>
                 <div class="col-sm-7">
                    <input type="number" id="Impuesto" name="Impuesto"  class="form-control" readonly="" 
                    placeholder="Impuesto">
                </div>
                @if ($errors->has('Impuesto'))
                    <div
                        id="Impuesto-error"                                                
                        class="error text-danger pl-3"
                        for="Impuesto"
                        style="display: block;">
                        <strong>{{$errors->first('Impuesto')}}</strong>
                    </div>
                 @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Forma Pago</label>
                <select class="col-sm-7" class="form-control" id="pago" name="pago">
                    <option disabled selected>Escoja una forma de pago</option>
                    <option>Cheque</option>
                    <option>Efectivo</option>
                    <option>Tarjeta</option>
                    <option>Transferencia</option>
                </select>
                @if ($errors->has('pago'))
                    <div     
                        id="pago-error"                                          
                        class="error text-danger pl-3"
                        for="pago"
                        style="display: block;">
                        <strong>{{$errors->first('pago')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Total</label>
                 <div class="col-sm-7">
                    <input type="number" id="total" name="total" min="1" max="99999999"  class="form-control" 
                    step="0.00001" readonly="" placeholder="Total" value="{{old('total')}}">
                </div>
                @if ($errors->has('total'))
                    <div
                        id="total-error"                                              
                        class="error text-danger pl-3"
                        for="total"
                        style="display: block;">
                        <strong>{{$errors->first('total')}}</strong>
                     </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('detallesolicitud.index')}}"
                    class="btn btn-danger w-100"
                    >Cancelar <i class="fa fa-times-circle ml-2"></i></a>
                </div>
                <div class="col-sm-6 col-xs-12 mb-2">
                    <button 
                        type="submit"
                        class="btn btn-success w-100">
                        Guardar <i class="fa fa-check-circle ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
     </form>
@stop

@section('css')
@stop

@section('js')
<script>

    var m1 = document.getElementById("cantidad");
    var m2 = document.getElementById("precio");

    function res() {
        var isv = ((m1.value * m2.value) * 0.15);
        document.getElementById("Impuesto").value=isv;
        var multi = ((m1.value * m2.value)+isv);
        document.getElementById("total").value=multi;
    };

</script>
@stop