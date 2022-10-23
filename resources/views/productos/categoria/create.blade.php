@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Registrar Categoria')

@section('content_header')
    <h1 class="text-center">Categoria</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('categoria.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Categoria</label>
                 <div class="col-sm-7">
                    <input type="text" id="categoria" name="categoria" class="form-control" maxlength="20" 
                    onkeydown="return /[a-z ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetracategoria()"
                     placeholder="Ingrese el Nombre del Producto" value="{{old('categoria')}}">
                </div>
                @if ($errors->has('categoria'))
                    <div               
                        id="categoria-error"                               
                        class="error text-danger pl-3"
                        for="categoria"
                        style="display: block;">
                        <strong>{{$errors->first('categoria')}}</strong>
                    </div>
                @endif
            </div>
            <div id="respuesta"> </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('categoria.index')}}"
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
    var input = document.getElementById('categoria');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetracategoria() {
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
</script>

<script>
    window.onload = function() {
        var myInput = document.getElementById('categoria');

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