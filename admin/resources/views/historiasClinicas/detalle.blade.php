@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='historiasclinicas';
    @endphp
    {{ csrf_field() }}

    <input class="form-control" value="{{$dni}}" type="hidden" id="dni">

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row">
				<div class="kt-portlet__head-label col-md-6">
                    <a href="{{url('historiasclinicas')}}?idfuncionalidad=4">
                        <i class="fas fa-angle-double-left"></i>
                    </a>
					<h3 class="kt-portlet__head-title" >
                        Historia Clínica de : {{$nombre}}
					</h3>
				</div>
                <div class="t-portlet__head-label col-md-3 text-right" style="padding-top:15px">
                    <a href="https://200.48.199.90:8090/sanna/adm_services/public/api/downloadzip?dni={{$dni}}" class="btn bg-primary text-white py-3 d-block px-4 rounded-3" target="_blank"><i class="bi bi-filetype-pdf"></i>Descargar</a>
                    <br>
                </div>
                <div class="t-portlet__head-label col-md-3 text-right" style="padding-top:15px">
                    <a dni="{{$dni}}" class="btn" id="descarga"><i class="far fa-list-alt"></i>Descargar Archivos</a>
                    <br>
                </div>                    
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
                <div class="row">
                   <!--  <div class="col-md-5">
                        <label class="col-form-label col-lg-10 col-sm-10">Buscar por nombre</label>
                        <div class="input-group">
                            <input id="generalSearch" type="text" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn search" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
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
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                                <option value="500">500</option>
                               
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
    <script src="{{asset('assets/js/sanna/historiasClinicas/detalle.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush