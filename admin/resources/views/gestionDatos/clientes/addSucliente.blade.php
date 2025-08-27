@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/bootstrap-select.min.css')}}" rel="stylesheet" />
@endpush
@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp
    {{ csrf_field() }}

    <input type="hidden" id="idempresa" value="{{$idempresa}}">
    <input type="hidden" id="empresa" value="{{$empresa}}">

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-4">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                             Añadir subcliente a   {{$empresa}}
                        </h3>
                    </div>
                </div>
               
              
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">


                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">
                        <label>Ingrese el nombre de la sede</label>
                        <input type="text" id="sede" class="letrasyn form-control form-control-sm campo">
                    </div>
                   
                    <div class="col-lg-4 col-sm-4">
                        <br>
                        <button class="btn addSede"> <i class="fas fa-plus"></i> Añadir</button>
                    </div>

                </div>
                <br>

                <table class="table ">
                   <thead>
                       <tr>
                            <th></th>
                           <th>Cliente</th>
                           <th>Sede</th>
                       </tr>
                   </thead>
                   <tbody id="sedes">
                        
                    
                   </tbody>
               </table>


               <br><br>
               <div id="alerts2"></div>
                <br>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                           Guardar  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </div>
               
             
            </div>

            <!-------end body----------------->


        </div>
    </div>



@endsection

@push('scripts')
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/js/sanna/clientes/addSucliente.js') }}" type="text/javascript"></script> 
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
@endpush