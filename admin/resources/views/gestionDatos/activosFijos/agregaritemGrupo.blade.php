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
                <div class="col-md-4">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)" >
                        <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                             {{$nombre}}
                        </h3>
                    </div>
                </div>
                
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <div id="alerts"></div>
      

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">
                        <label>Seleccione el activo fijo</label>

                        <select id="idactivofijo" multiple data-live-search="true" class="input selectpicker form-control ">
                            @foreach($activosFijos->data as $item)
                            <option value="{{$item->idactivofijo}}">{{$item->marca}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-lg-4 col-sm-4">
                        <br>
                        <button class="btn addMedicament"> <i class="fas fa-plus"></i> Añadir </button>
                    </div>
                </div>
                <br>

                <table class="table ">
                   <thead>
                       <tr>
                            <th></th>
                           <th>MARCA</th>
                           <th>MODELO</th>
                           <th>SERIE</th>
                           <th>PRECIO</th>
                       </tr>
                   </thead>
                   <tbody id="activosTable">
                        
                    
                   </tbody>
               </table>

            </div>

            

            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-5">
                    <button class="btn aggitem" idgrupo="{{$idgrupo}}" nombre="{{$nombre}}" id="boton">
                        Agregar a grupo  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                    </button>
                </div>
            </div>
            <br><br>

            <!-------end body----------------->


        </div>
    </div>


@endsection

@push('scripts')
<script src="{{ asset('assets/js/sanna/activosFijos/nuevoGrupo.js') }}" type="text/javascript"></script>
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush