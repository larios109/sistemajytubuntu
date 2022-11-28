@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Producto')

@section('content_header')
    <h1 class="text-center">Productos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('productos.update', $producto->idarticulo)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Categoria</label>
                <div class="col-sm-7">
                    <input type="text" id="idcategoria" name="idcategoria" class="form-control" readonly="" required
                    value="{{$producto->nombre}}">
                </div>
                <button type="button" id="btnAñadir" class="btn btn-success btnAñadir" style="background:dodgerblue" data-bs-toggle="modal" data-bs-target="#modalAñadir">
                <i class="fa fa-search"></i>&nbsp;
                </button>
            </div>

            <div  class="row mb-3">
                <div class="col-sm-7">
                    <input type="number" id="codc" name="codc"  1class="form-control" hidden readonly="" value="{{$producto->idcategoria}}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="nombre" name="nombre" class="form-control" maxlength="20" 
                    onkeydown="return /[a-z, 1-9 ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetranombre()" 
                    placeholder="Ingrese el Nombre del Producto" value="{{$producto->nombre_producto}}" required>
                </div>
                @if ($errors->has('nombre'))
                    <div               
                        id="nombre-error"                               
                        class="error text-danger pl-3"
                        for="nombre"
                        style="display: block;">
                        <strong>{{$errors->first('nombre')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Precio</label>
                 <div class="col-sm-7">
                    <input type="number" id="precio_producto" name="precio_producto"  class="form-control" min="1" max="999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  step="0.00001"
                    placeholder="Ingrese el Precio del Producto" value="{{$producto->precio_producto}}" required>
                </div>
                @if ($errors->has('precio_producto'))
                    <div          
                        id="precio_producto-error"                                     
                        class="error text-danger pl-3"
                        for="precio_producto"
                        style="display: block;">
                        <strong>{{$errors->first('precio_producto')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Stock</label>
                 <div class="col-sm-7">
                    <input type="number" id="cantidad" name="stock"  class="form-control" min="1" max="99999999" maxlength="10" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    placeholder="Ingrese la Cantidad" value="{{$producto->stock}}" required>
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
                <label for="colFormLabel" class="col-sm-2 col-form-label">Descripcion</label>
                 <div class="col-sm-7">
                    <textarea type="text" id="descripcion" name="descripcion" class="form-control" maxlength="25" 
                    onkeyup="capitalizarPrimeraLetradescripcion()" 
                    placeholder="Ingrese la descripcion del producto" value="{{$producto->descripcion}}" required>{{$producto->descripcion}}</textarea>
                </div>
                @if ($errors->has('descripcion'))
                    <div                 
                        id="descripcion-error"                             
                        class="error text-danger pl-3"
                        for="descripcion"
                        style="display: block;">
                        <strong>{{$errors->first('descripcion')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('productos.index')}}"
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
                    <h5 class="modal-title" id="exampleModalLabel">Buscar Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    

                        <!-- FORMULARIO -->
                        <div class="table-responsive-sm mt-5">
                            <table id="tablacategoria" class="table table-stripped table-bordered table-condensed table-hover">
                                <thead class=thead-dark>
                                    <tr>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categorias as $cate)
                                        <tr>
                                            <td class="text-center">{{$cate->idcategoria}}</td>
                                            <td class="text-center">{{$cate->nombre}}</td>
                                            <td class="text-center">{{$cate->descripcion}}</td>
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

<script>
    var input = document.getElementById('nombre');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetranombre() {
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

    var input2 = document.getElementById('descripcion');
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
        var myInput = document.getElementById('nombre');
        var myInput2 = document.getElementById('descripcion');

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

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> 
<!-- datatables extension SELECT -->
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>     

<script>
    $(document).ready(function() {
        var table = $('#tablacategoria').DataTable({
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
            $('#codc').val(data[0]);
            $('#idcategoria').val(data[1]);
        })
    });
</script>
@stop