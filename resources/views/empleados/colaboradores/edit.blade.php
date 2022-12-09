@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Colaborador')

@section('content_header')
    <h1 class="text-center">Colaborador</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('colaboradores.update', $colaborador->cod_empleado)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">
            
            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Persona</label>
                <div class="col-sm-7">
                    <input type="text" id="persona" name="persona" class="form-control" readonly="" required value="{{$colaborador->nombre}}">
                </div>
                <button type="button" id="btnAñadir" class="btn btn-success btnAñadir" style="background:dodgerblue" data-bs-toggle="modal" data-bs-target="#modalAñadir">
                <i class="fa fa-search"></i>&nbsp;
                </button>
            </div>

            <div  class="row mb-3">
                <div class="col-sm-7">
                    <input type="number" id="codp" name="codp" hidden class="form-control" readonly="" value="{{$colaborador->cod_empleado}}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Sueldo</label>
                 <div class="col-sm-7">
                    <input type="number" id="Sueldo" name="Sueldo" min="1" max="999999" maxlength="10" 
                    step="0.00001" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    class="form-control" placeholder="Ingrese el sueldo bruto" value="{{$colaborador->sueldo_bruto}}">
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

            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha Entrada</label>
                 <div class="col-sm-7">
                    <input type="date" id="Fecha" name="Fecha" class="form-control" min="2022-01-01"
                    value="{{date('Y-m-d', strtotime($colaborador->fecha_registro))}}">
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

            
            <div class="row mb-3">
                <label for="calendar" class="col-sm-2 col-form-label">Fecha Salida</label>
                 <div class="col-sm-7">
                    <input type="date" id="salida" name="salida" class="form-control">
                </div>
                @if ($errors->has('salida'))
                    <div     
                        id="salida-error"                                          
                        class="salida text-danger pl-3"
                        for="salida"
                        style="display: block;">
                        <strong>{{$errors->first('salida')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Motivo Salida</label>
                 <div class="col-sm-7">
                    <input type="text" id="motivo" name="motivo" class="form-control" maxlength="200" 
                    placeholder="Ingrese el motivo de la salida" 
                    value="{{$colaborador->motivo_salida}}">
                </div>
                @if ($errors->has('motivo'))
                    <div               
                        id="motivo-error"                               
                        class="error text-danger pl-3"
                        for="motivo"
                        style="display: block;">
                        <strong>{{$errors->first('motivo')}}</strong>
                    </div>
                @endif
            </div>


            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('colaboradores.index')}}"
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
                        <table id="tablapersona" class="table table-stripped table-bordered table-condensed table-hover">
                            <thead class=thead-dark>
                                <tr>
                                    <th class="text-center">Codigo</th>
                                    <th class="text-center">Primer Nombre</th>
                                    <th class="text-center">Segundo Nombre</th>
                                    <th class="text-center">Primer Apellido</th>
                                    <th class="text-center">Segundo Apellido</th>
                                    <th class="text-center">DNI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personas as $persona)
                                    <tr>
                                        <td class="text-center">{{$persona->cod_persona}}</td>
                                        <td class="text-center">{{$persona->primer_nom}}</td>
                                        <td class="text-center">{{$persona->segund_nom}}</td>
                                        <td class="text-center">{{$persona->primer_apellido}}</td>
                                        <td class="text-center">{{$persona->segund_apellido}}</td>
                                        <td class="text-center">{{$persona->dni}}</td>
                                    </tr>
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
    $(document).ready(function() {
        var table = $('#tablapersona').DataTable({
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
            $('#persona').val(data[1]);
            $('#codp').val(data[0]);
        })
    });
</script>
@stop