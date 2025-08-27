
@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/progress-wizard.min.css')}}" rel="stylesheet" />

@endpush
@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp
    {{ csrf_field() }}

    <input type="hidden" value="{{$idtopico}}" id="idtopico">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->
            <input type="hidden" id="idbotiquin" value="{{$idbotiquin}}">
			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('detalleTopico')}}?idtopico={{$idtopico}}&nombre={{$nombre}}&idbotiquin={{$idbotiquin}}">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                              Agregar grupo de diagnósticos a tópico
                        </h3>
                    </div>
                </div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('aggGrupoDiagnosticoTopico')}}?idtopico={{$idtopico}}&nombre={{$nombre}}&idbotiquin={{$idbotiquin}}">Agregar</a></li>
                        <li class="breadcrumb-item"><a href="{{url('allDiagnosticoTopico')}}?idtopico={{$idtopico}}">Ver todos</a></li>

                    </ol>
                </nav>
                <br>
             
                <!--------group diagnostic------->
                <h5 class="kt-portlet__head-title text-center" >
                    Seleccione el grupo diagnostico
                </h5><br>

                <div id="alerts4"></div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">

                        <select id="idgrupoDiagnostic" multiple data-live-search="true" class="input selectpicker form-control ">
                                @foreach($groupDiagnostic->data as $item)
                                <option value="{{$item->idgrupo}}">{{$item->nombre}}</option>
                                @endforeach
                        </select>
                    </div>
                        
                    <div class="col-lg-4 col-sm-4">
                       
                        <button class="btn addgroupDiagnostic"> <i class="fas fa-plus"></i> Añadir</button>
                    </div>
                </div>
                <br>
                
                <table class="table ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grupo de diagnostico</th>
                        <th>examenes</th>
                    </tr>
                </thead>
                <tbody id="diagnostic">
                        
                    
                </tbody>
                </table> 


                <div id="alerts"></div>
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
    <script src="{{asset('assets/js/sanna/topicos/aggGrupoDiagnosticoTopico.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush


