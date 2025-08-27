@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/sanna/medicamentos/medicamentos.css')}}" rel="stylesheet">

@endpush
@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp
    {{ csrf_field() }}

    <input type="hidden" id="iddiagnostico" value="{{$iddiagnostico}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->
			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Editar diagnóstico : {{$diagnostico}}
                        </h3>
                    </div>
                </div>
            </div>
            
            <!-------body----------------->

            <div class="kt-portlet__body">

                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                       
                        <label>Diagnóstico</label>
                        <input type="text" value="{{$info->data[0]->diagnostico}}" class="letrasyn form-control form-control-sm campo" id="diagnostico">

                        <label>CIE 10</label>
                        <input type="text" value="{{$info->data[0]->cie10}}" class="form-control form-control-sm campo" id="cie10">

                    </div>
                   
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            actualizar <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </div>

            </div>

            <!-------end body----------------->


        </div>
    </div>




@endsection
@push('scripts')
<script src="{{ asset('assets/js/sanna/diagnostico/editar.js') }}" type="text/javascript"></script>
@endpush