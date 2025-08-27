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
                        <a href="{{url('detalleTopico')}}?idtopico={{$idtopico}}&nombre={{$nombre}}&idbotiquin={{$idbotiquin}}" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                              Agregar  grupo de Medicamentos a tópico
                        </h3>
                    </div>
                </div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('aggGrupoMedicamentTopico')}}?idtopico={{$idtopico}}&nombre={{$nombre}}&idbotiquin={{$idbotiquin}}">Agregar</a></li>
                        <li class="breadcrumb-item"><a href="{{url('allMedicamentosTopico')}}?idtopico={{$idtopico}}">Ver todos</a></li>

                    </ol>
                </nav>
                <br> 

                <h5 class="kt-portlet__head-title text-center" >
                    Seleccione el grupo de medicamentos
                </h5><br>
               
                <div id="alerts5"></div>

                

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">
                        <label>Seleccione el grupo de medicamentos</label>

                        <select id="idgrupo" multiple data-live-search="true" class="input selectpicker form-control ">
                            @foreach($medicamentosgroup->data as $item)
                            <option value="{{$item->idgrupo}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-lg-4 col-sm-4">
                        <br>
                        <button class="btn addMedicament"> <i class="fas fa-plus"></i> Añadir</button>
                    </div>
                </div>
                <br>
                
                <table class="table ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grupo de medicamentos</th>
                        <th>Nº de medicamentos</th>
                    </tr>
                </thead>
                <tbody id="medicament">
                        
                    
                </tbody>
                </table>  <br><br><br>
                <hr>


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

    <script src="{{asset('assets/js/sanna/topicos/aggGrupoMedicamentTopico.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush


