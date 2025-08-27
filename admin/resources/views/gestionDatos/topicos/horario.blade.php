@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/sanna/medicamentos/medicamentos.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/progress-wizard.min.css')}}" rel="stylesheet" />

@endpush
@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp
    {{ csrf_field() }}

    <input type="hidden" id="idtopico" value="{{$idtopico}}">
    <input type="hidden" id="idbotiquin" value="{{$idbotiquin}}">

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                              Agregar horario de atención tópico
                        </h3>
                    </div>
                </div>
               
			</div>
            

            <!-------BODY----------------->
            <div class="kt-portlet__body">
               
                <ul class="progress-indicator">
                    
                    <li class="completed"> <span class="bubble"></span> Nuevo tópico</li>
        
                    <li class="completed"> <span class="bubble"> <span class="bubble"></span> Horario </li>
                    
                    <li> <span class="bubble"></span> Grupo medic / examen/ diagnóstico </li>
                
                
                </ul>
                <br>

                @php
                    $dias = array("1"=>"Lunes","2"=>"Martes","3"=>"Miércoles","4"=>"Jueves","5"=>"Viernes","6"=>"Sábado","7"=>"Domingo");
                @endphp
                @foreach($dias as $key => $value)
                 
                    <div class="row dias">
                        <div class="col-md-8">
                            <table class="table table-light">
                                <thead>
                                    <tr>
                                        <th>{{$value}}</th>
                                        <th>hora inicio</th>
                                        <th>hora fin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bloque 1</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="time" value="00:00" dia="{{$key}}" name="hora_ini"  class="form-control form-control-sm">
                                           
                                            </div>
                                        
                                        </td>
                                        <td>
                                           
                                            <div class="form-group">
                                                <input type="time" value="00:00" dia="{{$key}}" name="hora_fin"  class="form-control form-control-sm">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bloque 2</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="time" value="00:00" dia="{{$key}}" name="hora_ini"  class="form-control form-control-sm">

                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="time"  value="00:00" dia="{{$key}}" name="hora_fin"  class="form-control form-control-sm">

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          
                           
                        </div>
                      
                    </div>
                   
                   
                    
                @endforeach

                <br>
                <div id="alerts"></div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            siguiente <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </div>

            </div>

            <!-------end body----------------->


        </div>
    </div>

   

@endsection

@push('scripts')
    <script src="{{asset('assets/js/sanna/topicos/horario.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush