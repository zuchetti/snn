@extends('layout.navbar')
@push('css')
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

@endpush
@section('content')
    <br>
    {{ csrf_field() }}


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
                    <a href="{{url('stockMedicamentos')}}" >
                        <i class="fas fa-angle-double-left"></i>
                    </a>
					<h3 class="kt-portlet__head-title" >
						Solicitud de reposición
					</h3>
				</div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
              
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Estado:</label>
                            </div>
                            <div class="kt-form__control">
                                <select class="form-control" name="estado"  id="estado">
                                    <option value="-1">Todos</option>
                                    <option value="0">Pendiente</option>
                                    <option value="1">Aprobado</option>
                                    <option value="2">desaprobado</option>
                                </select>
                            </div>
                          
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Fecha Inicio:</label>
                            </div>
                            <div class="input-group date">
                                <input type="text" class="form-control" placeholder="Fecha" id="kt_datetimepicker_ini" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="kt-form__group kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Fecha Fin:</label>
                            </div>
                            <div class="input-group date">
                                <input type="text" class="form-control" placeholder="Fecha" id="kt_datetimepicker_fin" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-right">
                        <br>
                        <a href="{{url('solicitudMedicament')}}" class="btn" id="botonGlobal"><i class="fas fa-plus"></i> Nueva solicitud</a>
                    </div>
                                      
                </div>


                <br><br>
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
            <!-------END BODY----------------->

        </div>
    </div>
    <br>

@endsection

@push('scripts')
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>

	<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>


    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('/assets/js/stockMedicamentos/reposicion.js') }}"></script>

@endpush


