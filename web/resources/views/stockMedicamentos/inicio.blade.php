@extends('layout.navbar')
@push('css')
<link href="{{ asset('assets/css/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/dashboard/dashboard.css')}}" rel="stylesheet">
@endpush
@section('content')
    <br>
    {{ csrf_field() }}


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
                    <a href="{{url('dashboard')}}" >
                        <i class="fas fa-angle-double-left"></i>
                    </a>
					<h3 class="kt-portlet__head-title" >
						Stock medicamentos
					</h3>
				</div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-form-label col-lg-10 col-sm-10">Buscar por nombre o Código</label>
                        <div class="input-group">
                            <input id="generalSearch" type="text" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn search" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 text-right">
                        <label class="col-form-label col-lg-10 col-sm-10"></label>

                        <a href="{{url('reposicionMedicamentos')}}" class="btn" id="botonGlobal"><i class="fas fa-border-all"></i> Gestionar reposición de stock</a>
                    </div>
                                      
                </div>
                <br>

               
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
                                <option value="400">400</option>
                                <option value="500">500</option>
                                <option value="600">600</option>
                                <option value="700">700</option>
                                <option value="800">800</option>
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
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/assets/js/stockMedicamentos/inicio.js') }}"></script>

@endpush


