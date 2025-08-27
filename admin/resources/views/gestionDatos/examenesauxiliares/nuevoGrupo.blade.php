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
                <div class="col-md-8">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)" >
                        <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Nuevo grupo de exámenes auxiliares
                        </h3>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{url('administrarExamen')}}" class="btn" id="boton3"><i class="far fa-list-alt"></i> Adminsitrar exámenes</a>
                </div>
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{url('nuevoGrupoExamen')}}">Examenes Laboratorio</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('nuevoGrupoExamenI')}}">Examenes Imagenes</a></li>
                    </ol>
                </nav>
                <br>

                <div id="alerts"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">
                        <label>Seleccione el examen de laboratorio</label>

                        <select id="idexamenauxiliar" data-live-search="true" multiple class="input selectpicker form-control ">
                            @foreach($getExamenLab->data as $item)
                            <option value="{{$item->idexamenauxiliar}}">{{$item->examen}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                    <div class="col-lg-4 col-sm-4">
                        <br>
                        <button class="btn addMedicament"> <i class="fas fa-plus"></i> Añadir examen</button>
                    </div>
                </div>
                <br>

               <table class="table ">
                   <thead>
                       <tr>
                            <th ></th>
                           <th>Nombre del examen Lab</th>
                           <th>precio</th>
                       </tr>
                   </thead>
                   <tbody id="examenLab">
                        
                    
                   </tbody>
               </table>

            </div>

            

            <div class="row justify-content-end">
                <div class="col-lg-4">
                    <div class="input-group">
                        <input type="text" id="nombregrupo" name="nombregrupo" class="form-control" placeholder="Nombre del grupo">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-5">
                    <button class="btn agregar" onclick="createGroup()" id="boton">
                        Crear grupo  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                    </button>
                </div>
            </div>
            <br><br>

            <!-------end body----------------->


        </div>
    </div>


@endsection


@push('scripts')
    <script src="{{asset('assets/js/sanna/examenesauxiliares/nuevoGrupo.js') }}" type="text/javascript"></script> 
    <script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush
