@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/sanna/medicamentos/medicamentos.css')}}" rel="stylesheet">

@endpush
@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp
    {{ csrf_field() }}

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('topicos')}}" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                           {{$nombre}}
                        </h3>
                    </div>
                </div>
                
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-8">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a href="{{url('detalleTopico')}}?idtopico={{$idtopico}}&nombre={{$nombre}}">Detalle</a></li>
                                <li class="breadcrumb-item active"><a href="{{url('editTopico')}}?idtopico={{$idtopico}}">Editar</a></li>
                                <li class="breadcrumb-item"><a href="{{url('aggGrupoMedicamentTopico')}}?idbotiquin={{$idbotiquin}}&idtopico={{$idtopico}}&nombre={{$nombre}}">Grupo Medicamentos</a></li>
                                <li class="breadcrumb-item"><a href="{{url('aggGrupoExamenILtopico')}}?idbotiquin={{$idbotiquin}}&idtopico={{$idtopico}}&nombre={{$nombre}}">Grupo Examenes</a></li>
                                <li class="breadcrumb-item"><a href="{{url('aggGrupoDiagnosticoTopico')}}?idbotiquin={{$idbotiquin}}&idtopico={{$idtopico}}&nombre={{$nombre}}">Grupo Diagnóstico</a></li>
                                <li class="breadcrumb-item"><a href="{{url('calendario_horariotopico')}}?idtopico={{$idtopico}}">Horarios</a></li>

                            </ol>
                        </nav>
                    </div>
                </div>
                <br><br>
                <!--table1----------->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Cliente</th>
                            <th scope="col">Pais</th>
                            <th scope="col">Provincia</th>
                            <th scope="col">Distrito</th>
                            <th scope="col">Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$info->data[0]->empresa}}</td>
                            <td>{{$info->data[0]->pais}}</td>
                            <td>{{$info->data[0]->departamento}}</td>
                            <td>{{$info->data[0]->distrito}}</td>
                            <td>{{$info->data[0]->direccion}}</td>
                        </tr>
                    </tbody>
                </table>
                <br><br>

                <!------table2---------->
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Sede</th>
                            <th scope="col">Código CSO</th>
                            <th scope="col">Serv. de Botiquines ampliados</th>
                            <th scope="col">Código de almacen</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de apertura</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$info->data[0]->nombre}}</td>
                            <td>{{$info->data[0]->cod_cso}}</td>
                            <td>
                                @if($info->data[0]->botiquin_ampliado==0)
                                    No
                                @endif
                                @if($info->data[0]->botiquin_ampliado==1)
                                    Si
                                @endif
                            </td>
                            <td>{{$info->data[0]->cod_almacen}}</td>
                            <td>
                                @if($info->data[0]->estado==0)
                                    Activo
                                @endif
                                @if($info->data[0]->estado==1)
                                Inactivo
                                @endif
                                @if($info->data[0]->estado==2)
                                Suspendido
                                @endif
                                @if($info->data[0]->estado==3)
                                Cerrado
                                @endif
                            </td>
                            <td>{{$info->data[0]->fec_apertura}}</td>
                        </tr>
                    </tbody>
                </table>
                <br><br>


                <!------table3---------->
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Tipo seguro</th>
                            <th scope="col">Nombre Broker </th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$info->data[0]->aseguradora}}</td>
                            <td>{{$info->data[0]->broker}}</td>
                            <td>{{$info->data[0]->email_broker}}</td>
                            <td>{{$info->data[0]->tlf_broker}}</td>
                        </tr>
                    </tbody>
                </table>
                <br><br>

                <!------table3---------->
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nombre ejecutivo </th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$info->data[0]->ejecutivo}}</td>
                            <td>{{$info->data[0]->email_ejecutivo}}</td>
                            <td>{{$info->data[0]->tlf_ejecutivo}}</td>
                        </tr>
                    </tbody>
                </table>
                <br><br>

                <!------table3---------->
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nombre admin </th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$info->data[0]->admincuenta}}</td>
                            <td>{{$info->data[0]->email_admincuenta}}</td>
                            <td>{{$info->data[0]->tlf_admincuenta}}</td>
                        </tr>
                    </tbody>
                </table>
                <br><br>


                <!------table3---------->
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Profesión</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info->data[0]->profesiones as $key => $item)
                        <tr>
                            <td>{{$item->idtipoprofesional}}</td>
                            <td>{{$item->profesion}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br>


                <!------table3---------->
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Seguros</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info->data[0]->seguro as $item)
                        <tr>
                            <td>{{$item->idtiposeguro}}</td>
                            <td>{{$item->seguro}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br>

                <!------table3---------->
                <table class="table  table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Condición</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info->data[0]->condicion as $item)
                        <tr>
                            <td>{{$item->idtipocondicion}}</td>
                            <td>{{$item->condicion}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

              
            </div>


            <!-------end body----------------->


        </div>
    </div>



@endsection
