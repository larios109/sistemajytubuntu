@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Editar Cliente')

@section('content_header')
    <h1 class="text-center">Cliente</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('cliente.update', $cliente->cod_cliente)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">
            
            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Primer Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="Nombre" name="Nombre" class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)"  onkeyup="capitalizarPrimeraLetranombre()" 
                    placeholder="Ingrese el primer nombre" value="{{$cliente->primer_nom}}">
                </div>
                @if ($errors->has('Nombre'))
                    <div          
                        id="Nombre-error"                                     
                        class="error text-danger pl-3"
                        for="Nombre"
                        style="display: block;">
                        <strong>{{$errors->first('Nombre')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Segundo Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="Nombre2" name="Nombre2" class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)"  onkeyup="capitalizarPrimeraLetranombre2()" 
                    placeholder="Ingrese el Segundo nombre" value="{{$cliente->segund_nom}}">
                </div>
                @if ($errors->has('Nombre2'))
                    <div          
                        id="Nombre2-error"                                     
                        class="error text-danger pl-3"
                        for="Nombre2"
                        style="display: block;">
                        <strong>{{$errors->first('Nombre2')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Primer Apellido</label>
                 <div class="col-sm-7">
                    <input type="text" id="Apellido" name="Apellido"  class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetraapellido()" 
                    placeholder="Ingrese el Primer apellido" value="{{$cliente->primer_apellido}}">
                </div>
                @if ($errors->has('Apellido'))
                    <div
                        id="Apellido-error"                                                
                        class="error text-danger pl-3"
                        for="Apellido"
                        style="display: block;">
                        <strong>{{$errors->first('Apellido')}}</strong>
                    </div>
                 @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Segundo Apellido</label>
                 <div class="col-sm-7">
                    <input type="text" id="Apellido2" name="Apellido2"  class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetraapellido2()" 
                    placeholder="Ingrese el Segundo apellido" value="{{$cliente->segund_apellido}}">
                </div>
                @if ($errors->has('Apellido2'))
                    <div
                        id="Apellido2-error"                                                
                        class="error text-danger pl-3"
                        for="Apellido2"
                        style="display: block;">
                        <strong>{{$errors->first('Apellido2')}}</strong>
                    </div>
                 @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">DNI</label>
                 <div class="col-sm-7">
                    <input type="number" id="DNI" name="DNI"  class="form-control" min="1" max="9999999999999" maxlength="13" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   
                    placeholder="Ingrese el dni" value="{{$cliente->dni}}">
                </div>
                @if ($errors->has('DNI'))
                    <div                 
                        id="DNI-error"                             
                        class="error text-danger pl-3"
                        for="DNI"
                        style="display: block;">
                        <strong>{{$errors->first('DNI')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Genero</label>
                <select class="col-sm-7" class="form-control" id="Genero" name="Genero">
                    <option  selected value="{{$cliente->genero}}">{{$cliente->genero}}</option>
                    <option>Femenino</option>
                    <option>Masculino</option>
                </select>
                @if ($errors->has('Genero'))
                    <div     
                        id="Cliente-error"                                          
                        class="error text-danger pl-3"
                        for="Genero"
                        style="display: block;">
                        <strong>{{$errors->first('Genero')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('cliente.index')}}"
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
    var input = document.getElementById('Nombre');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetranombre() {
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

    var input2 = document.getElementById('Nombre2');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetranombre2() {
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

    var input3 = document.getElementById('Apellido');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetraapellido() {
    //almacenamos el valor del input
    var palabra = input3.value;
    //Si el valor es nulo o undefined salimos
    if(!input3.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input3.value = mayuscula.concat(minuscula);
    }

    var input4 = document.getElementById('Apellido2');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetraapellido2() {
    //almacenamos el valor del input
    var palabra = input4.value;
    //Si el valor es nulo o undefined salimos
    if(!input4.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input4.value = mayuscula.concat(minuscula);
    }

    var input5 = document.getElementById('direccion');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetradireccion() {
    //almacenamos el valor del input
    var palabra = input5.value;
    //Si el valor es nulo o undefined salimos
    if(!input5.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input5.value = mayuscula.concat(minuscula);
    }
</script>

<script>
    window.onload = function() {
        var myInput = document.getElementById('Nombre');
        var myInput2 = document.getElementById('Nombre2');
        var myInput3 = document.getElementById('Apellido');
        var myInput4 = document.getElementById('Apellido2');

        //ONPASTE
        myInput.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput2.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput3.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput4.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }
        
        //ONCOPY
        myInput.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput2.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput3.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput4.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }
    }
</script> 
@stop