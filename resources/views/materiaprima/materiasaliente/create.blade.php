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
                <div class="col-sm-7">
                    <input type="text" id="Materia" name="Materia" class="form-control" readonly="" required>
                </div>
                <button type="button" id="btnAñadir" class="btn btn-success btnAñadir" style="background:dodgerblue" data-bs-toggle="modal" data-bs-target="#modalAñadir">
                <i class="fa fa-search"></i>&nbsp;
                </button>
            </div>

            <div  class="row mb-3">
                <div class="col-sm-7">
                    <input type="number" id="codm" name="codm" hidden class="form-control" readonly="">
                </div>
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Materia Disponible</label>
                <div class="col-sm-7">
                    <input type="number" id="cantidadd" name="cantidadd" class="form-control" readonly="">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Descripcion</label>
                 <div class="col-sm-7">
                    <textarea type="text" id="Descripcion" name="Descripcion" class="form-control" maxlength="90" 
                    onkeyup="capitalizarPrimeraLetradescripcion()"  rows="5" cols="20"
                    placeholder="Ingrese una descripcion" value="{{old('Descripcion')}}"></textarea>
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
                            <table id="tablamateriaentrante" class="table table-stripped table-bordered table-condensed table-hover">
                                <thead class=thead-dark>
                                    <tr>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Nombre Materia</th>
                                        <th class="text-center">Tipo Medida</th>
                                        <th class="text-center">Precio Compra</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Fecha compra</th>
                                        <th class="text-center">Fecha Caducidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($materiaentrante as $materiae)
                                        <tr>
                                            <td class="text-center">{{$materiae->cod_materia_e}}</td>
                                            <td class="text-center" id="t1">{{$materiae->nom_materia}}</td>
                                            <td class="text-center">{{$materiae->tip_medida}}</td>
                                            <td class="text-center">{{$materiae->pre_compra}}</td>
                                            <td class="text-center" id="t2">{{$materiae->cant}}</td>
                                            <td class="text-center">{{date('Y-m-d', strtotime($materiae->fec_compra))}}</td>
                                            <td class="text-center">{{date('Y-m-d', strtotime($materiae->fec_caducidad))}}</td>
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

<!-- <script>
    const form = document.getElementById('formstore');

    form.addEventListener("submit", function(event){
            cantidad=$("#cantidadd").val();
            cant=$("#cantidad").val(); 
            if (cant > cantidad) {
                event.preventDefault();
                alert("La cantidad a usar supera la cantidad actual");
            }else{

            }
        }
    )
</script> -->

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> 
<!-- datatables extension SELECT -->
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>     

<script>
    $(document).ready(function() {
        var table = $('#tablamateriaentrante').DataTable({
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
            $('#Materia').val(data[1]);
            $('#codm').val(data[0]);
            $('#cantidadd').val(data[4]);
        })
    });
</script>
@stop