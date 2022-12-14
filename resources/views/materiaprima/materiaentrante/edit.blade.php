@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Materia')

@section('content_header')
    <h1 class="text-center">Materia Entrante</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('materiaentrante.update', $materiae->cod_materia_e)}}" method='POST' id="formedit">
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div class="col-sm-7" >
                    <input type="number" id="codmateria" name="codmateria"  hidden class="form-control" readonly=""
                    value="{{$materiae->cod_materia_e}}">
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre de la materia</label>
                 <div class="col-sm-7">
                    <input type="text" id="Materia" name="Materia" class="form-control" maxlength="90" 
                    onkeydown="return /[a-z, 1-9]/i.test(event.key)" onkeyup="capitalizarPrimeraLetramateria()" 
                    placeholder="Ingrese el Nombre de la materia" value="{{$materiae->nom_materia}}">
                </div>
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

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Descripcion</label>
                 <div class="col-sm-7">
                    <textarea type="text" id="Descripcion" name="Descripcion" class="form-control" maxlength="100" 
                    onkeyup="capitalizarPrimeraLetradescripcion()" rows="5" cols="20"
                    placeholder="Ingrese una descripcion" value="{{$materiae->descripcion}}">{{$materiae->descripcion}}</textarea>
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

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo de medida</label>
                <select class="col-sm-7" class="form-control" id="Medida" name="Medida">
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

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Precio compra</label>
                 <div class="col-sm-7">
                    <input type="number" id="Precio" name="Precio"  class="form-control" min="1" max="99999999" maxlength="10" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    placeholder="Ingrese el Precio de la materia" step="0.00001" value="{{$materiae->pre_compra}}">
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

            <div class="col-sm-7" >
                    <input type="number" id="stock_antigui" name="stock_antigui" hidden  class="form-control" readonly=""
                    value="{{$materiae->cant}}">
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad comprada</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad"  class="form-control" min="1" max="99999999" maxlength="10" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    placeholder="Ingrese la cantidad" value="{{$materiae->cant}}">
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

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha caducidad</label>
                 <div class="col-sm-7">
                    <input type="date" id="caducidad" name="caducidad" class="form-control" min="2022-01-01"
                    value="{{date('Y-m-d', strtotime($materiae->fec_caducidad))}}">
                </div>
                @if ($errors->has('caducidad'))
                    <div     
                        id="caducidad-error"                                          
                        class="caducidad text-danger pl-3"
                        for="caducidad"
                        style="display: block;">
                        <strong>{{$errors->first('caducidad')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('materiaentrante.index')}}"
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
    var input = document.getElementById('Materia');
    //funci??n que capitaliza la primera letra
    function capitalizarPrimeraLetramateria() {
    //almacenamos el valor del input
    var palabra = input.value;
    //Si el valor es nulo o undefined salimos
    if(!input.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene m??s de una letra almacenamos las min??sculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input.value = mayuscula.concat(minuscula);
    }

    var input2 = document.getElementById('Descripcion');
    //funci??n que capitaliza la primera letra
    function capitalizarPrimeraLetradescripcion() {
    //almacenamos el valor del input
    var palabra = input2.value;
    //Si el valor es nulo o undefined salimos
    if(!input2.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene m??s de una letra almacenamos las min??sculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input2.value = mayuscula.concat(minuscula);
    }
</script>

<script>
    window.onload = function() {
        var myInput = document.getElementById('Materia');
        var myInput2 = document.getElementById('Descripcion');

        //ONPASTE
        myInput.onpaste = function(e) {
            e.preventDefault();
            alert("esta acci??n est?? prohibida");
        }

        myInput2.onpaste = function(e) {
            e.preventDefault();
            alert("esta acci??n est?? prohibida");
        }
        
        //ONCOPY
        myInput.oncopy = function(e) {
            e.preventDefault();
            alert("esta acci??n est?? prohibida");
        }

        myInput2.oncopy = function(e) {
            e.preventDefault();
            alert("esta acci??n est?? prohibida");
        }
    }
</script>

<script>
   
    form = document.getElementById('formedit'); 
    var cont=0;

    form.addEventListener("submit", function(event){
            var stockAnitguo = parseInt(document.getElementById('stock_antigui').value);
            var stockActual = parseInt(document.getElementById('cantidad').value);
            if (stockActual < stockAnitguo) {
                event.preventDefault();
                $("#cantidad").val("");
                alert("Si desea reducir la materia dirijase al kardex de materia o materia saliente");
                cont++;
            }
        } 
    )
</script>
@stop