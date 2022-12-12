@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Registrar Movimiento')

@section('content_header')
    <h1 class="text-center">Registrar Movimiento</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('kardexmateria.store')}}" method='POST' id="formstore">
        @csrf
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Materia</label>
                <div class="col-sm-7">
                    <input type="text" id="materia" name="materia" class="form-control" readonly="" required>
                </div>
                <button type="button" id="btnAñadir" class="btn btn-success btnAñadir" style="background:dodgerblue" data-bs-toggle="modal" data-bs-target="#modalAñadir">
                <i class="fa fa-search"></i>&nbsp;
                </button>
            </div>

            <div  class="row mb-3">
                <div class="col-sm-7">
                    <input type="number" id="codmateria" name="codmateria" hidden  class="form-control" readonly="">  
                </div>
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Stock Actual</label>
                <div class="col-sm-7">
                    <input type="number" id="stock" name="stock" class="form-control" readonly="">
                </div>
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Movimiento</label>
                <select class="col-sm-7" class="form-control" id="movimiento" name="movimiento">
                    <option disabled selected>Escoja un movimiento</option>
                    <option>Deterioro</option>
                    <option>Donacion</option>
                </select>
                @if ($errors->has('movimiento'))
                    <div     
                        id="movimiento-error"                                          
                        class="error text-danger pl-3"
                        for="movimiento"
                        style="display: block;">
                        <strong>{{$errors->first('movimiento')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Cantidad</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="cantidad" min="1" max="99999" maxlength="5" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    class="form-control" placeholder="Ingrese la Cantidad" onclick="validar()" value="{{old('cantidad')}}">
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
                    <a href="{{route('kardexmateria.index')}}"
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
                            <table id="tablaproductos" class="table table-stripped table-bordered table-condensed table-hover">
                                <thead class=thead-dark>
                                    <tr>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Fecha Compra</th>
                                        <th class="text-center">Fecha Caducidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($materiaentratne as $materia)
                                        <tr>
                                            <td class="text-center">{{$materia->cod_materia_e}}</td>
                                            <td class="text-center">{{$materia->nom_materia}}</td>
                                            <td class="text-center">{{$materia->cant}}</td>
                                            <td class="text-center">{{date('Y-m-d', strtotime($materia->fec_compra))}}</td>
                                            <td class="text-center">{{date('Y-m-d', strtotime($materia->fec_caducidad))}}</td>
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
   
    form = document.getElementById('formstore'); 
    var cont=0;

    form.addEventListener("submit", function(event){
            var stockactual = parseInt(document.getElementById('stock').value);
            var reduccionStock = parseInt(document.getElementById('cantidad').value);
            if (reduccionStock >= stockactual) {
                event.preventDefault();
                $("#cantidad").val("");
                alert("Si desea Incrementar la materia dirijase a materia entrante");
                cont++;
            }
        } 
    )
</script>

<script>

    var m1 = document.getElementById("SueldoB");
    var m2 = document.getElementById("IHSS");

    function res() {
        var multi = m1.value - m2.value - m3.value - m4.value - m5.value;
        document.getElementById("Sueldo").value=multi;
    }

</script>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> 
<!-- datatables extension SELECT -->
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>     

<script>
    $(document).ready(function() {
        var table = $('#tablaproductos').DataTable({
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
            $('#materia').val(data[1]);
            $('#codmateria').val(data[0]);
            $('#stock').val(data[2]);
        })
    });
</script>
@stop