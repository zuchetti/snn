@extends('layout.navbar')
@push('css')
<link href="{{ asset('assets/css/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/dashboard/dashboard.css')}}" rel="stylesheet">
<style>
    .switch{
        display:table-cell;
    }
</style>
@endpush
@section('content')
    <br>
    {{ csrf_field() }}


    <input class="form-control" value="{{$dni}}" type="hidden" id="dni">
    <input class="form-control" value="{{$nombre}}" type="hidden" id="nombre">

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
                    <a href="javascript:history.back(1)" >
                        <i class="fas fa-angle-double-left"></i>
                    </a>
					<h3 class="kt-portlet__head-title" >
                        Historia Clínica de : {{$nombre}}
					</h3>
				</div>

              <div class="col-md text-right">
             <a dni="{{$dni}}" class="btn" id="descarga"><i class="far fa-list-alt"></i>Descargar Archivos</a>
            </div>  
               
			</div>                  
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label col-lg-10 col-sm-10">Buscar por nombre</label>
                        <div class="input-group">
                            <input id="generalSearch" type="text" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn search" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="col-form-label col-lg-10 col-sm-10">Fecha de atención</label>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/js/historiasClinicas/detalle.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush