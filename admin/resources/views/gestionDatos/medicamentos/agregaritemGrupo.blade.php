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
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)" >
                        <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Grupo: {{$nombre}}
                        </h3>
                    </div>
                </div>
                
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">


                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">
                        <label>Seleccione el medicamento</label>

                        <select id="idmedicamento" data-live-search="true" class="input selectpicker form-control ">
                            @foreach($medicamentos->data as $item)
                            <option value="{{$item->idmedicamento}}">{{$item->producto}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <label>Ingrese la cantidad</label>

                        <div class="input-group">
                            <input type="number" min="1" id="cantidad" name="cantidad" class="form-control form-control-sm">
                        </div>
                        
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <br>
                        <button class="btn addMedicament"> <i class="fas fa-plus"></i> Añadir medicamento</button>
                    </div>
                </div>
                <br>

                <table class="table ">
                <thead>
                    <tr>
                      
                        <th>Nombre del medicamento</th>
                        <th>descripción</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody id="medicament">
                        
                    
                </tbody>
                </table>  
              
            </div>

            

            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-5">
                    <button class="btn agregarItem" idgrupo="{{$idgrupo}}" nombre="{{$nombre}}" id="boton">
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
<script src="{{asset('assets/js/sanna/medicamentos/nuevoGrupo.js') }}" type="text/javascript"></script> 
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush
