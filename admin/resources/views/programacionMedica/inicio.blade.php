@extends('layout.app')
@section('title', 'Programación Médica')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='programacionmedica';
    @endphp
    {{ csrf_field() }}

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
                   
					<h3 class="kt-portlet__head-title" >
                        Programación médica
					</h3>
				</div>
               
			</div>
            
             <!-------BODY----------------->
             <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-form-label col-lg-10 col-sm-10">Buscar por nombre Topico</label>
                        <div class="input-group">
                            <input id="generalSearch" type="text" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn search" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                        <br>
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Estado:</label>
                            </div>
                            <div class="kt-form__control">
                                <select class="form-control bootstrap-select"  id="kt_form_type">
                                    <option value="-1">Todos</option>
                                    
                                    <option value="0">Nuevo</option>
                                    <option value="1">Incompleto</option>
                                    <option value="2">Completo</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                  <!--   <div class="col-md-4">
                        <label class="col-form-label col-lg-10 col-sm-10"  >Fecha inicio</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <div class="input-group date">
                                <input type="text" class="form-control" placeholder="Select date" id="kt_datetimepicker_ini" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label col-lg-10 col-sm-10">Fecha fin</label>
                        <div class="col-lg-10 col-md-10 col-sm-10">
                            <div class="input-group date">
                                <input type="text" class="form-control" placeholder="Select date" id="kt_datetimepicker_fin" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <br>

                <div id="alerts"></div>

               
                <div class="kt-datatable" id="ajax_data"></div>
    
                <div class="row">
                    <div class="col-md-10">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center" id="paginas">                                          
                            </ul>
                        </nav>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" id="petxpag">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <!-------end BODY----------------->


        </div>
    </div>



@endsection

@push('scripts')
    <script src="{{asset('assets/js/sanna/programacionMedica/inicio.js') }}" type="text/javascript"></script> 
    
@endpush