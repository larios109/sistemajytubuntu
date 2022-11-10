@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Registrar Materia Saliente')

@section('content_header')
    <h1 class="text-center">Materia Saliente</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('materiasaliente.store')}}" method='POST' id="formstore">
        @csrf
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre Materia</label>
                <select  class="form-control selectpicker col-sm-7 border" id="Materia" name="Materia"  data-live-search="true">
                    <option disabled selected>Escoja un codigo Materia Entrante</option>
                    @foreach($materiaentrante as $materiae)
                        <option value="{{$materiae->cod_materia_e}}_{{$materiae->cant}}">{{$materiae->nom_materia}}</option>
                    @endforeach
                </select>
                @if ($errors->has('Materia'))
                    <div     
                        id="Materia-error"                                          
                        class="error text-danger pl-3"
                        for="Materia"
                        style="display: block;">
                        <strong>{{$errors->first('Materia')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Materia Disponible</label>
                <div class="col-sm-7">
                    <input type="text" id="cant" name="Descripcion" class="form-control" readonly="">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Descripcion</label>
                 <div class="col-sm-7">
                    <input type="text" id="Descripcion" name="Descripcion" class="form-control" maxlength="40" 
                    onkeyup="capitalizarPrimeraLetradescripcion()" 
                    placeholder="Ingrese una descripcion" value="{{old('Descripcion')}}">
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad Saliente</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad" min="1" max="99999" maxlength="5" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    class="form-control" placeholder="Ingrese la Cantidad" value="{{old('cantidad')}}">
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

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('materiasaliente.index')}}"
                    class="btn btn-danger w-100"
                    >Cancelar <i class="fa fa-times-circle ml-2"></i></a>
                </div>
                <div class="col-sm-6 col-xs-12 mb-2">
                    <button 
                        type="submit"
                        class="btn btn-success w-100" id="bt_add">
                        Guardar <i class="fa fa-check-circle ml-2"></i>
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
        var myInput = document.getElementById('Descripcion');

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

<script>

    $("#Materia").change(mostrarValores);//trae los valores del articulo cada vez que se seleccione

    function mostrarValores()
    {
    datosMateria=document.getElementById('Materia').value.split('_');
    $("#cant").val(datosMateria[1]);
    }
</script>

<script>
    const form = document.getElementById('formstore');

    form.addEventListener("submit", function(event){
            cantidad=$("#cantidad").val();
            cant=$("#cant").val(); 
            if (cantidad>cant) {
                event.preventDefault();
                alert("La cantidad a usar supera la cantidad actual");
            }else{

            }
        }
    )
</script>
@stop