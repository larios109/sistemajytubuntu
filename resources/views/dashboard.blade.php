@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', ' | Dashboard')

@section('content_header')
@stop

@section('content')
    <h2 >{{ __('Inicio') }}</h2>
    <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body"> 
                            Bienvenido al sistema de servicios JYT Comercializadora, podras llevar control de la informacion de la empresa.  
                            <hr class="bg-dark border-1 border-top border-dark">                       
                            <div class="row">
                                <div class="col-md-4 col-xl-4">
                                    <div class="card text-white bg-dark">
                                            <div class="card-block">
                                            <h5>Colaboradores</h5>                                               
                                                @php
                                                 use App\Models\User;
                                                $cant_usuarios = User::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                                            </div>                                            
                                        </div>                                    
                                    </div>

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card text-white bg-dark">
                                            <div class="card-block">
                                            <h5>Clientes</h5>                                               
                                                @php
                                                    $cant_cliente = DB::table('cliente')->count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-user f-left"></i><span>{{$cant_cliente}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/cliente" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card text-white bg-dark">
                                            <div class="card-block">
                                            <h5>Solicitud Pedidos</h5>                                               
                                                @php
                                                 $cant_ventas = DB::table('ventas')->count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-fw fa-file-invoice f-left"></i><span>{{$cant_ventas}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/solicitudpedidos" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card text-white bg-dark">
                                            <div class="card-block">
                                            <h5>Productos</h5>                                               
                                                @php
                                                    $cant_prod = DB::table('lista_productos')->count();                                          
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-fw fa-wine-bottle f-left"></i><span>{{$cant_prod}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/listaproductos" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card text-white bg-dark">
                                            <div class="card-block">
                                            <h5>Telefonos</h5>                                               
                                                @php
                                                    $cant_telefonos = DB::table('telefonos')->count();                                           
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-fw fa-phone f-left"></i><span>{{$cant_telefonos}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/telefonos" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card text-white bg-dark">
                                            <div class="card-block">
                                            <h5>Correos</h5>                                               
                                                @php
                                                    $cant_correos = DB::table('correos')->count();                                        
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-fw fa-envelope f-left"></i><span>{{$cant_correos}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/correos" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <center>
                                    <img src="{{asset('/images/jotayt.jpg')}}" alt=""  style="width:128pxl;">
                                </center>
                            </div>                                                                                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('css')
@stop

@section('js')
@stop