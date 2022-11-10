@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Pago salario')

@section('content_header')
    <h1 class="text-center">Pago Salario</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('pagosalario.update', $pagosalarioactu->cod_pago)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">
            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Codigo Colaborador</label>
                <select class="form-control selectpicker col-sm-7 border" id="Empleado" name="Empleado"
                data-live-search="true">
                    @foreach($colaboradores as $colaborador)
                        {
                            @if ($colaborador->cod_empleado == $pagosalarioactu->cod_empleado)
                            <option value="{{$colaborador->cod_empleado}}_{{$colaborador->sueldo_bruto}}" selected>{{$colaborador->cod_empleado}}.{{$colaborador->nombre}}</option>
                            @else
                            <option value="{{$colaborador->cod_empleado}}_{{$colaborador->sueldo_bruto}}">{{$colaborador->cod_empleado}}.{{$colaborador->nombre}}</option>
                            @endif
                        }
                    @endforeach
                </select>
                @if ($errors->has('Empleado'))
                    <div     
                        id="Empleado-error"                                          
                        class="error text-danger pl-3"
                        for="Empleado"
                        style="display: block;">
                        <strong>{{$errors->first('Empleado')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sueldo Bruto</label>
                 <div class="col-sm-7">
                    <input type="number" id="SueldoB" name="SueldoB" min="1" max="999999" maxlength="6" step="0.00001" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  
                    class="form-control" placeholder="Ingrese el sueldo bruto" value="{{$pagosalarioactu->sueldo_bruto}}">
                </div>
                @if ($errors->has('SueldoB'))
                    <div               
                        id="SueldoB-error"                               
                        class="error text-danger pl-3"
                        for="SueldoB"
                        style="display: block;">
                        <strong>{{$errors->first('SueldoB')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">IHSS</label>
                 <div class="col-sm-7">
                    <input type="number" id="IHSS" name="IHSS" min="1" max="99999" maxlength="5" step="0.00001" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    onchange="res(this.value);"  class="form-control" placeholder="Ingrese el IHSS" 
                    value="{{$pagosalarioactu->IHSS}}">
                </div>
                @if ($errors->has('IHSS'))
                    <div                 
                        id="IHSS-error"                             
                        class="error text-danger pl-3"
                        for="IHSS"
                        style="display: block;">
                        <strong>{{$errors->first('IHSS')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">RAP</label>
                 <div class="col-sm-7">
                    <input type="number" id="RAP" name="RAP" class="form-control" min="1" max="99999" maxlength="5" 
                    step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onchange="res(this.value);"  
                    placeholder="Ingrese el RAP" value="{{$pagosalarioactu->RAP}}">
                </div>
                @if ($errors->has('RAP'))
                    <div          
                        id="RAP-error"                                     
                        class="error text-danger pl-3"
                        for="RAP"
                        style="display: block;">
                        <strong>{{$errors->first('RAP')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Otras deducciones</label>
                 <div class="col-sm-7">
                    <input type="number" id="deducciones" name="deducciones" min="1" max="99999" maxlength="5" 
                    step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onchange="res(this.value);"  class="form-control" 
                    placeholder="Ingrese otras deducciones" value="{{$pagosalarioactu->otras_deducciones}}">
                </div>
                @if ($errors->has('deducciones'))
                    <div
                        id="deducciones-error"                                                
                        class="error text-danger pl-3"
                        for="deducciones"
                        style="display: block;">
                        <strong>{{$errors->first('deducciones')}}</strong>
                    </div>
                 @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">vacaciones</label>
                 <div class="col-sm-7">
                    <input type="number" id="vacaciones" name="vacaciones" min="1" max="99999" maxlength="5" 
                    step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onchange="res(this.value);"  
                    class="form-control" placeholder="Ingrese las vacaciones" value="{{$pagosalarioactu->vacaciones}}">
                </div>
                @if ($errors->has('vacaciones'))
                    <div
                        id="vacaciones-error"                                              
                        class="error text-danger pl-3"
                        for="vacaciones"
                        style="display: block;">
                        <strong>{{$errors->first('vacaciones')}}</strong>
                     </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Descripcion vacaciones</label>
                 <div class="col-sm-7">
                    <input type="text" id="Descripcion" name="Descripcion" class="form-control" maxlength="15" 
                    onkeyup="capitalizarPrimeraLetradescripcion()" placeholder="Ingrese la Descripcion de vacaciones" 
                    value="{{$pagosalarioactu->descripcion_vacaciones}}">
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sueldo</label>
                 <div class="col-sm-7">
                    <input type="number" id="Sueldo" name="Sueldo" step="0.00001" min="1" max="999999" maxlength="6" readonly=""   class="form-control" placeholder="Sueldo" value="{{$pagosalarioactu->salario}}">
                </div>
                @if ($errors->has('Sueldo'))
                    <div
                        id="Sueldo-error"                                              
                        class="error text-danger pl-3"
                        for="Sueldo"
                        style="display: block;">
                        <strong>{{$errors->first('Sueldo')}}</strong>
                     </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('pagosalario.index')}}"
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
    var input = document.getElementById('Descripcion');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetradescripcion() {
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

    var m1 = document.getElementById("SueldoB");
    var m2 = document.getElementById("IHSS");
    var m3 = document.getElementById("RAP");
    var m4 = document.getElementById("deducciones");
    var m5 = document.getElementById("vacaciones");

    function res() {
        var multi = m1.value - m2.value - m3.value - m4.value - m5.value;
        document.getElementById("Sueldo").value=multi;
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

    $("#Empleado").change(mostrarValores);//trae los valores del articulo cada vez que se seleccione

    function mostrarValores()
    {
    datospago=document.getElementById('Empleado').value.split('_');
    $("#SueldoB").val(datospago[1]);
    }
</script>
@stop