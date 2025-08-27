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
                <div class="col-md-auto">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                               Agregar condición
                        </h3>
                    </div>
                </div>

               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
               
                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Nombre de la condición</label>
                        <input type="text" class="letrasyn form-control form-control-sm campo" id="condicion">
                
                    </div>
                </div>

                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            Agregar <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </div>
                
                
            </div>



            <!-------end body----------------->


        </div>
    </div>


@endsection

@push('scripts')
<script src="{{asset('assets/js/sanna/condiciones/nuevo.js') }}" type="text/javascript"></script> 
@endpush