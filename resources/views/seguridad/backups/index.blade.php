@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('css')
<!-- <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" rel="stylesheet">
@stop

@section('title', '| Backup')
@section('content_header')
    <h1 class="text-center">Backup</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')

<a 
    href="{{ route('backups.create') }}"
    class="btn btn-outline-info text-center btn-block">
    <spam>Crear Backup</spam> <i class="fas fa-plus-square"></i>
</a>

<a 
    href="{{ route('backups.exportar') }}" hidden
    class="btn btn-outline-info text-center btn-block">
    <spam>Exportar</spam> <i class="fas fa-plus-square"></i>
</a>

<div class="table-responsive-sm mt-5">
    <table id="tablabackup" class="table table-stripped table-bordered table-condensed table-hover">
        <thead class=thead-dark>
            <tr>
                <th class="text-center">Codigo</th>
                <th class="text-center">Nombre Archivo</th>
                <th class="text-center">Tamaño</th>
                <th class="text-center">Fecha Creacion</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $key=>$backup)
                <tr>
                    <td class="text-center text-muted">{{ $key + 1 }}</td>
                    <td class="text-center">
                        <code>{{ $backup['file_name'] }}</code>
                    </td>
                    <td class="text-center">{{ $backup['file_size'] }}</td>
                    <td class="text-center">{{ $backup['created_at'] }}</td>
                    <td class="text-center">
                        <form action="{{ route('backups.destroy',$backup['file_name']) }}" class="d-inline formulario-eliminar" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('backups.descargar',$backup['file_name']) }}">
                                <span>Descargar</span>
                            </a>
                            @can ('borrar backup')
                            <button type="submit" class="btn btn-danger btn-sm" class="fas fa-trash-alt"><span>Eliminar</span>
                            @csrf
                            @method('DELETE')
                            </button>
                            @endcan
                        </form>
                        <a class="btn btn-warning btn-sm" href="{{ route('backups.importar') }}">
                            <span>Restaurar</span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#tablabackup').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            // dom: 'Blfrtip',
            //dom: '<"pt-2 row" <"col-xl mt-2"l><"col-xl text-center"B><"col-xl text-right mt-2 buscar"f>> <"row"rti<"col"><p>>',
        });
    });
</script>

@if(session('eliminar') == 'Ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'Se elimino con exito',
            'success'
        )
    </script>
@endif

<script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();

        Swal.fire({
            title: '¿Estas seguro?',
            text: "Se eliminara definitivamente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>
@stop