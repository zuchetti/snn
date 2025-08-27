@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/sanna/medicamentos/medicamentos.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/bootstrap-select.min.css')}}" rel="stylesheet" />

@endpush
@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp
    {{ csrf_field() }}

    <input type="hidden" id="idtopico" value="{{$info->data[0]->idtopico}}">
    <input type="hidden" id="idempresag" value="{{$info->data[0]->idempresa}}">
    
    <input type="hidden" id="idpais" value="{{$info->data[0]->idpais}}">
    <input type="hidden" id="iddepartamento" value="{{$info->data[0]->iddepartamento}}">
    <input type="hidden" id="iddistrito" value="{{$info->data[0]->iddistrito}}">

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
                           Editar tópico
                        </h3>
                    </div>
                </div>
            </div>
            
            <!-------body----------------->

            <div class="kt-portlet__body">

                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                       

                        <label>Cliente</label>
                        <select class="form-control form-control-sm campo" id="idempresa">
                            @foreach($empresas->data as $item)
                            <option value="{{$item->idempresa}}" @if($info->data[0]->idempresa==$item->idempresa) selected @endif>{{$item->empresa}}</option>
                            @endforeach
                        </select>



<!-- 
                        <label>Subcliente</label>
                        <select class="form-control form-control-sm campo" disabled id="idSede"></select> -->

                        

                        <label>Departamento</label>
                        <select class="form-control form-control-sm campo pais" id="idubigeo">
                            @foreach($pais->data as $item)
                            <option value="{{$item->idubigeo}}" @if($info->data[0]->idpais==$item->idubigeo) selected @endif>{{$item->nombre}}</option>
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

                        <input type="text" value="{{$info->data[0]->direccion}}" class="letrasyn form-control form-control-sm campo" id="direccion">
                        <label>Nombre</label>

                        <input type="text"  value="{{$info->data[0]->nombre}}" class="letrasyn form-control form-control-sm campo" id="nombre">

                        <label>Código CSO</label>
                        <input type="text"  value="{{$info->data[0]->cod_cso}}" class="form-control form-control-sm campo letrasyn" id="cod_cso">

                        <label>Servicio de Botiquines ampliados</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="numbers form-check-input" id="materialInline1" onclick="handleClick(1);" @if($info->data[0]->botiquin_ampliado==1) checked @endif value="1" name="botiquin_ampliado">
                                <label class="form-check-label" for="materialInline1">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="materialInline2"onclick="handleClick(0);" @if($info->data[0]->botiquin_ampliado==0) checked @endif  value="0" name="botiquin_ampliado">
                                <label class="form-check-label" for="materialInline2">No</label>
                            </div>
                        </div>
                        <br><br>
               
                        @if($info->data[0]->botiquin_ampliado==1)
                            <div id="codigoal1">
                                <label>Código de almacen</label>
                                <input type="text" value="{{$info->data[0]->cod_almacen}}" class="letrasyn form-control form-control-sm campo" id="cod_almacen">
                            </div>
                        @endif

                        <div id="codigoal" style="display:none;">
                            <label>Código de almacen</label>
                            <input type="text" value="{{$info->data[0]->cod_almacen}}" class="letrasyn form-control form-control-sm campo" id="cod_almacen2">
                        </div>
                        
                    </div>
                    <div class="col-md-4">

                        <label>Especialidades</label>
                        <?php
                            $profesiones = $info->data[0]->idprofesionales;
                  
                            $arrayProfesional = explode(",", $profesiones);
                        ?>
                        <select class="selectpicker form-control campoM" id="idprofesionales" name="idprofesionales" multiple data-live-search="false">
                            @foreach($tipoProfesional->data as $item)
                             
                                <option value="{{$item->idtipoprofesional}}" 
                                        @if(in_array($item->idtipoprofesional,$arrayProfesional)) selected @endif >{{$item->profesion}}
                                </option>

                            @endforeach
                        </select>

                        <label>Fecha de apertura</label>
                        <input type="date" value="<?php echo date('Y-m-d', strtotime($info->data[0]->fec_apertura)) ?>" class="form-control form-control-sm campo" id="fec_apertura">


                        <label>Estado</label>
                        <select class="form-control form-control-sm campo" id="estado">
                            <option value="0" @if($info->data[0]->estado==0) selected @endif>Activo</option>
                            <option value="1" @if($info->data[0]->estado==1) selected @endif>Inactivo</option>
                            <option value="2" @if($info->data[0]->estado==2) selected @endif> Suspendido</option>
                            <option value="3" @if($info->data[0]->estado==3) selected @endif>Cerrado</option>
                        </select>

                        <label>Tipo de condición</label>
                        <?php
                            $idtipocondicion = $info->data[0]->idtipocondicion;
                  
                            $arrayCondiciones = explode(",", $idtipocondicion);
                        ?>
                        <select class="selectpicker form-control campoM" id="idtipocondicion" name="idtipocondicion" multiple data-live-search="false">
                            @foreach($tipoCondicion->data as $item)
                                <option value="{{$item->idtipocondicion}}" 
                                @if(in_array($item->idtipocondicion,$arrayCondiciones)) selected @endif>
                                {{$item->condicion}}</option>
                            @endforeach
                        </select>

                        <label>Tipo seguro</label>
                        <select class="selectpicker form-control campoM" id="idtiposeguro" name="idtiposeguro" multiple data-live-search="false">
                            <?php
                                $idtiposeguro = $info->data[0]->idtiposeguro;
                    
                                $arraySeguro = explode(",", $idtiposeguro);
                            ?>
                            @foreach($tipoSeguro->data as $item)
                          
                                <option value="{{$item->idtiposeguro}}" 
                                @if(in_array($item->idtiposeguro,$arraySeguro)) selected @endif>
                                {{$item->seguro}}
                                </option>
                               
                            @endforeach
                        </select>

                    </div>
                  

                </div>
                <br>

                <hr style="border-bottom:1px solid #eee;">
                <h5 class="kt-portlet__head-title" >Empresa aseguradora</h5>
                <br>

                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <label>Aseguradora</label>
                        <select class="form-control form-control-sm campo" id="idaseguradora">
                            <option value=""></option>
                            @foreach($aseguradoras->data as $item)
                            <option value="{{$item->idaseguradora}}" @if($info->data[0]->idaseguradora==$item->idaseguradora) selected @endif>{{$item->aseguradora}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-3">
                        <label>Nombre Broker</label>
                        <input type="text" value="{{$info->data[0]->broker}}" class="form-control form-control-sm campo" id="broker">
                    </div>

                    <div class="col-md-3">
                        <label>Correo electrónico</label>
                        <input type="email" value="{{$info->data[0]->email_broker}}" class="form-control form-control-sm campo" id="email_broker">
                    </div>

                    <div class="col-md-3">
                        <label>Teléfono</label>
                        <input type="text"  class="numbers form-control form-control-sm campo" id="tlf_broker">
                    </div>


                </div>
                <!------------ejecutivo---------->
                <hr style="border-bottom:1px solid #eee;">
                <h5 class="kt-portlet__head-title" >Ejecutivo</h5>
                <br>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Nombre</label>
                        <input type="text" value="{{$info->data[0]->ejecutivo}}" class="letrasyn form-control form-control-sm campo" id="ejecutivo">
                    </div>
                    <div class="col-md-4">
                        <label>Correo electrónico</label>
                        <input type="email" value="{{$info->data[0]->email_ejecutivo}}" class="form-control form-control-sm campo" id="email_ejecutivo">
                    </div>
                    <div class="col-md-4">
                        <label>Teléfono</label>
                        <input type="text" value="{{$info->data[0]->tlf_ejecutivo}}" class="numbers form-control form-control-sm campo" id="tlf_ejecutivo">
                    </div>
                </div>

                <!--------ADMIN DE CUENTA---------->

                <hr style="border-bottom:1px solid #eee;">
                <h5 class="kt-portlet__head-title" >Administrador de cuenta</h5>
                <br>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Nombre</label>
                        <input type="text" value="{{$info->data[0]->admincuenta}}" class="letrasyn form-control form-control-sm campo" id="admincuenta">
                    </div>
                    <div class="col-md-4">
                        <label>Correo electrónico</label>
                        <input type="email" value="{{$info->data[0]->email_admincuenta}}" class="form-control form-control-sm campo" id="email_admincuenta">
                    </div>
                    <div class="col-md-4">
                        <label>Teléfono</label>
                        <input type="text" value="{{$info->data[0]->tlf_admincuenta}}" class="numbers form-control form-control-sm campo" id="tlf_admincuenta">
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            Actualizar <span class="spinner-border spinner-border-sm" style="display:none;"></span>
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

<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/sanna/topicos/editar.js') }}" type="text/javascript"></script>

@endpush