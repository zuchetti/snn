@extends('layout.app')
@section('title', 'Programación Médica')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/global/select2.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

@endpush
@section('content')
    @php
        $page ='programacionmedica';
    @endphp
    {{ csrf_field() }}

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->
          

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
               
                    <div class="col-md-8">
                        <div class="kt-portlet__head-label">
                            <a href="javascript:history.back(1)" >
                                <i class="fas fa-angle-double-left"></i>
                            </a>

                            <h3 class="kt-portlet__head-title" >
                                Programación médica
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <button  class="btn" id="guardarhorario"> 
                            <i class="fas fa-save"></i>
                                Guardar Horario <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                            </button>
                    </div>

                     <div class="col-md-4 text-right">
                        <button  class="btn" id="repetir"> 
                            <i class="fas fa-redo"></i>
                                Repetir Programación de {{$messig}} <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                            </button>
                    </div>

                    
            <table class="table" id="especialidades">
            <thead align="center">
                <tr>
                    @foreach($especialidades as $item)
                    <th align="center">{{$item->profesion}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($especialidades as $item)
                    <td align="center">
                        <input type="checkbox" name="day[]" value="{{$item->idtipoprofesional}}" checked>
                    </td>
                    @endforeach
                   
                </tr>
            </tbody>
        </table>
               
			</div>
                   
    
            
             <!-------BODY----------------->
             <div class="kt-portlet__body">

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
		@include('components.calendar'); 
	</div>


    <input type="hidden" id="idtopico" value="{{$idtopico}}">
    <input type="hidden" id="fecha_ini" value="{{$fecha_ini}}">
    
    <div class="modal modal-stick-to-bottom fade" id="kt_modal_7" role="dialog" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="titulomodal">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar horario</h5>
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

                    <div class="form-group">
                        <label>Especialidad</label>
                        <br>
                        <div class="kt-radio-inline" id="especialidades_rb">
                            @foreach($especialidades as $item)
                            <label class="kt-radio">
                                <input type="radio" name="especialidades" value="{{$item->idtipoprofesional}}"> {{$item->profesion}}
                                <span></span>
                            </label>
                            @endforeach
                        </div>
                    </div>



                    <div id="buscadormodal">
                        <label>Buscar Médico Disponible:</label>
                       <!--  <input id="generalSearch" type="search"  class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                        <div id="resultados"  class="col-md-12" style="z-index:3; padding-left:0px;padding-right:0px; overflow-y: scroll;"></div> -->
                        <br>
                        <select id="generalSearch"  disabled class="form-control">
                        </select>

                        <div id="resultados"  class="col-md-12" ></div>
                        <br>
                        <button type="button" class="btn btn-secondary" id="buscador_profesional">Buscar</button>
                    
                    </div>
                    <br>
                    <div id="repetirbloque" class="checkbox-list">
                        <label class="checkbox">
                        <input type="checkbox" name="Checkboxes1" />
                        <span></span>Repetir bloque todo el mes</label>
                    </div>


                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="alerts"></div>
                    </div>
                </div>
                
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnmodal_agregar" class="btn btn-primary" >Agregar</button>
                </div>
            </div>
        </div>
    </div>

     <div class="modal modal-stick-to-bottom fade" id="kt_modal_3" role="dialog" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="titulomodal">
                    <h5 class="modal-title" id="exampleModalLabel">Repetir Programacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table" id="tablamodal">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Mes</th>
                                <th>Año</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="">Origen</td>
                                <td>
                                    <div class="kt-radio-inline" id="">
                                       <select class="form-control" id="mes_origen">
                                            <option value="01">Enero</option>
                                            <option value="02">Febrero</option>
                                            <option value="03">Marzo</option>
                                            <option value="04">Abril</option>
                                            <option value="05">Mayo</option>
                                            <option value="06">Junio</option>
                                            <option value="07">Julio</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Setiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>         
                                    </div>
                                
                                </td>
                                <td>
                                    <input type="text" id="anio_origen" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                                </td>
                            </tr>
                            <tr>
                                <td id="">Destino</td>
                                <td>
                                    <div class="kt-radio-inline" id="">
                                       <select class="form-control" id="mes_destino">
                                            <option value="01">Enero</option>
                                            <option value="02">Febrero</option>
                                            <option value="03">Marzo</option>
                                            <option value="04">Abril</option>
                                            <option value="05">Mayo</option>
                                            <option value="06">Junio</option>
                                            <option value="07">Julio</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Setiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>         
                                    </div>
                                
                                </td>
                                <td>
                                    <input type="text"  id="anio_destino" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="alerts4"></div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btmodal_repetir" class="btn btn-primary" >Realizar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal modal-stick-to-bottom fade" id="kt_modal_2" role="dialog" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="titulomodal">
                    <h5 class="modal-title" id="exampleModalLabel">Reemplazar Médico</h5>
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
                                        <input  disabled="disabled" type="time" dia="" id="hora_ini_reemplazo" name="hora_ini_reemplazo"  class="form-control form-control-sm">
                                    </div> 
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input  disabled="disabled" type="time" value="00:00 00" id="hora_fin_reemplazo"  dia="" name="hora_fin_reemplazo"  class="form-control form-control-sm">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                     <div class="form-group"> 
                        
                        <label>Médico actual</label>
                        <input type="text" id="nombremodal" class="form-control" disabled="disabled">
                        
                    </div>
                    <div class="form-group">
                        <label>Motivo de Reemplazo</label>
                        <br>
                        <div class="kt-radio-inline" id="motivo">
                            <label class="kt-radio">
                                <input type="radio" name="motivo" value="0"> Descanso médico
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="motivo"  value="1"> Vacaciones
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="motivo"   value="2"> Licencia
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="motivo"  value="3"> Permiso
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="motivo"  value="4"> Otros
                                <span></span>
                            </label>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label>Planilla</label>
                        <br>
                        <div class="kt-radio-inline" id="planilla">
                            @foreach($planilla->data as $item)
                            <label class="kt-radio">
                                <input type="radio" name="planilla" value="{{$item->idtipoplanilla}}"> {{$item->planilla}}
                                <span></span>
                            </label>
                            @endforeach
                                                      
                        </div>
                    </div>
                    <div class="form-group form-group-last">
                        <label for="exampleTextarea">Comentario</label>
                        <textarea class="form-control" id="comentario" rows="3"></textarea>
                    </div>
                    <br>
                    <div id="buscadormodal">
                        <label>Buscar Reemplazo:</label>
                        <input id="generalSearch_reemplazo" type="text" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                        <div id="disponibles"  class="col-md-12" style="z-index:3; padding-left:0px;padding-right:0px; overflow-y: scroll;"></div>

                    </div>


                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id="alerts2"></div>
                    </div>
                </div>
                
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnmodal_borrar" class="btn btn-danger" data-dismiss="modal">Borrar</button>
                    <button type="button" id="btnmodal_reemplazar" class="btn btn-primary">Reemplazar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('assets/js/jquery.js') }}"  type="text/javascript"></script>
    <script src="{{asset('assets/js/select2.min.js') }}" type="text/javascript"></script> 
    <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script> 
    <script src="{{asset('assets/plugins/custom/fullcalendar/locales/es.js') }}" type="text/javascript"></script> 
@endpushs