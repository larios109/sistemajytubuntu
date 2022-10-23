@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Direccion')

@section('content_header')
    <h1 class="text-center">Direccion</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('direccion.update',$direccionactu->cod_direccion)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Persona</label>
                <select class="col-sm-7" class="form-control" id="persona" name="persona" >
                    @foreach($personas as $persona)
                        {
                            <option id=".$personas['persona']">{{$persona["cod_persona"]}}.{{$persona["primer_nom"]}} {{$persona["segund_nom"]}} {{$persona["primer_apellido"]}} {{$persona["segund_apellido"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('persona'))
                    <div     
                        id="persona-error"                                          
                        class="error text-danger pl-3"
                        for="persona"
                        style="display: block;">
                        <strong>{{$errors->first('persona')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Referencia Direccion</label>
                 <div class="col-sm-7">
                    <input type="text" id="direccion" name="direccion" class="form-control" maxlength="25" 
                    onkeydown="return /[a-z, ]/i.test(event.key)"  onkeyup="capitalizarPrimeraLetradireccion()" 
                    placeholder="Ingrese la direccion" value="{{$direccionactu->ref_direccion}}">
                </div>
                @if ($errors->has('direccion'))
                    <div               
                        id="direccion-error"                               
                        class="error text-danger pl-3"
                        for="direccion"
                        style="display: block;">
                        <strong>{{$errors->first('direccion')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Departamento ID</label>
                <select class="col-sm-7" class="form-control" id="Departamento" name="Departamento">
                    <option disabled selected>Escoja un codigo de un Departamento</option>
                    @foreach($departamento as $depa)
                        {
                            <option id=".$depa['Departamento']">{{$depa["departamento_id"]}}/{{$depa["departamento_nom"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('Departamento'))
                    <div     
                        id="Departamento-error"                                          
                        class="error text-danger pl-3"
                        for="Departamento"
                        style="display: block;">
                        <strong>{{$errors->first('Departamento')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Municipio ID</label>
                <select class="col-sm-7" class="form-control" id="Municipio" name="Municipio" value="{{$direccionactu->municipio_id}}">
                    @foreach($municipio as $muni)
                        {
                            <option id=".$muni['Municipio']">{{$muni["municipio_id"]}}/{{$muni["departamento_id"]}}/{{$muni["municipio_nombre"]}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('Municipio'))
                    <div     
                        id="Municipio-error"                                          
                        class="error text-danger pl-3"
                        for="Municipio"
                        style="display: block;">
                        <strong>{{$errors->first('Municipio')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Referencia Direccion</label>
                 <div class="col-sm-7">
                    <input type="text" id="direccion" name="direccion" class="form-control" maxlength="25" 
                    onkeydown="return /[a-z, ]/i.test(event.key)"  onkeyup="capitalizarPrimeraLetradireccion()" 
                    placeholder="Ingrese la direccion" value="{{$direccionactu->ref_direccion}}">
                </div>
                @if ($errors->has('direccion'))
                    <div               
                        id="direccion-error"                               
                        class="error text-danger pl-3"
                        for="direccion"
                        style="display: block;">
                        <strong>{{$errors->first('direccion')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('direccion.index')}}"
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
<script>
    var input = document.getElementById('direccion');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetradireccion() {
    //almacenamos el valor del input
    var palabra = input.value;
    //Si el valor es nulo o undefined salimos
    if(!input.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input.value = mayuscula.concat(minuscula);
    }

    var input2 = document.getElementById('Ciudad');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetraciudad() {
    //almacenamos el valor del input
    var palabra = input2.value;
    //Si el valor es nulo o undefined salimos
    if(!input2.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input2.value = mayuscula.concat(minuscula);
    }
</script>

<script>
    window.onload = function() {
        var myInput = document.getElementById('direccion');

        //ONPASTE
        myInput.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }
        
        //ONCOPY
        myInput.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }
    }
</script> 
@stop