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

    <div  class="row mb-3">
      <label for="colFormLabel" class="col-sm-2 col-form-label">Cliente</label>
      <div class="col-sm-7">
          <input type="text" id="cliente" name="cliente" class="form-control" readonly="" required>
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

    <hr class="bg-dark border-1 border-top border-dark">

    <div  class="row mb-3">
      <label for="colFormLabel" class="col-sm-2 col-form-label">Producto</label>
        <div class="col-sm-7">
            <input type="text" id="producto" name="producto" class="form-control" readonly="" required>
        </div>
        <button type="button" id="btnAñadir2" class="btn btn-success btnAñadir" style="background:dodgerblue" data-bs-toggle="modal" data-bs-target="#modalproductos">
        <i class="fa fa-search"></i>&nbsp;
        </button>
    </div>

    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
        <div class="form-group">
            <input type="number" name="pidarticulo" id="pidarticulo" hidden class="form-control" readonly="" maxlength="10"
            value="">
        </div>
    </div>

  <div class="row">

    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
      <div class="form-group">
          <label for="stock">Stock</label>
          <input type="number" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock">
      </div>
    </div> 
    
    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
      <div class="form-group">
          <label for="precio_venta">Precio producto</label>
          <input type="number" disabled name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Precio producto">
      </div>
    </div>

    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
        <div class="form-group">
            <label >Cantidad</label>
            <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad" min="1" 
            max="99999999" maxlength="8">
        </div>
    </div>

    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
      <div class="form-group">
          <label for="precio_venta">ISV</label>
          <input type="number" name="ISV" id="ISV" class="form-control" placeholder="ISV en decimales 0.18" min="1" 
            max="99" maxlength="8" step="0.01">
      </div>
    </div>

      <div class="form-group-agregar">
        <button class="btn btn-success" type="button" id="bt_add" style="background:dodgerblue">Añadir</button>
      </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
          <thead style="background-color: #A9D0F5">
              <th class="text-center">Opciones</th>
              <th class="text-center">Articulo</th>
              <th class="text-center">Cantidad</th>
              <th class="text-center">Precio Venta</th>
              <th class="text-center">Subtotal</th>
          </thead>
          <tfoot>
            <th class="text-center"></th>
            <th class="text-center"></th>
            <th class="text-center"></th>
            <th class="text-center"><h4>ISV</h4> <h4>Total</h4></th>
            <th class="text-center"><h4 id="isv">0.00</h4><input type="hidden" name="isv_total" id="isv_total"> <h4 id="total">0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
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

    <div class="modal fade" id="modalAñadir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    

                        <!-- FORMULARIO -->
                        <div class="table-responsive-sm mt-5">
                          <table id="tablapersonas" class="table table-stripped table-bordered table-condensed table-hover">
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
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td class="text-center">{{$cliente->cod_persona}}</td>
                                        <td class="text-center">{{$cliente->primer_nom}}</td>
                                        <td class="text-center">{{$cliente->segund_nom}}</td>
                                        <td class="text-center">{{$cliente->primer_apellido}}</td>
                                        <td class="text-center">{{$cliente->segund_apellido}}</td>
                                        <td class="text-center">{{$cliente->dni}}</td>
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

    <div class="modal fade" id="modalproductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                        <!-- FORMULARIO -->
                        <div class="table-responsive-sm mt-5">
                            <table id="tablalistaproductos" class="table table-stripped table-bordered table-condensed table-hover">
                              <thead class=thead-dark>
                                  <tr>
                                      <th class="text-center">Codigo</th>
                                      <th class="text-center">Categoria</th>
                                      <th class="text-center">Nombre</th>
                                      <th class="text-center">Precio</th>
                                      <th class="text-center">Stock</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($articulos as $articulo)
                                      <tr>
                                          <td class="text-center">{{$articulo->idarticulo}}</td>
                                          <td class="text-center">{{ $articulo->categoria }}</td>
                                          <td class="text-center">{{ $articulo->articulo }}</td>
                                          <td class="text-center">{{ $articulo->precio_producto}}</td>
                                          <td class="text-center">{{ $articulo->stock}}</td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cerrar2" data-bs-dismiss="modal">Cerrar</button>
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

.form-group-agregar{
  display:flex;
  align-items:Center;
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
        var table = $('#tablapersonas').DataTable({
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
            $('#cliente').val(data[1]);
        })
    });
</script>

<script>
    $(document).ready(function() {
        var table = $('#tablalistaproductos').DataTable({
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
            $('#cerrar2').click();
            $('#pidarticulo').val(data[0]);
            $('#producto').val(data[2]);
            $('#pprecio_venta').val(data[3]);
            $('#pstock').val(data[4]);
        })
    });
</script>

<script>
  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
    });
  });

  var cont=0;
  total=0;
  isv2=0;
  subtotal=[];
  $("#guardar").hide();

  function agregar(){
    // datosArticulo=document.getElementById('pidarticulo');
    // idarticulo=$("#pidarticulo").val();
    datosArticulo = $("#pidarticulo").val();
    idarticulo = [datosArticulo];
    articulo=$("#producto").val();
    cantidad=$("#pcantidad").val();
    precio_producto=$("#pprecio_venta").val();
    stock=$("#pstock").val();
    isv=$("#ISV").val();

    if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_producto!="" && isv!="")
    {
        if (stock>=cantidad) 
        {
          subtotal[cont]=(cantidad*precio_producto);
          isv3=(isv*subtotal[cont]);
          isv2=isv2+isv3;
          total=total+isv3+subtotal[cont];

          var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" readonly="" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" readonly="" name="precio_producto[]" value="'+precio_producto+'"></td><td class="text-center">'+subtotal[cont]+'</td></tr>';
          cont++;
          limpiar();
          $("#isv").html(isv2);
          $("#isv_total").val(isv2);
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
      alert("Error al ingresar el detalle, revise los datos del producto")
    }
  
  }
  function limpiar(){
    $("#pcantidad").val("");
    $("#pprecio_venta").val("");
    $("#pstock").val("");
    $("#producto").val("");
    $("#pidarticulo").val("");
    $("#ISV").val("");
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
    isv2=isv2-isv3;
    total=total-isv3-subtotal[index]; 
    $("#isv").html(isv2);
    $("#isv_total").val(isv2); 
    $("#total").html(total); 
    $("#total_venta").val(total);
    $("#fila" + index).remove();
    evaluar();
  }
</script>
@stop
