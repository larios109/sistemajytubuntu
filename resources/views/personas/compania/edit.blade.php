@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualilazar compañia')

@section('content_header')
    <h1 class="text-center">Compañia</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('compania.update', $comapniaactu->cod_compania)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">RTN</label>
                 <div class="col-sm-7">
                    <input type="number" id="RTN" name="RTN" class="form-control" min="1" max="99999999999999" maxlength="14" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Ingrese el rtn" value="{{$comapniaactu->compania_rtn}}">
                </div>
                @if ($errors->has('RTN'))
                    <div               
                        id="RTN-error"                               
                        class="error text-danger pl-3"
                        for="RTN"
                        style="display: block;">
                        <strong>{{$errors->first('RTN')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Compañia CAI</label>
                 <div class="col-sm-7">
                    <input type="text" id="CAI" name="CAI" class="form-control" maxlength="40"  placeholder="Ingrese el cai" value="{{$comapniaactu->compañia_cai}}">
                </div>
                @if ($errors->has('CAI'))
                    <div                 
                        id="CAI-error"                             
                        class="error text-danger pl-3"
                        for="CAI"
                        style="display: block;">
                        <strong>{{$errors->first('CAI')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre legal</label>
                 <div class="col-sm-7">
                    <input type="text" id="Nombre" name="Nombre" class="form-control" maxlength="20" onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetralegal()" placeholder="Ingrese el Nombre" value="{{$comapniaactu->compañia_legal_nom}}">
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Comercial</label>
                 <div class="col-sm-7">
                    <input type="text" id="Comercial" name="Comercial"  class="form-control" maxlength="20" onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetracomercial()" placeholder="Ingrese el nombe comercial" value="{{$comapniaactu->compañia_comercial_nom}}">
                </div>
                @if ($errors->has('Comercial'))
                    <div
                        id="Comercial-error"                                                
                        class="error text-danger pl-3"
                        for="Comercial"
                        style="display: block;">
                        <strong>{{$errors->first('Comercial')}}</strong>
                    </div>
                 @endif
            </div>

            
            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Facebook</label>
                 <div class="col-sm-7">
                    <input type="text" id="Facebook" name="Facebook" class="form-control" maxlength="20" placeholder="Ingrese el feacebook" value="{{$comapniaactu->compañia_facebook}}">
                </div>
                @if ($errors->has('Facebook'))
                    <div
                        id="Facebook-error"                                              
                        class="error text-danger pl-3"
                        for="Facebook"
                        style="display: block;">
                        <strong>{{$errors->first('Facebook')}}</strong>
                     </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Instagram</label>
                 <div class="col-sm-7">
                    <input type="text" id="Instagram" name="Instagram" class="form-control" maxlength="20" placeholder="Ingrese el instagram" value="{{$comapniaactu->compañia_instagram}}">
                </div>
                @if ($errors->has('Instagram'))
                    <div
                        id="Instagram-error"                                              
                        class="error text-danger pl-3"
                        for="Instagram"
                        style="display: block;">
                        <strong>{{$errors->first('Instagram')}}</strong>
                     </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('compania.index')}}"
                    class="btn btn-danger w-100"
                    >Cancelar <i class="fa fa-times-circle ml-2"></i></a>
                </div>
                <div class="col-sm-6 col-xs-12 mb-2">
                    <button 
                        type="submit"
                        class="btn btn-success w-100">
                        Actualilazar <i class="fa fa-check-circle ml-2"></i>
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
    function capitalizarPrimeraLetralegal() {
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

    var input2 = document.getElementById('Comercial');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetracomercial() {
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
@stop