@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Colaborador')

@section('content_header')
    <h1 class="text-center">Colaborador</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('usuarios.update',$user->id)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="name" name="name" class="form-control" maxlength="30" 
                    onkeydown="return /[a-z]/i.test(event.key)" onkeyup="this.value=this.value.toUpperCase();" 
                    placeholder="Ingrese el Nombre" value="{{$user->name}}">
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Correo</label>
                 <div class="col-sm-7">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese el correo" value="{{$user->email}}">
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

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Contraseña</label>
                <div class="col-sm-7">
                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Confirmar Contraseña</label>
                 <div class="col-sm-7">
                    {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                </div>
            </div>

            <div  class="row mb-3">
                    <label for="Rol" class="col-sm-2 col-form-label">Rol</label>
                    <div class="col-sm-7">
                        {!! Form::select('roles[]',$roles,[],array('class'=>'form-control'))!!}
                    </div>
                @if ($errors->has('Rol'))
                    <div     
                        id="Rol-error"                                          
                        class="error text-danger pl-3"
                        for="Rol"
                        style="display: block;">
                        <strong>{{$errors->first('Rol')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('usuarios.index')}}"
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