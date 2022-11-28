<head>
<link rel="stylesheet" href="{{ public_path('css/app.css') }}">
</head>
<h1 class="text-center">Detalle Solicitud Pedidos</h1>
<hr class="bg-dark border-1 border-top border-dark">

<div class="row mb-3">
    <label for="nombre" class="col-sm-2 col-form-label">Cliente</label>
    <p>{{$venta->primer_nom}} {{$venta->primer_apellido}}</p>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #A9D0F5">
                <th class="text-center">Articulo</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Precio Venta</th>
                <th class="text-center">Subtotal</th>
            </thead>
            <tbody>
                @foreach($detalles as $det)
                <tr>
                    <td class="text-center">{{$det->articulo}}</td>
                    <td class="text-center">{{$det->cantidad}}</td>
                    <td class="text-center">{{$det->precio_venta}}</td>
                    <td class="text-center">{{$det->cantidad*$det->precio_venta}}</td>
                </tr>
                @endforeach              
            </tbody>
            <tfoot>
            <th class="text-center"></th>
            <th class="text-center"></th>
            <th class="text-center"><h4>ISV</h4> <h4>Total</h4></th>
            <th class="text-center"><h4 id="isv">{{$venta->impuesto}}</h4><h4 id="total">{{$venta->total_venta}}</h4></th>
            </tfoot>
        </table>
    </div>
</div>
