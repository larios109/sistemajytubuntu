<table id="tablacolaboradores" class="table">
<thead>
    <tr>
        <th>Codigo</th>
        <th>Primer Nombre</th>
        <th>Primer Apellido</th>
        <th>Segundo Nombre</th>
        <th>Segundo Apellido</th>
        <th>Sueldo Bruto</th>
        <th>IHSS</th>
        <th>RAP</th>
        <th>Otras Deducciones</th>
        <th>Vacaciones</th>
        <th>Descripcion Vacaciones</th>
        <th>Periodo Pago</th>
        <th>Sueldo</th>
    </tr>
</thead>
<tbody>
     @foreach($colaboradores as $colaborador)
        <tr>
            <td>{{$colaborador->cod_empleado}}</td>
            <td>{{$colaborador->primer_nom}}</td>
            <td>{{$colaborador->primer_apellido}}</td>
            <td>{{$colaborador->segund_nom}}</td>
            <td>{{$colaborador->segund_apellido}}</td>
            <td>{{$colaborador->sueldo_bruto}}</td>
        </tr>
    @endforeach
</tbody></table>