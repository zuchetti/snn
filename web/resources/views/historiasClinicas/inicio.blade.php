@extends('layout.navbar')
@push('css')
<link href="{{ asset('assets/css/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/dashboard/dashboard.css')}}" rel="stylesheet">
<style>
    .datetimepicker td{
        width:35px !important;
    }
</style>
@endpush
@section('content')
    <br>
    {{ csrf_field() }}

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
                    <a href="javascript:history.back(1)" >
                        <i class="fas fa-angle-double-left"></i>
                    </a>
					<h3 class="kt-portlet__head-title" >
						Historias clínicas
					</h3>
				</div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label col-lg-10 col-sm-10">Buscar por nombre o documento de identidad</label>
                        <div class="input-group">
                            <input id="generalSearch" type="text" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn search" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
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
            <!-------END BODY----------------->

        </div>
    </div>
    <br>

@endsection
@push('scripts')
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('/assets/js/historiasClinicas/inicio.js') }}"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush


