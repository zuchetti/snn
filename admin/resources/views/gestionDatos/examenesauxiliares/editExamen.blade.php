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

    <input type="hidden" id="idexamenauxiliar" value="{{$idexamenauxiliar}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->
			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Editar Examen
                        </h3>
                    </div>
                </div>
            </div>
            
            <!-------body----------------->

            <div class="kt-portlet__body">

                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Exámen</label>
                        <input type="text" value="{{$info->data[0]->examen}}" class="letrasyn form-control form-control-sm campo" id="examen">
                    </div>
                    <div class="col-md-4">
                        <label>Tipo</label>
                        <select class="form-control form-control-sm campo" id="tipo">
                                @if($info->data[0]->tipo==0)
                                <option value="0" selected>Imagen</option>
                                <option value="1">Laboratorio</option>

                                @endif
                                @if($info->data[0]->tipo==1)
                                <option value="1" selected>Laboratorio</option>
                                <option value="0">Imagen</option>
                                @endif
                             
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Precio unitario s/n IGV</label>
                        <input type="text"  value="{{$info->data[0]->precio}}" class="form-control form-control-sm campo decimales" maxlength=5 id="precio">

                       
                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            Actualizar <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </div>

            </div>

            <!-------end body----------------->


        </div>
    </div>


@endsection
@push('scripts')
<script src="{{ asset('assets/js/sanna/examenesauxiliares/editExamen.js') }}" type="text/javascript"></script>
@endpush