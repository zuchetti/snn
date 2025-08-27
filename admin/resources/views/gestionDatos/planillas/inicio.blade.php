@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
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
                <div class="col-md-4">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('gestiondebasededatos')}}" >

                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                               Planillas
                        </h3>
                    </div>
                </div>

               <div class="col-md-4 text-right">
                    <a href="{{url('nuevaPlanilla')}}" class="btn" id="boton"> <i class="fas fa-fw fa-plus"></i> Agregar</a>
                </div>
            
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6">
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
                    <!-- <div class="col-md-4">
                        <label class="col-form-label col-lg-10 col-sm-10">Fecha creación</label>
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

            <!-------end body----------------->


        </div>
    </div>

    <input type="hidden"  id="idtipoplanilla">

    @include('components.modalConfirm')


@endsection

@push('scripts')
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/js/sanna/planillas/inicio.js') }}" type="text/javascript"></script> 
@endpush