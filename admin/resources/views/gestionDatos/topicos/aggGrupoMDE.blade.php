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

    <input type="hidden" id="new" value="{{$new}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->
            <input type="hidden" id="idbotiquin" value="{{$idbotiquin}}">
			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        
                        <h3 class="kt-portlet__head-title" >
                              Agregar  grupo de Medicamentos a tópico
                        </h3>
                    </div>
                </div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                @if($new==1)

                <ul class="progress-indicator">
               
                    <li class="completed"> <span class="bubble"></span> Nuevo tópico</li>
        
                    <li  class="completed"> <span class="bubble"></span> Horario </li>
                    
                    <li  class="completed"> <span class="bubble"></span> Grupo medic / examen / diagnóstico </li>
           
                </ul>
                <br>
                @endif

                <h5 class="kt-portlet__head-title text-center" >
                    Seleccione el grupo de medicamentos
                </h5><br>
               
                <div id="alerts"></div>

                

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">
                        <label>Seleccione el grupo de medicamentos</label>

                        <select id="idgrupo" multiple  data-live-search="true" class="input selectpicker form-control ">
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

                <!--------examenes imagen------->

                <h5 class="kt-portlet__head-title text-center" >
                    Seleccione el grupo de examenes Imagen
                </h5><br>


                <div id="alerts2"></div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">

                        <select id="idgrupoExamenI" multiple data-live-search="true" class="input selectpicker form-control ">
                                @foreach($groupexamenesI->data as $item)
                                <option value="{{$item->idgrupo}}">{{$item->nombre}}</option>
                                @endforeach
                        </select>
                    </div>
                        
                    <div class="col-lg-4 col-sm-4">
                       
                        <button class="btn addgroupExamenI"> <i class="fas fa-plus"></i> Añadir</button>
                    </div>
                </div>
                <br>
                
                <table class="table ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grupo de examen imagen</th>
                        <th>Examenes</th>
                    </tr>
                </thead>
                <tbody id="examenI">
                        
                    
                </tbody>
                </table> <br><br><br>

                <!--------examenes laboratorio------->
                <h5 class="kt-portlet__head-title text-center" >
                    Seleccione el grupo de examenes laboratorio
                </h5><br>

                <div id="alerts3"></div>

                <div class="row justify-content-center">
                    <div class="col-lg-4 col-sm-4">

                        <select id="idgrupoExamenL" multiple data-live-search="true" class="input selectpicker form-control ">
                                @foreach($groupexamenesL->data as $item)
                                <option value="{{$item->idgrupo}}">{{$item->nombre}}</option>
                                @endforeach
                        </select>
                    </div>
                        
                    <div class="col-lg-4 col-sm-4">
                       
                        <button class="btn addgroupExamenL"> <i class="fas fa-plus"></i> Añadir</button>
                    </div>
                </div>
                <br>
                
                <table class="table ">
                <thead>
                    <tr>
                        <th></th>
                        <th>Grupo de examen laboratorio</th>
                        <th>Examenes</th>
                    </tr>
                </thead>
                <tbody id="examenL">
                        
                    
                </tbody>
                </table><br><br><br>


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


                <div id="alerts5"></div>
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
<script src="{{asset('assets/js/sanna/topicos/aggGrupoMDE.js') }}" type="text/javascript"></script> 
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush


