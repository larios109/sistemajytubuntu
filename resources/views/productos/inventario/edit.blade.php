@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Producto en Inventario')

@section('content_header')
    <h1 class="text-center">Productos en Inventario</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('inventario.update',$productoinvent->cod_invent)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Producto</label>
                <select class="col-sm-7" class="form-control" id="Producto" name="Producto">
                    @foreach($productos as $producto)
                        {
                            <option  id=".$depa['Producto']">{{$producto["cod_producto"]}}.{{$producto["nombre_producto"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('Producto'))
                    <div     
                        id="Producto-error"                                          
                        class="error text-danger pl-3"
                        for="Producto"
                        style="display: block;">
                        <strong>{{$errors->first('Producto')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad" min="1" max="9999999999" maxlength="10" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    class="form-control" placeholder="Ingrese la Cantidad" value="{{$productoinvent->cant_invent}}">
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
                <label for="calendar" class="col-sm-2 col-form-label">Fecha de Caducidad</label>
                 <div class="col-sm-7">
                    <input type="date" id="caducidad" name="caducidad" class="form-control">
                </div>
                @if ($errors->has('caducidad'))
                    <div     
                        id="caducidad-error"                                          
                        class="caducidad text-danger pl-3"
                        for="caducidad"
                        style="display: block;">
                        <strong>{{$errors->first('caducidad')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('inventario.index')}}"
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

@section('js')
@stop