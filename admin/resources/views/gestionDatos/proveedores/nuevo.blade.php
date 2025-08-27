@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/sanna/medicamentos/medicamentos.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/bootstrap-select.min.css')}}" rel="stylesheet" />

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
                        <a href="{{url('proveedores')}}" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Nuevo proveedor
                        </h3>
                    </div>
                </div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>RUC</label>
                        <input type="text" onkeypress="return valideKey(event);" class="form-control form-control-sm campo" id="ruc">
                    
                        <label>Razón social</label>
                        <input type="text" class="form-control form-control-sm campo" id="razon_social">
                        
                        <label>Nombre de contacto</label>
                        <input type="text"  class="letrasyn form-control form-control-sm campo" id="contacto">

                        
                    </div>
                    <div class="col-md-4">

                     
                        <label>Correo de contacto</label>
                        <input type="email" class="form-control form-control-sm campo" id="email_contacto">
                       
                        <label>Telefono de contacto</label>
                        <input type="text" onkeypress="return valideKey(event);" maxlength=11 class="form-control form-control-sm campo" id="telf_contacto">
                       

                        <label>Concepto PL relacionado</label>
                        <select id="concepto_pl" multiple data-live-search="true" class="input selectpicker form-control ">
                            <option value=""></option>
                            @foreach($info->data as $item)
                            <option value="{{$item->value}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                       


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
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{asset('assets/js/sanna/proveedores/nuevo.js') }}" type="text/javascript"></script> 
@endpush