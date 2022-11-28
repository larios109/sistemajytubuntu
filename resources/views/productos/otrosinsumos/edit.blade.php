@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Insumo')

@section('content_header')
    <h1 class="text-center">Otros Insumos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('otrosinsumos.update', $otrosinsumos->cod_insumos)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Insumo</label>
                 <div class="col-sm-7">
                    <input type="text" id="insumo" name="insumo" class="form-control" maxlength="50" 
                    onkeydown="return /[a-z, 1-9]/i.test(event.key)" onkeyup="capitalizarPrimeraLetrainsumo()"
                     placeholder="Ingrese el Nombre del Producto" value="{{$otrosinsumos->insumo}}">
                </div>
                @if ($errors->has('insumo'))
                    <div               
                        id="insumo-error"                               
                        class="error text-danger pl-3"
                        for="insumo"
                        style="display: block;">
                        <strong>{{$errors->first('insumo')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Descripcion</label>
                 <div class="col-sm-7">
                    <textarea type="text" id="Descripcion" name="Descripcion" class="form-control" maxlength="100" 
                    onkeyup="capitalizarPrimeraLetradescripcion()" 
                    placeholder="Ingrese una descripcion" value="{{$otrosinsumos->descripcion}}">{{$otrosinsumos->descripcion}}</textarea>
                </div>
                @if ($errors->has('Descripcion'))
                    <div               
                        id="Descripcion-error"                               
                        class="error text-danger pl-3"
                        for="Descripcion"
                        style="display: block;">
                        <strong>{{$errors->first('Descripcion')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Precio Insumo</label>
                 <div class="col-sm-7">
                    <input type="number" id="Precio" name="Precio"  class="form-control" min="1" max="99999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    placeholder="Ingrese el Precio de la materia" step="0.00001" value="{{$otrosinsumos->precio}}">
                </div>
                @if ($errors->has('Precio'))
                    <div          
                        id="Precio-error"                                     
                        class="error text-danger pl-3"
                        for="Precio"
                        style="display: block;">
                        <strong>{{$errors->first('Precio')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad comprada</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad"  class="form-control" min="1" max="99999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    placeholder="Ingrese la cantidad" value="{{$otrosinsumos->cant}}">
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

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo de medida</label>
                <select class="col-sm-7" class="form-control" id="Medida" name="Medida">
                    <option selected value="{{$otrosinsumos->tip_medida}}">{{$otrosinsumos->tip_medida}}</option>
                    <option>Kilogramos</option>
                    <option>Libras</option>
                    <option>Unidad</option>
                    <option>Quintales</option>
                    <option>Onzas</option>
                    <option>Litros</option>
                    <option>Mililitros</option>
                </select>
                @if ($errors->has('Medida'))
                    <div     
                        id="Medida-error"                                          
                        class="error text-danger pl-3"
                        for="Medida"
                        style="display: block;">
                        <strong>{{$errors->first('Medida')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('otrosinsumos.index')}}"
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
    var input = document.getElementById('insumo');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetrainsumo() {
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

    var input2 = document.getElementById('Descripcion');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetradescripcion() {
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
        var myInput = document.getElementById('insumo');
        var myInput2 = document.getElementById('Descripcion');

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