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

    <input type="hidden" id="idgrupo" value="{{$idgrupo}}">
    <input type="hidden" id="nombre" value="{{$nombre}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->
		
            <div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-4">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('medicamentos')}}" >

                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            {{$nombre}}
                        </h3>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <button nombre="{{$nombre}}" idgrupo="{{$idgrupo}}" class="btn" id="boton3"><i class="fas fa-plus"></i> Agregar medicamento a Grupo </button> 
                </div>
			</div>
           

             <!-------BODY----------------->
             <div class="kt-portlet__body">
               
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
                                <option value="150">150</option>
                                <option value="300">300</option>
                                <option value="450">450</option>
                                <option value="650">650</option>
                                <option value="800">800</option>
                           </select>
                       </div>
                   </div>

               </div>
           </div>

           <!-------end body----------------->


        </div>
    </div>


    <input type="hidden"  id="idgrupoitem">

    @include('components.modalConfirm')


@endsection
@push('scripts')
<script src="{{ asset('assets/js/sanna/medicamentos/detalleGrupo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush