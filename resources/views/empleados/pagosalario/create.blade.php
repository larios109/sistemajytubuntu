@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Registar Pago salario')

@section('content_header')
    <h1 class="text-center">Pago Salario</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('pagosalario.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Colaborador</label>
                <div class="col-sm-7">
                    <input type="text" id="colaborador" name="colaborador" class="form-control" readonly="" required>
                </div>
                <button type="button" id="btnAñadir" class="btn btn-success btnAñadir" style="background:dodgerblue" data-bs-toggle="modal" data-bs-target="#modalAñadir">
                <i class="fa fa-search"></i>&nbsp;
                </button>
            </div>

            <div  class="row mb-3">
                <div class="col-sm-7">
                    <input type="number" id="codc" name="codc" hidden class="form-control" readonly="">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sueldo Bruto</label>
                 <div class="col-sm-7">
                    <input type="number" id="SueldoB" name="SueldoB" min="1" max="999999" readonly="" maxlength="10" step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="Sueldo bruto" value="{{old('SueldoB')}}">
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
                    <input type="number" id="IHSS" name="IHSS" min="1" max="99999" maxlength="10" step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onchange="res(this.value);" class="form-control" placeholder="Ingrese el IHSS" value="{{old('IHSS')}}">
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
                    <input type="number" id="RAP" name="RAP" min="1" max="99999" maxlength="10" step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onchange="res(this.value);" class="form-control" placeholder="Ingrese el RAP" value="{{old('RAP')}}">
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
                    <input type="number" id="deducciones" name="deducciones" min="1" max="99999" maxlength="10" step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onchange="res(this.value);" class="form-control" placeholder="Ingrese otras deducciones" value="{{old('deducciones')}}">
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
                    <input type="number" id="vacaciones" name="vacaciones" min="1" max="99999" maxlength="10" step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onchange="res(this.value);" class="form-control" placeholder="Ingrese las vacaciones" value="{{old('vacaciones')}}">
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
                    <input type="text" id="Descripcion" name="Descripcion" class="form-control" maxlength="40"  onkeyup="capitalizarPrimeraLetradescripcion()" placeholder="Ingrese la Descripcion de vacaciones" value="{{old('Descripcion')}}">
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
                    <input type="number" id="Sueldo" name="Sueldo" class="form-control" step="0.001" min="1" max="999999" maxlength="8" readonly=""  placeholder="Sueldo" value="{{old('Sueldo')}}">
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
                        Guardar <i class="fa fa-check-circle ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
     </form>

     <div class="modal fade" id="modalAñadir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar Materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    

                        <!-- FORMULARIO -->
                        <div class="table-responsive-sm mt-5">
                            <table id="tablacolaboradores" class="table table-stripped table-bordered table-condensed table-hover">
                                <thead class=thead-dark>
                                    <tr>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Primer Nombre</th>
                                        <th class="text-center">Primer Apellido</th>
                                        <th class="text-center">Sueldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($colaboradores as $colaborador)
                                        <tr>
                                            <td class="text-center">{{$colaborador->cod_empleado}}</td>
                                            <td class="text-center">{{$colaborador->primer_nom}}</td>
                                            <td class="text-center">{{$colaborador->primer_apellido}}</td>
                                            <td class="text-center">{{$colaborador->sueldo_bruto}}</td>
                                        </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cerrar" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
.modal-lg { 
    max-width: 90%; 
}
</style>
<!-- datatables extension SELECT -->
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@stop

@section('js')
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> 
<!-- datatables extension SELECT -->
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>   

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
    $(document).ready(function() {
        var table = $('#tablacolaboradores').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            // dom: 'Blfrtip',
            dom: '<"pt-2 row" <"col-xl mt-2"l><"col-xl text-center"B><"col-xl text-right mt-2 buscar"f>> <"row"rti<"col"><p>>',
            select:true,
            select:{
                style:'single'
            }  
        });
        table.on('select', function () {
            var data = table.row( { selected: true } ).data();
            console.log(data);
            $('#cerrar').click();
            $('#colaborador').val(data[1]);
            $('#codc').val(data[0]);
            $('#SueldoB').val(data[3]);
        })
    });
</script>
@stop