@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Registrar Pregunta')

@section('content_header')
    <h1 class="text-center">Pregunta</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('preguntas.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Pregunta</label>
                 <div class="col-sm-7">
                    <input type="text" id="pregunta" name="pregunta" class="form-control" maxlength="30"
                    placeholder="Ingrese la pregunta" value="{{old('pregunta')}}">
                </div>
                @if ($errors->has('pregunta'))
                    <div               
                        id="pregunta-error"                               
                        class="error text-danger pl-3"
                        for="pregunta"
                        style="display: block;">
                        <strong>{{$errors->first('pregunta')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Respuesta</label>
                 <div class="col-sm-7">
                    <input type="text" id="respuesta" name="respuesta" class="form-control" maxlength="20" 
                    placeholder="Ingrese la respuesta" value="{{old('respuesta')}}">
                </div>
                @if ($errors->has('respuesta'))
                    <div               
                        id="respuesta-error"                               
                        class="error text-danger pl-3"
                        for="respuesta"
                        style="display: block;">
                        <strong>{{$errors->first('respuesta')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('preguntas.index')}}"
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
    window.onload = function() {
        var myInput = document.getElementById('pregunta');
        var myInput2 = document.getElementById('respuesta');

        //ONPASTE
        myInput.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput2.onpaste = function(e) {
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
    }
</script> 
@stop