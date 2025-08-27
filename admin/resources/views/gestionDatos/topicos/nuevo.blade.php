@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/sanna/medicamentos/medicamentos.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/bootstrap-select.min.css')}}" rel="stylesheet" />
<link  href="{{ URL::asset('/assets/css/progress-wizard.min.css')}}" rel="stylesheet" />
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
                            Agregar nuevo Tópico
                        </h3>
                    </div>
                </div>
            </div>
            
            <!-------body----------------->

            <div class="kt-portlet__body">

                <ul class="progress-indicator">
               
                    <li class="completed"> <span class="bubble"></span> Nuevo tópico</li>
        
                    <li> <span class="bubble"></span> Horario </li>
                    
                    <li> <span class="bubble"></span> Grupo medic / examen / diagnóstico </li>
                
                </ul>



                <div class="row justify-content-center">
                    <div class="col-md-4">
                       

                        <label>Cliente</label>
                        <select class="form-control form-control-sm campo" id="idempresa">
                            <option value=""></option>
                            @foreach($empresas->data as $item)
                            <option value="{{$item->idempresa}}">{{$item->empresa}}</option>
                            @endforeach
                        </select>

                        <!-- <label>Subcliente</label>
                        <select class="form-control form-control-sm campo"  disabled id="idSede"></select> -->

                        

                        <label>Departamento</label>
                        <select class="form-control form-control-sm campo pais" id="idubigeo">
                            <option value=""></option>
                            @foreach($pais->data as $item)
                            <option value="{{$item->idubigeo}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>

                        <label>Provincia</label>
                        <select class="form-control form-control-sm campo" disabled id="idprovincia"></select>

                        <label>Distrito</label>
                        <select class="form-control form-control-sm campo" disabled id="idDistriro">
                        </select>

                       

                    </div>
                    <div class="col-md-4">

                        <label>Dirección</label>
                        <input type="text" class="letrasyn form-control form-control-sm campo" id="direccion">

                        <label>Sede</label>
                        <input type="text" class="letrasyn form-control form-control-sm campo" id="nombre">

                        <label>Código CSO</label>
                        <input type="text"  class="letrasyn form-control form-control-sm campo" id="cod_cso">

                        <label>Servicio de Botiquines ampliados</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="numbers form-check-input" id="materialInline1" onclick="handleClick(1);" value="1" name="botiquin_ampliado">
                                <label class="form-check-label" for="materialInline1">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="materialInline2"onclick="handleClick(0);"  value="0" name="botiquin_ampliado">
                                <label class="form-check-label" for="materialInline2">No</label>
                            </div>
                        </div>
                        <br><br>
                        

                       
                        <div id="codigoal" style="display:none;">
                            <label>Código de almacen</label>
                            <input type="text"  class="letrasyn form-control form-control-sm campo" id="cod_almacen">
                        </div>

  
                    </div>
                    <div class="col-md-4">


                        <label>Especialidades</label>
                        <select class="selectpicker form-control campoM" id="idprofesionales" name="idprofesionales" multiple data-live-search="false">
                            @foreach($tipoProfesional->data as $item)
                            <option value="{{$item->idtipoprofesional}}">{{$item->profesion}}</option>
                            @endforeach
                        </select>

                        <label>Fecha de apertura</label>
                        <input type="date" class="form-control form-control-sm campo" id="fec_apertura">

                        <label>Estado</label>
                        <select class="form-control form-control-sm campo" id="estado">
                            <option value=""></option>
                            <option value="0">Activo</option>
                            <option value="1">Inactivo</option>
                            <option value="2">Suspendido</option>
                            <option value="3">Cerrado</option>
                        </select>

                      
                        <label>Tipo de condición</label>
                        <select class="selectpicker form-control campoM" id="idtipocondicion" name="idtipocondicion" multiple data-live-search="false">
                            
                            @foreach($tipoCondicion->data as $item)
                            <option value="{{$item->idtipocondicion}}">{{$item->condicion}}</option>
                            @endforeach
                        </select>
                      

                        <label>Tipo seguro</label>
                        <select class="selectpicker form-control campoM" id="idtiposeguro" name="idtiposeguro" multiple data-live-search="false">
                            @foreach($tipoSeguro->data as $item)
                            <option value="{{$item->idtiposeguro}}">{{$item->seguro}}</option>
                            @endforeach
                        </select>

                    
                    </div>
                </div>
                
                <hr style="border-bottom:1px solid #eee;">

                <h5 class="kt-portlet__head-title" >Empresa aseguradora</h5>
                <br>


                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <label>Aseguradora</label>
                        <select class="form-control form-control-sm campo" id="idaseguradora">
                            <option value=""></option>
                            @foreach($aseguradoras->data as $item)
                            <option value="{{$item->idaseguradora}}">{{$item->aseguradora}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Nombre Broker</label>
                        <input type="text" class="form-control form-control-sm campo" id="broker">
                    </div>
                    <div class="col-md-3">
                        <label>Correo electrónico</label>
                        <input type="email" class="form-control form-control-sm campo" id="email_broker">
                    </div>
                    <div class="col-md-3">
                        <label>Teléfono</label>
                        <input type="text" class="numbers form-control form-control-sm campo" id="tlf_broker">
                    </div>
                </div>

                <!------------ejecutivo---------->
                <hr style="border-bottom:1px solid #eee;">
                <h5 class="kt-portlet__head-title" >Ejecutivo</h5>
                <br>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Nombre</label>
                        <input type="text" class="letrasyn form-control form-control-sm campo" id="ejecutivo">
                    </div>
                    <div class="col-md-4">
                        <label>Correo electrónico</label>
                        <input type="email" class="form-control form-control-sm campo" id="email_ejecutivo">
                    </div>
                    <div class="col-md-4">
                        <label>Teléfono</label>
                        <input type="text" class="numbers form-control form-control-sm campo" id="tlf_ejecutivo">
                    </div>
                </div>


                <!--------ADMIN DE CUENTA---------->

                <hr style="border-bottom:1px solid #eee;">
                <h5 class="kt-portlet__head-title" >Administrador de cuenta</h5>
                <br>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Nombre</label>
                        <input type="text" class="letrasyn form-control form-control-sm campo" id="admincuenta">
                    </div>
                    <div class="col-md-4">
                        <label>Correo electrónico</label>
                        <input type="email" class="form-control form-control-sm campo" id="email_admincuenta">
                    </div>
                    <div class="col-md-4">
                        <label>Teléfono</label>
                        <input type="text" class="numbers form-control form-control-sm campo" id="tlf_admincuenta">
                    </div>
                </div>





              
                <div id="alerts"></div>
                <br>
              
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            siguiente <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </div> 

            </div>

        </div>
    </div>




@endsection
@push('scripts')
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/sanna/topicos/nuevo.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush