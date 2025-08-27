@extends('layout.app')
@section('title', 'Programación Horario Médico')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
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

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-6">
                        <div class="kt-portlet__head-label">
                            @if(!isset($new))
                            <a href="javascript:history.back(1)" >
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                            @endif

                            <h3 class="kt-portlet__head-title" >
                                Disponibilidad Tópico
                            </h3>
                        </div>
                </div>
                @if(isset($new))
                <input type="hidden" value="{{$new}}" id="new">
                <input type="hidden" value="{{$idbotiquin}}" id="idbotiquin">
                @endif
                <div class="col-md-3 text-right">
                    <button  class="btn" id="guardarhorario"> 
                        <i class="fas fa-save"></i>
                         Guardar Horario <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                    </button>
                </div>
				
			</div>
            
             <!-------BODY----------------->
             <div class="kt-portlet__body">

                @if(isset($new))

                    <ul class="progress-indicator">

                        <li class="completed"> <span class="bubble"></span> Nuevo tópico</li>

                        <li  class="completed"> <span class="bubble"></span> Horario </li>
                        
                        <li  > <span class="bubble"></span> Grupo medic / examen / diagnóstico </li>

                    </ul>
                <br>
                @endif


                <div id="alerts3"></div>


                <div class="card card-custom">
                  
                    <div class="card-body">
                        <div id="kt_calendar"></div>
                    </div>
                </div>

            </div>
            <!-------end BODY----------------->


        </div>
    </div>
    


	<div id="calendario">
		@include('components.calendar_horariotopico'); 
	</div>

  

    <input type="hidden" id="idtopico" value="{{$idtopico}}">
    <div class="modal modal-stick-to-bottom fade" id="kt_modal_7" role="dialog" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="titulomodal">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table" id="tablamodal">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>hora inicio</th>
                                <th>hora fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="fechamodal"></td>
                                <td>
                                    <div class="form-group">
                                        <input type="time" dia="" id="hora_ini" name="hora_ini"  class="form-control form-control-sm">
                                   
                                    </div>
                                
                                </td>
                                <td>
                                   
                                    <div class="form-group">
                                        <input type="time" value="00:00 00" id="hora_fin"  dia="" name="hora_fin"  class="form-control form-control-sm">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" id="dias">
                        <thead align="center">
                            <tr>
                                <th align="center">Lu</th>
                                <th align="center">Ma</th>
                                <th align="center">Mi</th>
                                <th align="center">Ju</th>
                                <th align="center">Vi</th>
                                <th align="center">Sa</th>
                                <th align="center">Do</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center">
                                    <input type="checkbox" name="day[]" value="1">
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="day[]" value="2">
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="day[]" value="3">
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="day[]" value="4">
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="day[]" value="5">
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="day[]" value="6">
                                </td>
                                <td align="center">
                                    <input type="checkbox" name="day[]" value="7">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div id="alerts"></div>
                    </div>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnmodal_agregar" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal modal-stick-to-bottom fade" id="kt_modal_2" role="dialog" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="titulomodal">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Horario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="tablamodal">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>hora inicio</th>
                                <th>hora fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="fecha_reemplazo"></td>
                                <td>
                                    <div class="form-group">
                                        <input  type="time" dia="" id="hora_ini_reemplazo" name="hora_ini_reemplazo"  class="form-control form-control-sm">
                                    </div> 
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input  type="time" value="00:00 00" id="hora_fin_reemplazo"  dia="" name="hora_fin_reemplazo"  class="form-control form-control-sm">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div id="alerts2"></div>
                        </div>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnmodal_borrar" class="btn btn-danger" data-dismiss="modal">Borrar</button>
                    <button type="button" id="btnmodal_editar" class="btn btn-primary">Guardar</button>
                    
                </div>
            </div>
        </div>
    </div>





@endsection

@push('scripts')


	<script src="{{ asset('assets/js/jquery.js') }}"  type="text/javascript"></script>
    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script> 
    <script src="{{asset('assets/plugins/custom/fullcalendar/locales/es.js') }}" type="text/javascript"></script> 

@endpushs