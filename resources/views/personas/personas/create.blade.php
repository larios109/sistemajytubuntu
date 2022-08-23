@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Registrar Persona')

@section('content_header')
    <h1 class="text-center">Persona</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('personas.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">
            
            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Primer Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="Nombre" name="Nombre" class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)"  onkeyup="capitalizarPrimeraLetranombre()" 
                    placeholder="Ingrese el primer nombre" value="{{old('Nombre')}}">
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
                    placeholder="Ingrese el Segundo nombre" value="{{old('Nombre2')}}">
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
                    placeholder="Ingrese el Primer apellido" value="{{old('Apellido')}}">
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
                    placeholder="Ingrese el Segundo apellido" value="{{old('Apellido2')}}">
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
                    placeholder="Ingrese el dni" value="{{old('DNI')}}">
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
                    <option disabled selected>Escoja un genero</option>
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

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Telefono</label>
                 <div class="col-sm-7">
                    <input type="number" id="Telefono" name="Telefono" class="form-control" min="1" max="99999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   
                    placeholder="Ingrese el telefono" value="{{old('Telefono')}}">
                </div>
                @if ($errors->has('Telefono'))
                    <div
                        id="Telefono-error"                                              
                        class="error text-danger pl-3"
                        for="Telefono"
                        style="display: block;">
                        <strong>{{$errors->first('Telefono')}}</strong>
                     </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo Telefono</label>
                <select class="col-sm-7" class="form-control" id="tipotelefono" name="tipotelefono">
                    <option disabled selected>Escoja un tipo de telefono</option>
                    <option>Casa</option>
                    <option>Personal</option>
                    <option>Trabajo</option>
                </select>
                @if ($errors->has('tipotelefono'))
                    <div     
                        id="tipotelefono-error"                                          
                        class="error text-danger pl-3"
                        for="tipotelefono"
                        style="display: block;">
                        <strong>{{$errors->first('tipotelefono')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Correo</label>
                 <div class="col-sm-7">
                    <input type="email" id="Correo" name="Correo" class="form-control" placeholder="Ingrese el correo" value="{{old('Correo')}}">
                </div>
                @if ($errors->has('Correo'))
                    <div               
                        id="Correo-error"                               
                        class="error text-danger pl-3"
                        for="Correo"
                        style="display: block;">
                        <strong>{{$errors->first('Correo')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha Nacimiento</label>
                 <div class="col-sm-7">
                    <input type="date" id="Nacimiento" name="Nacimiento" class="form-control">
                </div>
                @if ($errors->has('Nacimiento'))
                    <div     
                        id="Nacimiento-error"                                          
                        class="Nacimiento text-danger pl-3"
                        for="Nacimiento"
                        style="display: block;">
                        <strong>{{$errors->first('Nacimiento')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Referencia Direccion</label>
                 <div class="col-sm-7">
                    <input type="text" id="direccion" name="direccion" class="form-control" maxlength="30" 
                    onkeyup="capitalizarPrimeraLetradireccion()" placeholder="Ingrese la direccion" value="{{old('direccion')}}">
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
                <select class="col-sm-7" class="form-control" id="Municipio" name="Municipio">
                    <option disabled selected>Escoja un codigo de un Municipio</option>
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

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('personas.index')}}"
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
        var myInput5 = document.getElementById('Correo');
        var myInput6 = document.getElementById('direccion');

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

        myInput5.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput6.onpaste = function(e) {
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

        myInput5.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput6.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }
    }
</script> 
@stop