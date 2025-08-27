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


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-auto">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('clientes')}}" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                               Agregar cliente
                        </h3>
                    </div>
                </div>

               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
               
                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Nombre del cliente</label>
                        <input type="text"  class="letrasyn form-control form-control-sm campo" id="empresa">
                    </div>
                    <div class="col-md-4">
                        <label>Nombre del Subcliente</label>
                        <input type="text" name="sede" class="letrasyn form-control form-control-sm campo" id="sede">

                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <br>
                        <button class="btn addother"> <i class="fas fa-plus"></i> Añadir otro</button>
                    </div>
                </div>

                <br><br>

                <table class="table">
                   <thead>
                       <tr>
                           <th></th>
                           <th>Cliente</th>
                           <th>Sede</th>
                       </tr>
                   </thead>
                   <tbody id="clienteTable">
                        
                    
                   </tbody>
               </table>

                <br>
                <br>
               <div id="alerts2"></div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            Guardar <span class="spinner-border spinner-border-sm" style="display:none;"></span>
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
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/js/sanna/clientes/nuevo.js') }}" type="text/javascript"></script> 
@endpush