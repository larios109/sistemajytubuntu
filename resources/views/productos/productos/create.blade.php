@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Registar Producto')

@section('content_header')
    <h1 class="text-center">Productos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('productos.store')}}" method='POST'>
        @csrf
        <div class="card  mb-2">

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Categoria</label>
                <select class="col-sm-7" class="form-control" id="idcategoria" name="idcategoria" required>
                    <option disabled selected>Escoja un codigo de una categoria</option>
                    @foreach($categorias as $cate)
                        {
                            <option value="{{ $cate->idcategoria}}">{{ $cate->nombre}}</option>
                        }
                    @endforeach
                </select>
                @if ($errors->has('idcategoria'))
                    <div     
                        id="idcategoria-error"                                          
                        class="error text-danger pl-3"
                        for="idcategoria"
                        style="display: block;">
                        <strong>{{$errors->first('idcategoria')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="nombre" name="nombre" class="form-control" maxlength="20" 
                    onkeydown="return /[a-z ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetranombre()" 
                    placeholder="Ingrese el Nombre del Producto" value="{{old('nombre')}}" required>
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
                    <input type="number" id="precio_producto" name="precio_producto"  class="form-control" min="1" max="99999" maxlength="10" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    placeholder="Ingrese el Precio del Producto" value="{{old('precio_producto')}}" required>
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
                    <input type="number" id="stock" name="stock"  class="form-control" min="1" max="9999999999" maxlength="10" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" 
                    placeholder="Ingrese la Cantidad" value="{{old('stock')}}" required>
                </div>
                @if ($errors->has('stock'))
                    <div               
                        id="stock-error"                               
                        class="error text-danger pl-3"
                        for="stock"
                        style="display: block;">
                        <strong>{{$errors->first('stock')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Descripcion</label>
                 <div class="col-sm-7">
                    <input type="text" id="descripcion" name="descripcion" class="form-control"  maxlength="25" 
                    onkeyup="capitalizarPrimeraLetradescripcion()"  placeholder="Ingrese la descripcion del producto" 
                    value="{{old('descripcion')}}" required>
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
                        Guardar <i class="fa fa-check-circle ml-2"></i>
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
@stop