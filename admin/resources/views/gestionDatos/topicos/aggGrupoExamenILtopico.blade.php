@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/progress-wizard.min.css')}}" rel="stylesheet" />

@endpush
@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp
    {{ csrf_field() }}


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->
            <input type="hidden" id="idbotiquin" value="{{$idbotiquin}}">
			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-auto">
                    <div class="kt-portlet__head-label">
                    <a href="{{url('detalleTopico')}}?idtopico={{$idtopico}}&nombre={{$nombre}}&idbotiquin={{$idbotiquin}}">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                              Agregar  un grupo de Examen imagen / laboratorio  a tópico
                        </h3>
                    </div>
                </div>
                
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('aggGrupoExamenILtopico')}}?idtopico={{$idtopico}}&nombre={{$nombre}}&idbotiquin={{$idbotiquin}}">Agregar</a></li>
                        <li class="breadcrumb-item"><a href="{{url('allExamenesTopico')}}?idtopico={{$idtopico}}">Ver todos</a></li>

                    </ol>
                </nav>
                <br> 
               
                  <!--------examenes imagen------->

                  <h5 class="kt-portlet__head-title text-center" >
                    Seleccione el grupo de examenes Imagen
                </h5><br>


                <div id="alerts2"></div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">

                        <select id="idgrupoExamenI" multiple data-live-search="true" class="input selectpicker form-control ">
                                @foreach($groupexamenesI->data as $item)
                                <option value="{{$item->idgrupo}}">{{$item->nombre}}</option>
                                @endforeach
                        </select>
                    </div>
                        
                    <div class="col-lg-4 col-sm-4">
                       
                        <button class="btn addgroupExamenI"> <i class="fas fa-plus"></i> Añadir</button>
                    </div>
                </div>
                <br>
                
                <table class="table ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grupo de examen imagen</th>
                        <th>Examenes</th>
                    </tr>
                </thead>
                <tbody id="examenI">
                        
                    
                </tbody>
                </table> <br><br>
                <table class="table ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grupo de examen imagen asignados</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="examenID">
                    @foreach($grupos->data->imagen as $ig)
                    <tr>
                        <th></th>
                        <th>{{$ig->nombre}}</th>
                        <th><button onclick="deleteGrupoImagen({{$ig->idgrupo}},{{$ig->idtopico}})" class="bg-danger border-0 text-white rounded-3 py-2 px-3 small">Quitar</button></th>
                    </tr>
                    @endforeach
                </tbody>
                </table> <br><br>
                   
                <!--------examenes laboratorio------->
                <h5 class="kt-portlet__head-title text-center" >
                    Seleccione el grupo de examenes laboratorio
                </h5><br>

                <div id="alerts3"></div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">

                        <select id="idgrupoExamenL" data-live-search="true" multiple class="input selectpicker form-control ">
                                @foreach($groupexamenesL->data as $item)
                                <option value="{{$item->idgrupo}}">{{$item->nombre}}</option>
                                @endforeach
                        </select>
                    </div>
                        
                    <div class="col-lg-4 col-sm-4">
                       
                        <button class="btn addgroupExamenL"> <i class="fas fa-plus"></i> Añadir</button>
                    </div>
                </div>
                <br>
                
                <table class="table ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grupo de examen laboratorio</th>
                        <th>Examenes</th>
                    </tr>
                </thead>
                <tbody id="examenL">
                        
                    
                </tbody>
                </table><br><br>
                <table class="table ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grupo de examen laboratorio asignados</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="examenID">
                    @foreach($grupos->data->laboratorio as $ig)
                    <tr>
                        <th></th>
                        <th>{{$ig->nombre}}</th>
                        <th><button onclick="deleteGrupoLaboratorio({{$ig->idgrupo}},{{$ig->idtopico}})" class="bg-danger border-0 text-white rounded-3 py-2 px-3 small">Quitar</button></th>
                    </tr>
                    @endforeach
                </tbody>
                </table> <br><br>

                <div id="alerts"></div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            Agregar <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </div>

            </div>

            <!-------end body----------------->


        </div>
    </div>

   

@endsection

@push('scripts')
    <script src="{{asset('assets/js/sanna/topicos/aggGrupoExamenILtopico.js') }}?ver=4.0" type="text/javascript"></script> 
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush


