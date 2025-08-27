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

    <input type="hidden" value="{{$idactivofijo}}" id="idactivofijo">
    
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
                            Editar activo fijo
                        </h3>
                    </div>
                </div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Código inventario</label>
                        <input type="text" value="{{$info->data[0]->cod_inventario}}" class="letrasyn form-control form-control-sm campo" id="cod_inventario">
                    
                        <label>Estado</label>
                        <select class="form-control form-control-sm campo" id="estado">
                            
                            <option value="0" @if($info->data[0]->estado==0) selected @endif>Asignado</option>
                            <option value="1"  @if($info->data[0]->estado==1) selected @endif> No asignado</option>
                            <option value="2"  @if($info->data[0]->estado==2) selected @endif>Dado de baja</option>
                          
                        </select>

                        @if($info->data[0]->estado==0)
                        <div id="topic_as" style="display:block;">
                            <label>Tópico asignado</label>
                            <select class="selectpicker form-control campoM"  data-live-search="true" id="idtopico">                                   
                                @foreach($topicos->data as $item)
                                    <option value="{{$item->idtopico}}" @if($info->data[0]->idtopico==$item->idtopico) selected @endif>{{$item->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        @if($info->data[0]->estado==2)
                        <div id="dado_baja" style="display:block;">
                            <label>Código del Acta de baja de activo</label>
                            <input type="text" value="{{$info->data[0]->cod_baja}}" class="letrasyn form-control form-control-sm campo" id="cod_baja">
                        </div>
                        @endif

                     

                        <div id="topic_as" style="display:none;">
                            <label>Tópico asignado</label>
                            <select class="selectpicker form-control campoM"  data-live-search="true" id="idtopico2">                                   
                                @foreach($topicos->data as $item)
                                    <option value="{{$item->idtopico}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="dado_baja" style="display:none;">
                            <label>Código del Acta de baja de activo</label>
                            <input type="text" class="letrasyn form-control form-control-sm campo" id="cod_baja2">

                        </div>
                   

                        
                    </div>
                    <div class="col-md-4">

                        <label>Nombre</label>
                        <input type="text" value="{{$info->data[0]->nombre}}" class="letrasyn form-control form-control-sm campo" id="nombre">

                        <label>Marca</label>
                        <input type="text" value="{{$info->data[0]->marca}}" class="letrasyn form-control form-control-sm campo" id="marca">

                        <label>Modelo</label>
                        <input type="text" value="{{$info->data[0]->modelo}}" class="letrasyn form-control form-control-sm campo" id="modelo">

                        <label>Serie</label>
                        <input type="text" value="{{$info->data[0]->serie}}" class="letrasyn form-control form-control-sm campo" id="serie">

                        
                       
                    </div>
                    <div class="col-md-4">

                        <label>Precio</label>
                        <input type="text" value="{{$info->data[0]->precio}}"  class="form-control form-control-sm campo decimales"  id="precio">

                        <label>Propiedad de: </label>
                        <select class="form-control form-control-sm campo" id="propiedad">
                            
                            <option value="0" @if($info->data[0]->propiedad==0) selected @endif>PACIFICO</option>
                            <option value="1" @if($info->data[0]->propiedad==1) selected @endif>Cliente</option>
                            <option value="2" @if($info->data[0]->propiedad==2) selected @endif> DR+</option>
                            <option value="-1" @if($info->data[0]->propiedad==-1) selected @endif> Otro</option>
                     
                        </select>


                        <label>Comprobante</label>
                        <input type="text" value="{{$info->data[0]->comprobante}}"  class="letrasyn form-control form-control-sm campo" id="comprobante">

                                                
                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            actualizar <span class="spinner-border spinner-border-sm" style="display:none;"></span>
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
<script src="{{ asset('assets/js/sanna/activosFijos/editar.js') }}" type="text/javascript"></script>
@endpush