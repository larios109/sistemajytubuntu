@extends('adminlte::page')
<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Registrar solicitud pedido')

@section('content_header')
    <h1 class="text-center">Nueva Solicitud Pedidos</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
<form action="{{route('solicitudpedidos.store')}}" method='POST'>
  @csrf

  <div class="row mb-3">
      <label for="nombre" class="col-sm-2 col-form-label">Cliente</label>
      <select name="cod_cliente" id="cod_cliente" class="form-control selectpicker col-sm-7 border" data-live-search="true">
      <option disabled selected>Escoja un cliente</option>
        @foreach($clientes as $cliente)
          <option value="{{$cliente->cod_persona}}">{{$cliente->primer_nom}} {{$cliente->primer_apellido}}</option>
        @endforeach
      </select>
      @if ($errors->has('cod_cliente'))
        <div     
          id="cod_cliente-error"                                          
          class="error text-danger pl-3"
          for="cod_cliente"
          style="display: block;">
          <strong>{{$errors->first('cod_cliente')}}</strong>
        </div>
      @endif
  </div>

  <hr class="bg-dark border-1 border-top border-dark">

  <div class="row">
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
      <div class="form-group">
        <label>Producto</label>
        <select name="pidarticulo" id="pidarticulo" class="form-control selectpicker border" data-live-search="true">
        <option disabled selected>Escoja un producto</option>
          @foreach($articulos as $articulo)
            <option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_producto}}">{{$articulo->articulo}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
        <div class="form-group">
            <label >Cantidad</label>
            <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad" min="1" 
            max="99999999" maxlength="8" >
        </div>
    </div>

    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
      <div class="form-group">
          <label for="stock">Stock</label>
          <input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock">
      </div>
    </div> 
    
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
      <div class="form-group">
          <label for="precio_venta">Precio de producto</label>
          <input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Precio producto">
      </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
      <div class="form-group">
        <button class="btn btn-primary" type="button" id="bt_add">Agregar</button>
      </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
          <thead style="background-color: #A9D0F5">
              <th>Opciones</th>
              <th>Articulo</th>
              <th>Cantidad</th>
              <th>Precio Venta</th>
              <th>Subtotal</th>
          </thead>
          <tfoot>
            <th><h4>ISV</h4> <h4>Total</h4></th>
            <th></th>
            <th></th>
            <th></th>
            <th><h4 id="isv">0.00</h4><input type="hidden" name="isv_total" id="isv_total"> <h4 id="total">0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
          </tfoot>
          <tbody>              
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">         
      <div class="form-group">
        <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
          <button class="btn btn-primary" id="guardar" type="submit">Guardar</button>
          <a href="{{route('solicitudpedidos.index')}}" class="btn btn-danger"
          >Cancelar</a>
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
  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
    });
  });

  var cont=0;
  total=0;
  isv=0;
  isv2=0;
  subtotal=[];
  $("#guardar").hide();
  $("#pidarticulo").change(mostrarValores);//trae los valores del articulo cada vez que se seleccione

  function mostrarValores()
  {
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    $("#pprecio_venta").val(datosArticulo[2]);
    $("#pstock").val(datosArticulo[1]);
  }

  function agregar(){
    datosArticulo=document.getElementById('pidarticulo').value.split('_');
    idarticulo=datosArticulo[0];
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();
    precio_producto=$("#pprecio_venta").val();
    stock=$("#pstock").val();
    if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_producto!="")
    {
        if (stock>=cantidad) 
        {
          subtotal[cont]=(cantidad*precio_producto);
          isv=(isv+(0.18*subtotal[cont]));
          isv2=0.18*subtotal[cont];
          total=total+isv2+subtotal[cont];
          var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" readonly="" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" readonly="" name="precio_producto[]" value="'+precio_producto+'"></td><td>'+subtotal[cont]+'</td></tr>';
          cont++;
          limpiar();
          $("#isv").html(isv);
          $("#isv_total").val(isv);
          $("#total").html(total);
          $("#total_venta").val(total);
          evaluar();
          $('#detalles').append(fila);
        }
        else
        {
          alert("La cantidad a vender supera el stock actual");
        }
    }
    else
    {
      alert("Error al ingresar el detalle de la venta, revise los datos del articulo")
    }
  
  }
  function limpiar(){
    $("#pcantidad").val("");
    $("#pprecio_venta").val("");
    $("#pstock").val("");
  }
  function evaluar()
  {
    if (total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
   }
   function eliminar(index){
    isv=(isv-(0.18*subtotal[cont]));
    total=total-subtotal[index]-isv2; 
    $("#isv").html(isv);
    $("#isv_total").val(isv); 
    $("#total").html(total); 
    $("#total_venta").val(total);
    $("#fila" + index).remove();
    evaluar();
  }
</script>
@stop
