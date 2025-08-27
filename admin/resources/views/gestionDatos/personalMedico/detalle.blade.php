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

    <input type="hidden" id="idprofesional" value="{{$idprofesional}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('personalmedico')}}" >
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
                                <li class="breadcrumb-item active"><a href="{{url('editPersonalMedico')}}?idprofesional={{$idprofesional}}&nombre={{$nombre}}">Editar información</a></li>
                                <li class="breadcrumb-item"><a href="{{url('calendario_horariomedico')}}?idprofesional={{$idprofesional}}&nombre={{$nombre}}">Horario</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <br><br>

                <table class="table  table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"># documento</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Fech.Nacimiento</th>
                            <th scope="col">Profesión</th>
                            <th scope="col">Tarifa</th>
                            <th scope="col">Tlf.</th>
                            <th scope="col">Email.</th>
                            <th scope="col">Fech.Ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$info->data[0]->num_doc}}</td>
                            <td>{{$info->data[0]->nombres}} {{$info->data[0]->ape_paterno}} {{$info->data[0]->ape_materno}}</td>
                            <td>
                                @if($info->data[0]->sexo==0)
                                    M
                                @endif
                                @if($info->data[0]->sexo==1)
                                    F
                                @endif
                            </td>
                            <td>{{$info->data[0]->fec_nacimiento}}</td>
                            <td>{{$info->data[0]->profesion}}</td>

                            <td>S/ {{$info->data[0]->tarifa}}</td>
                            <td>{{$info->data[0]->telefono}}</td>
                            <td>{{$info->data[0]->email}}</td>
                            <td>{{$info->data[0]->fec_ingplanilla}}</td>


                        </tr>
                    </tbody>
                </table>


                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <label>firma</label>
                        </div>
                        @php $fr =  explode("adm_services",$info->data[0]->firma)   @endphp
                        @if(isset($fr[1]))
                        <img src="https://200.48.199.90:8002/sanna/adm_services{{$fr[1]}}" class="img-fluid">
                        @else
                        <img src="{{$info->data[0]->sello}}" class="img-fluid">
                        @endif

                    </div>
                    <div class="col-md-4">
                        <div>
                            <label>Sello</label>
                        </div>
                        <img src="{{$info->data[0]->sello}}" class="img-fluid">
                    </div>
                </div>
               
               

            </div>


            <!-------end body----------------->


        </div>
    </div>



@endsection
