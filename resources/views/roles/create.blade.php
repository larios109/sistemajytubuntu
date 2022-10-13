@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Crear rol')

@section('content_header')
    <h1 class="text-center">Roles</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('roles.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre del rol</label>
                 <div class="col-sm-7">
                    <input type="text" id="name" name="name" class="form-control" minlength = "10" maxlength="20" 
                    onkeydown="return /[a-z ]/i.test(event.key)" onkeyup="this.value=this.value.toUpperCase();" placeholder="Ingrese el Nombre" 
                    value="{{old('name')}}">
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Permisos para el rol: </label>
                 <div class="col-sm-7">
                    <br/>
                        @foreach($permission as $value)
                        <label>{{Form::checkbox('permission[]',$value->id,false,array('class'=>'name'))}}
                            {{$value->name}}
                        </label>
                    <br/>
                    @endforeach
                </div>
                @if ($errors->has('cantidad'))
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
                    <a href="{{route('roles.index')}}"
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
                {!!Form::close()!!}
            </div>
        </div>
     </form>
@stop

@section('css')
@stop

@section('js')
<script>
    window.onload = function() {
        var myInput = document.getElementById('name');

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