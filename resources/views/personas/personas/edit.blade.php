@extends('adminlte::page')

<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

@section('title', '| Actualizar Persona')

@section('content_header')
    <h1 class="text-center">Persona</h1>
    <hr class="bg-dark border-1 border-top border-dark">
@stop

@section('content')
    <form action="{{route('personas.update', $actualizarpersona->cod_persona)}}" method='POST'>
        @csrf
        @method('PUT')
        <div class="card  mb-2">

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Codigo Persona</label>
                 <div class="col-sm-7">
                    <input type="text" id="cod_persona" name="cod_persona" class="form-control" readonly=""
                    value="{{$actualizarpersona->cod_persona}}">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Primer Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="Nombre" name="Nombre" class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)"  onkeyup="capitalizarPrimeraLetranombre()" 
                    placeholder="Ingrese el primer nombre" value="{{$actualizarpersona->primer_nom}}">
                </div>
                @if ($errors->has('Nombre'))
                    <div          
                        id="Nombre-error"                                     
                        class="error text-danger pl-3"
                        for="Nombre"
                        style="display: block;">
                        <strong>{{$errors->first('Nombre')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Segundo Nombre</label>
                 <div class="col-sm-7">
                    <input type="text" id="Nombre2" name="Nombre2" class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)"  onkeyup="capitalizarPrimeraLetranombre2()" 
                    placeholder="Ingrese el Segundo nombre" value="{{$actualizarpersona->segund_nom}}">
                </div>
                @if ($errors->has('Nombre2'))
                    <div          
                        id="Nombre2-error"                                     
                        class="error text-danger pl-3"
                        for="Nombre2"
                        style="display: block;">
                        <strong>{{$errors->first('Nombre2')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Primer Apellido</label>
                 <div class="col-sm-7">
                    <input type="text" id="Apellido" name="Apellido"  class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetraapellido()" 
                    placeholder="Ingrese el Primer apellido" value="{{$actualizarpersona->primer_apellido}}">
                </div>
                @if ($errors->has('Apellido'))
                    <div
                        id="Apellido-error"                                                
                        class="error text-danger pl-3"
                        for="Apellido"
                        style="display: block;">
                        <strong>{{$errors->first('Apellido')}}</strong>
                    </div>
                 @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Segundo Apellido</label>
                 <div class="col-sm-7">
                    <input type="text" id="Apellido2" name="Apellido2"  class="form-control" maxlength="10" 
                    onkeydown="return /[a-z, ]/i.test(event.key)" onkeyup="capitalizarPrimeraLetraapellido2()" 
                    placeholder="Ingrese el Segundo apellido" value="{{$actualizarpersona->segund_apellido}}">
                </div>
                @if ($errors->has('Apellido2'))
                    <div
                        id="Apellido2-error"                                                
                        class="error text-danger pl-3"
                        for="Apellido2"
                        style="display: block;">
                        <strong>{{$errors->first('Apellido2')}}</strong>
                    </div>
                 @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo Persona</label>
                <select class="col-sm-7" class="form-control" id="tipo" name="tipo">
                    <option selected value="{{$actualizarpersona->tipo_persona}}">{{$actualizarpersona->tipo_persona}}</option>
                    <option>Colaborador</option>
                    <option>Cliente</option>
                </select>
                @if ($errors->has('tipo'))
                    <div     
                        id="tipo-error"                                          
                        class="error text-danger pl-3"
                        for="tipo"
                        style="display: block;">
                        <strong>{{$errors->first('tipo')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">DNI</label>
                 <div class="col-sm-7">
                    <input type="number" id="DNI" name="DNI"  class="form-control" min="1" max="9999999999999" maxlength="13" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   
                    placeholder="Ingrese el dni" value="{{$actualizarpersona->dni}}">
                </div>
                @if ($errors->has('DNI'))
                    <div                 
                        id="DNI-error"                             
                        class="error text-danger pl-3"
                        for="DNI"
                        style="display: block;">
                        <strong>{{$errors->first('DNI')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Genero</label>
                <select class="col-sm-7" class="form-control" id="Genero" name="Genero">
                    <option  selected value="{{$actualizarpersona->genero}}">{{$actualizarpersona->genero}}</option>
                    <option>Femenino</option>
                    <option>Masculino</option>
                </select>
                @if ($errors->has('Genero'))
                    <div     
                        id="Cliente-error"                                          
                        class="error text-danger pl-3"
                        for="Genero"
                        style="display: block;">
                        <strong>{{$errors->first('Genero')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                 <div class="col-sm-7">
                    <input type="text" hidden id="cod_telefono" name="cod_telefono" class="form-control" readonly=""
                    value="{{$actualizarpersona->cod_telefono}}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Telefono</label>
                 <div class="col-sm-7">
                    <input type="number" id="Telefono" name="Telefono" class="form-control" min="1" max="99999999" maxlength="8" 
                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   
                    placeholder="Ingrese el telefono" value="{{$actualizarpersona->telefono}}">
                </div>
                @if ($errors->has('Telefono'))
                    <div
                        id="Telefono-error"                                              
                        class="error text-danger pl-3"
                        for="Telefono"
                        style="display: block;">
                        <strong>{{$errors->first('Telefono')}}</strong>
                     </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Tipo Telefono</label>
                <select class="col-sm-7" class="form-control" id="tipotelefono" name="tipotelefono">
                <option  selected value="{{$actualizarpersona->tip_telefono}}">{{$actualizarpersona->tip_telefono}}</option>
                    <option>Casa</option>
                    <option>Personal</option>
                    <option>Trabajo</option>
                </select>
                @if ($errors->has('tipotelefono'))
                    <div     
                        id="tipotelefono-error"                                          
                        class="error text-danger pl-3"
                        for="tipotelefono"
                        style="display: block;">
                        <strong>{{$errors->first('tipotelefono')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                 <div class="col-sm-7">
                    <input type="text" hidden id="cod_telefono" name="cod_telefono" class="form-control" readonly=""
                    value="{{$actualizarpersona->cod_correo}}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Correo</label>
                 <div class="col-sm-7">
                    <input type="email" id="Correo" name="Correo" class="form-control" 
                    placeholder="Ingrese el correo" value="{{$actualizarpersona->correo}}">
                </div>
                @if ($errors->has('Correo'))
                    <div               
                        id="Correo-error"                               
                        class="error text-danger pl-3"
                        for="Correo"
                        style="display: block;">
                        <strong>{{$errors->first('Correo')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Departamento ID</label>
                <select class="col-sm-7" class="form-control" id="Departamento" name="Departamento">
                    <option selected value="{{$actualizarpersona->departamento_id}}">{{$actualizarpersona->departamento_id}}</option>
                    <option>01/Atlántida</option>
                    <option>02/Colón</option>
                    <option>03/Comayagua</option>
                    <option>04/Copán</option>
                    <option>05/Cortés</option>
                    <option>06/Choluteca</option>
                    <option>07/El Paraíso</option>
                    <option>08/Francisco Morazán</option>
                    <option>09/Gracias a Dios</option>
                    <option>10/Intibucá</option>
                    <option>11/Islas de la Bahía</option>
                    <option>12/La Paz</option>
                    <option>13/Lempira</option>
                    <option>14/Ocotepeque</option>
                    <option>15/Olancho</option>
                    <option>16/Santa Bárbara</option>
                    <option>17/Valle</option>
                    <option>18/Yoro</option>
                </select>
                @if ($errors->has('Departamento'))
                    <div     
                        id="Departamento-error"                                          
                        class="error text-danger pl-3"
                        for="Departamento"
                        style="display: block;">
                        <strong>{{$errors->first('Departamento')}}</strong>
                    </div>
                @endif
            </div>

            <div  class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Municipio ID</label>
                <select class="col-sm-7" class="form-control" id="Municipio" name="Municipio">
                    <option selected value="{{$actualizarpersona->municipio_id}}">{{$actualizarpersona->municipio_id}}</option>
                    <option>01/0101/La Ceiba</option>
                    <option>01/0102/El Porvenir</option>
                    <option>01/0103/Esparta</option>
                    <option>01/0104/Jutiapa</option>
                    <option>01/0105/La Masica</option>
                    <option>01/0106/San Francisco</option>
                    <option>01/0107/Tela</option>
                    <option>01/0108/Arizona</option>
                    <option>02/0201/Trujillo</option>
                    <option>02/0202/Balfate</option>
                    <option>02/0203/Iriona</option>
                    <option>02/0204/Limón</option>
                    <option>02/0205/Sabá</option>
                    <option>02/0206/Santa Fe</option>
                    <option>02/0207/Santa Rosa de Aguán</option>
                    <option>02/0208/Sonaguera</option>
                    <option>02/0209/Tocoa</option>
                    <option>02/0210/Bonito Orienta</option>l
                    <option>03/0301/Comayagua</option>
                    <option>03/0302/Ajuterique</option>
                    <option>03/0303/El Rosario</option>
                    <option>03/0304/Esquías</option>
                    <option>03/0305/Humuya</option>
                    <option>03/0306/La Libertad</option>
                    <option>03/0307/Lamaní</option>
                    <option>03/0308/La Trinidad</option>
                    <option>03/0309/Lejamaní</option>
                    <option>03/0310/Meámbar</option>
                    <option>03/0311/Minas de Oro</option>
                    <option>03/0312/Ojos de Agua</option>
                    <option>03/0313/San Jerónimo</option>
                    <option>03/0314/San José de Comayagua</option>
                    <option>03/0315/San José del Potrero</option>
                    <option>03/0316/San Luis</option>
                    <option>03/0317/San Sebastián</option>
                    <option>03/0318/Siguatepeque</option>
                    <option>03/0319/Villa de San Antonio</option>
                    <option>03/0320/Las Lajas</option>
                    <option>03/0321/Taulabé</option>
                    <option>04/0401/Santa Rosa de Copán</option>
                    <option>04/0402/Cabañas</option>
                    <option>04/0403/Concepción</option>
                    <option>04/0404/Copán Ruinas</option>
                    <option>04/0405/Corquín</option>
                    <option>04/0406/Cucuyagua</option>
                    <option>04/0407/Dolores</option>
                    <option>04/0408/Dulce Nombre</option>
                    <option>04/0409/El Paraíso</option>
                    <option>04/0410/Florida</option>
                    <option>04/0411/La Jigua</option>
                    <option>04/0412/La Unión</option>
                    <option>04/0413/Nueva Arcadia</option>
                    <option>04/0414/San Agustín</option>
                    <option>04/0415/San Antonio</option>
                    <option>04/0416/San Jerónimo</option>
                    <option>04/0417/San José</option>
                    <option>04/0418/San Juan de Opoa</option>
                    <option>04/0419/San Nicolás</option>
                    <option>04/0420/San Pedro</option>
                    <option>04/0421/Santa Rita</option>
                    <option>04/0422/Trinidad de Copán</option>
                    <option>04/0423/Veracruz</option>
                    <option>05/0501/San Pedro Sula</option>
                    <option>05/0502/Choloma</option>
                    <option>05/0503/Omoa</option>
                    <option>05/0504/Pimienta</option>
                    <option>05/0505/Potrerillos</option>
                    <option>05/0506/Puerto Cortés</option>
                    <option>05/0507/San Antonio de Cortés</option>
                    <option>05/0508/San Francisco de Yojoa</option>
                    <option>05/0509/San Manuel</option>
                    <option>05/0510/Santa Cruz de Yojoa</option>
                    <option>05/0511/Villanueva</option>
                    <option>05/0512/La Lima</option>
                    <option>06/0601/Choluteca</option>
                    <option>06/0602/Apacilagua</option>
                    <option>06/0603/Concepción de María</option>
                    <option>06/0604/Duyure</option>
                    <option>06/0605/El Corpus</option>
                    <option>06/0606/El Triunfo</option>
                    <option>06/0607/Marcovia</option>
                    <option>06/0608/Morolica</option>
                    <option>06/0609/Namasigüe</option>
                    <option>06/0610/Orocuina</option>
                    <option>06/0611/Pespire</option>
                    <option>06/0612/San Antonio de Flores</option>
                    <option>06/0613/San Isidro</option>
                    <option>06/0614/San José</option>
                    <option>06/0615/San Marcos de Colón</option>
                    <option>06/0616/Santa Ana de Yusguare</option>
                    <option>07/0701/Yuscarán</option>
                    <option>07/0702/Alauca</option>
                    <option>07/0703/Danlí</option>
                    <option>07/0704/El Paraíso</option>
                    <option>07/0705/Güinope</option>
                    <option>07/0706/Jacaleapa</option>
                    <option>07/0707/Liure</option>
                    <option>07/0708/Morocelí</option>
                    <option>07/0709/Oropolí</option>
                    <option>07/0710/Potrerillos</option>
                    <option>07/0711/San Antonio de Flores</option>
                    <option>07/0712/San Lucas</option>
                    <option>07/0713/San Matías</option>
                    <option>07/0714/Soledad</option>
                    <option>07/0715/Teupasenti</option>
                    <option>07/0716/Texiguat</option>
                    <option>07/0717/Vado Ancho</option>
                    <option>07/0718/Yauyupe</option>
                    <option>07/0719/Trojes</option>
                    <option>08/0801/Tegucigalpa (D.C.)</option>
                    <option>08/0802/Alubarén</option>
                    <option>08/0803/Cedros</option>
                    <option>08/0804/Curarén</option>
                    <option>08/0805/El Porvenir</option>
                    <option>08/0806/Guaimaca</option>
                    <option>08/0807/La Libertad</option>
                    <option>08/0808/La Venta</option>
                    <option>08/0809/Lepaterique</option>
                    <option>08/0810/Maraita</option>
                    <option>08/0811/Marale</option>
                    <option>08/0812/Nueva Armenia</option>
                    <option>08/0813/Ojojona</option>
                    <option>08/0814/Orica(Francisco Morazán)</option>
                    <option>08/0815/Reitoca</option>
                    <option>08/0816/Sabanagrande</option>
                    <option>08/0817/San Antonio de Oriente</option>
                    <option>08/0818/San Buenaventura</option>
                    <option>08/0819/San Ignacio</option>
                    <option>08/0820/San Juan de Flores (Cantarranas)</option>
                    <option>08/0821/San Miguelito</option>
                    <option>08/0822/Santa Ana</option>
                    <option>08/0823/Santa Lucía</option>
                    <option>08/0824/Talanga</option>
                    <option>08/0825/Tatumbla</option>
                    <option>08/0826/Valle de Ángeles</option>
                    <option>08/0827/Villa de San Francisco</option>
                    <option>08/0828/Vallecillo</option>
                    <option>09/0901/Puerto Lempira</option>
                    <option>09/0902/Brus Laguna</option>
                    <option>09/0903/Ahuas</option>
                    <option>09/0904/Juan Francisco Bulnes</option>
                    <option>09/0905/Ramón Villeda Morales</option>
                    <option>09/0906/Wampusirpe</option>
                    <option>10/1001/La Esperanza</option>
                    <option>10/1002/Camasca</option>
                    <option>10/1003/Colomoncagua</option>
                    <option>10/1004/Concepción</option>
                    <option>10/1005/Dolores</option>
                    <option>10/1006/Intibucá</option>
                    <option>10/1007/Jesús de Otoro</option>
                    <option>10/1008/Magdalena</option>
                    <option>10/1009/Masaguara</option>
                    <option>10/1010/San Antonio</option>
                    <option>10/1011/San Isidro</option>
                    <option>10/1012/San Juan</option>
                    <option>10/1013/San Marcos de la Sierra</option>
                    <option>10/1014/San Miguel Guancapla</option>
                    <option>10/1015/Santa Lucía</option>
                    <option>10/1016/Yamaranguila</option>
                    <option>10/1017/San Francisco de Opalaca</option>
                    <option>11/1101/Roatán</option>
                    <option>11/1102/Guanaja</option>
                    <option>11/1103/José Santos Guardiola</option>
                    <option>11/1104/Utila</option>
                    <option>12/1201/La Paz</option>
                    <option>12/1202/Aguanqueterique</option>
                    <option>12/1203/Cabañas</option>
                    <option>12/1204/Cane</option>
                    <option>12/1205/Chinacla</option>
                    <option>12/1206/Guajiquiro</option>
                    <option>12/1207/Lauterique</option>
                    <option>12/1208/Marcala</option>
                    <option>12/1209/Mercedes de Oriente</option>
                    <option>12/1210/Opatoro</option>
                    <option>12/1211/San Antonio del Norte</option>
                    <option>12/1212/San José</option>
                    <option>12/1213/San Juan</option>
                    <option>12/1214/San Pedro de Tutule</option>
                    <option>12/1215/Santa Ana</option>
                    <option>12/1216/Santa Elena</option>
                    <option>12/1217/Santa María</option>
                    <option>12/1218/Santiago de Puringla</option>
                    <option>12/1219/Yarula</option>
                    <option>13/1301/Gracias</option>
                    <option>13/1302/Belén</option>
                    <option>13/1303/Candelaria</option>
                    <option>13/1304/Cololaca</option>
                    <option>13/1305/Erandique</option>
                    <option>13/1306/Gualcince</option>
                    <option>13/1307/Guarita</option>
                    <option>13/1308/La Campa</option>
                    <option>13/1309/La Iguala</option>
                    <option>13/1310/Las Flores</option>
                    <option>13/1311/La Unión</option>
                    <option>13/1312/La Virtud</option>
                    <option>13/1313/Lepaera</option>
                    <option>13/1314/Mapulaca</option>
                    <option>13/1315/Piraera</option>
                    <option>13/1316/San Andrés</option>
                    <option>13/1317/San Francisco</option>
                    <option>13/1318/San Juan Guarita</option>
                    <option>13/1319/San Manuel Colohete</option>
                    <option>13/1320/San Rafael</option>
                    <option>13/1321/San Sebastián</option>
                    <option>13/1322/Santa Cruz</option>
                    <option>13/1323/Talgua</option>
                    <option>13/1324/Tambla</option>
                    <option>13/1325/Tomalá</option>
                    <option>13/1326/Valladolid</option>
                    <option>13/1327/Virginia</option>
                    <option>13/1328/San Marcos de Caiquín</option>
                    <option>14/1401/Nueva Ocotepeque</option>
                    <option>14/1402/Belén Gualcho</option>
                    <option>14/1403/Concepción</option>
                    <option>14/1404/Dolores Merendón</option>
                    <option>14/1405/Fraternidad</option>
                    <option>14/1406/La Encarnación</option>
                    <option>14/1407/La Labor</option>
                    <option>14/1408/Lucerna</option>
                    <option>14/1409/Mercedes</option>
                    <option>14/1410/San Fernando</option>
                    <option>14/1411/San Francisco del Valle</option>
                    <option>14/1412/San Jorge</option>
                    <option>14/1413/San Marcos</option>
                    <option>14/1414/Santa Fe</option>
                    <option>14/1415/Sensenti</option>
                    <option>14/1416/Sinuapa</option>
                    <option>15/1501/Juticalpa</option>
                    <option>15/1502/Campamento</option>
                    <option>15/1503/Catacamas</option>
                    <option>15/1504/Concordia</option>
                    <option>15/1505/Dulce Nombre de Culmí</option>
                    <option>15/1506/El Rosario</option>
                    <option>15/1507/Esquipulas del Norte</option>
                    <option>15/1508/Gualaco</option>
                    <option>15/1509/Guarizama</option>
                    <option>15/1510/Guata</option>
                    <option>15/1511/Guayape</option>
                    <option>15/1512/Jano</option>
                    <option>15/1513/La Unión</option>
                    <option>15/1514/Mangulile</option>
                    <option>15/1515/Manto</option>
                    <option>15/1516/Salamá</option>
                    <option>15/1517/San Esteban</option>
                    <option>15/1518/San Francisco de Becerra</option>
                    <option>15/1519/San Francisco de la Paz</option>
                    <option>15/1520/Santa María del Real</option>
                    <option>15/1521/Silca</option>
                    <option>15/1522/Yocón</option>
                    <option>15/1523/Patuca</option>
                    <option>16/1601/Santa Bárbara</option>
                    <option>16/1602/Arada</option>
                    <option>16/1603/Atima</option>
                    <option>16/1604/Azacualpa</option>
                    <option>16/1605/Ceguaca</option>
                    <option>16/1606/San José de las Colinas</option>
                    <option>16/1607/Concepción del Norte</option>
                    <option>16/1608/Concepción del Sur</option>
                    <option>16/1609/Chinda</option>
                    <option>16/1610/El Níspero</option>
                    <option>16/1611/Gualala</option>
                    <option>16/1612/Ilama</option>
                    <option>16/1613/Macuelizo</option>
                    <option>16/1614/Naranjito</option>
                    <option>16/1615/Nuevo Celilac</option>
                    <option>16/1616/Petoa</option>
                    <option>16/1617/Protección</option>
                    <option>16/1618/Quimistán</option>
                    <option>16/1619/San Francisco de Ojuera</option>
                    <option>16/1620/San Luis</option>
                    <option>16/1621/San Marcos</option>
                    <option>16/1622/San Nicolás</option>
                    <option>16/1623/San Pedro Zacapa</option>
                    <option>16/1624/Santa Rita</option>
                    <option>16/1625/San Vicente Centenario</option>
                    <option>16/1626/Trinidad</option>
                    <option>16/1627/Las Vegas</option>
                    <option>16/1628/Nueva Frontera</option>
                    <option>17/1701/Alianza</option>
                    <option>17/1702/Amapala</option>
                    <option>17/1703/Aramecina</option>
                    <option>17/1704/Caridad</option>
                    <option>17/1705/Goascorán</option>
                    <option>17/1706/Langue</option>
                    <option>17/1707/Nacaome</option>
                    <option>17/1708/San Francisco de Coray</option>
                    <option>17/1709/San Lorenzo</option>
                    <option>18/1801/Yoro</option>
                    <option>18/1802/Arenal</option>
                    <option>18/1803/El Negrito</option>
                    <option>18/1804/El Progreso</option>
                    <option>18/1805/Jocón</option>
                    <option>18/1806/Morazán</option>
                    <option>18/1807/Olanchito</option>
                    <option>18/1808/Santa Rita</option>
                    <option>18/1809/Sulaco</option>
                    <option>18/1810/Victoria</option>
                    <option>18/1811/Yorito</option>
                </select>
                @if ($errors->has('Municipio'))
                    <div     
                        id="Municipio-error"                                          
                        class="error text-danger pl-3"
                        for="Municipio"
                        style="display: block;">
                        <strong>{{$errors->first('Municipio')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row mb-3">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Referencia Direccion</label>
                 <div class="col-sm-7">
                    <textarea type="text" id="direccion" name="direccion" class="form-control" maxlength="200" rows="10" cols="40"
                    onkeyup="capitalizarPrimeraLetradireccion()" placeholder="Ingrese la referncia de la direccion" 
                    value="{{$actualizarpersona->ref_direccion}}">{{$actualizarpersona->ref_direccion}}</textarea>
                </div>
                @if ($errors->has('direccion'))
                    <div               
                        id="direccion-error"                               
                        class="error text-danger pl-3"
                        for="direccion"
                        style="display: block;">
                        <strong>{{$errors->first('direccion')}}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-12 mb-2">
                    <a href="{{route('personas.index')}}"
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
    var input = document.getElementById('Nombre');
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

    var input2 = document.getElementById('Nombre2');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetranombre2() {
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

    var input3 = document.getElementById('Apellido');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetraapellido() {
    //almacenamos el valor del input
    var palabra = input3.value;
    //Si el valor es nulo o undefined salimos
    if(!input3.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input3.value = mayuscula.concat(minuscula);
    }

    var input4 = document.getElementById('Apellido2');
    //función que capitaliza la primera letra
    function capitalizarPrimeraLetraapellido2() {
    //almacenamos el valor del input
    var palabra = input4.value;
    //Si el valor es nulo o undefined salimos
    if(!input4.value) return;
    // almacenamos la mayuscula
    var mayuscula = palabra.substring(0,1).toUpperCase();
    //si la palabra tiene más de una letra almacenamos las minúsculas
    if (palabra.length > 0) {
        var minuscula = palabra.substring(1).toLowerCase();
    }
    //escribimos la palabra con la primera letra mayuscula
    input4.value = mayuscula.concat(minuscula);
    }
</script>

<script>
    window.onload = function() {
        var myInput = document.getElementById('Nombre');
        var myInput2 = document.getElementById('Nombre2');
        var myInput3 = document.getElementById('Apellido');
        var myInput4 = document.getElementById('Apellido2');

        //ONPASTE
        myInput.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput2.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput3.onpaste = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput4.onpaste = function(e) {
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

        myInput3.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }

        myInput4.oncopy = function(e) {
            e.preventDefault();
            alert("esta acción está prohibida");
        }
    }
</script> 
@stop