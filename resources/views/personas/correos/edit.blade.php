@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Correos')

@section('content_header')
    <h1 class="text-center">Correos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
<form action="{{route('correos.update', $actualizarcorreo->cod_correo)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Persona</label>
                <select class="form-control selectpicker col-sm-7 border" id="persona" name="persona" 
                data-live-search="true">
                    @foreach($personas as $persona)
                        {
                            @if ($persona->cod_persona == $actualizarcorreo->cod_persona)
                            <option value="{{$persona->cod_persona}}" selected>{{ $persona->primer_nom}} {{ $persona->segund_nom}} {{ $persona->primer_apellido}} {{ $persona->segund_apellido}}</option>
                            @else
                            <option value="{{$persona->cod_persona}}">{{ $persona->primer_nom}} {{ $persona->segund_nom}} {{ $persona->primer_apellido}} {{ $persona->segund_apellido}}</option>
                            @endif
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Correo</label>
                 <div class="col-sm-7">
                    <input type="email" id="Correo" name="Correo" class="form-control" placeholder="Ingrese el correo" value="{{$actualizarcorreo->correo}}">
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

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('correos.index')}}"
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@stop

@section('js')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script> 

<script>
    window.onload = function() {
        var myInput = document.getElementById('Correo');

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