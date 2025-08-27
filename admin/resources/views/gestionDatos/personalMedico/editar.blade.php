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

    <input type="hidden" value="{{$idprofesional}}" id="idprofesional">
    
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
                            Edita datos: {{$nombre}}
                        </h3>
                    </div>
                </div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                       
                        <label>DNI / carnet de extranjería</label>

                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-control form-control-sm campo" id="tipo_doc">
                                    
                                    <option value="1" @if($info->data[0]->tipo_doc==1) selected @endif>DNI</option>
                                    <option value="2" @if($info->data[0]->tipo_doc==2) selected @endif>C.E</option>
                                    <option value="3" @if($info->data[0]->tipo_doc==13) selected @endif>PASAPORTE</option>

                                </select>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{$info->data[0]->num_doc}}" maxlength=9 onkeypress="return valideKey(event);" class="form-control form-control-sm campo" id="num_doc">
                            </div>
                        </div>
                        
                        <label>Nombres</label>
                        <input type="text" value="{{$info->data[0]->nombres}}" class="letras form-control form-control-sm campo" id="nombres">

                        <label>Apellido paterno</label>
                        <input type="text" value="{{$info->data[0]->ape_paterno}}" class="letras form-control form-control-sm campo" id="ape_paterno">

                        <label>Apellido materno</label>
                        <input type="text"  value="{{$info->data[0]->ape_materno}}" class="letras form-control form-control-sm campo" id="ape_materno">

                       <label>Sexo</label>
                        <select class="form-control form-control-sm campo" id="sexo">
                            <option value="0" @if($info->data[0]->sexo==0) selected @endif >Femenino</option>
                            <option value="1" @if($info->data[0]->sexo==1) selected @endif>Masculino</option>
                        </select>

                        
                     
                        
                    </div>
                    <div class="col-md-4">

                        <label>Fecha de nacimiento</label>
                        <input type="date" value="<?php echo date('Y-m-d', strtotime($info->data[0]->fec_nacimiento)) ?>" class="form-control form-control-sm campo" id="fec_nacimiento">

                        <label>Correo electrónico</label>
                        <input type="email" value="{{$info->data[0]->email}}" class="form-control form-control-sm campo" id="email">

                        

                        <label>Teléfono</label>
                        <input type="text" value="{{$info->data[0]->telefono}}" maxlength=11  onkeypress="return valideKey(event);" class="form-control form-control-sm campo" id="telefono">

                        
                        <label>Asignación familiar</label>
                        <select class="form-control form-control-sm campo" id="asignacion_familiar">
                            <option value="0" @if($info->data[0]->asignacion_familiar==0) selected @endif >No</option>
                            <option value="1" @if($info->data[0]->asignacion_familiar==1) selected @endif>Sí</option>
                        </select>

                        <label>Profesión</label>
                        <select class="form-control form-control-sm campo" id="idtipoprofesional">
                            @foreach($tipoProfesional->data as $item)
                                @if($info->data[0]->idtipoprofesional==$item->idtipoprofesional)
                                <option value="{{$item->idtipoprofesional}}" selected>{{$item->profesion}}</option>
                                @endif
                                @if($info->data[0]->idtipoprofesional!=$item->idtipoprofesional)
                                <option value="{{$item->idtipoprofesional}}">{{$item->profesion}}</option>
                                @endif
                            @endforeach
                        </select>
                       


                    </div>
                    <div class="col-md-4">

                        <label>Tarifa por hora</label>
                        <input type="text" value="{{$info->data[0]->tarifa}}" class="form-control form-control-sm campo decimales" maxlength=20 id="tarifa">

                    
                        <label>Número de colegiatura</label>
                        <input type="text" value="{{$info->data[0]->cod_rns}}" onkeypress="return valideKey(event);" maxlength=11 class="form-control form-control-sm campo" id="cod_rns">

                        <label>Código overall</label>
                        <input type="text" value="{{$info->data[0]->cod_overall}}" onkeypress="return valideKey(event);" maxlength=11 class="form-control form-control-sm campo" id="cod_overall">
                       
                        <label>Ingreso a planilla</label>
                        <input type="date" value="<?php echo date('Y-m-d', strtotime($info->data[0]->fec_ingplanilla)) ?>" class="form-control form-control-sm campo" id="fec_ingplanilla">

                        <label>Planilla</label>
                        <select class="form-control form-control-sm campo" id="idtipoplanilla">
                            <option value=""></option>
                            @foreach($planilla->data as $item)
                                @if($info->data[0]->idtipoplanilla==$item->idtipoplanilla)
                                    <option value="{{$item->idtipoplanilla}}" selected>{{$item->planilla}}</option>
                                @endif
                                @if($info->data[0]->idtipoplanilla!=$item->idtipoplanilla)
                                    <option value="{{$item->idtipoplanilla}}">{{$item->planilla}}</option>
                                @endif
                            @endforeach
                        </select>

                        <label>Firma digital</label>
                        <div class="form-group campo" id="form-group">
                            <div class="custom-file">
                                <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Subir firma" id="file1">
                                    <div class="input-group-append">
                                        <button type="button" class="browseFimrma btn btn-primary">Buscar</button>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="ml-2 col-sm-6">
                            @if($info->data[0]->firma=="")
                            <img src="https://placehold.it/80x80" id="previewFirma" class="img-thumbnail">
                            @else
                            <img src="{{$info->data[0]->firma}}" id="previewFirma" class="img-thumbnail">
                            @endif
                        </div>
                        <input type="file" name="firmaDigital" class="custom-file-input filefirma" accept="image/png, image/jpeg" id="firmaDigital">



                         <label>Sello digital</label>
                        <div class="form-group campo" id="form-group">
                            <div class="custom-file">
                                <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Subir sello" id="file2">
                                    <div class="input-group-append">
                                        <button type="button" class="browseSello btn btn-primary">Buscar</button>
                                    </div>
                                </div>
                            </div> 
                        </div>

                        
                        @if($info->data[0]->sello=="")
                           <input type="hidden" id="s" value="https://placehold.it/80x80">
                        @else
                            <input type="hidden" id="s" value="{{$info->data[0]->sello}}">
                        @endif

                        @if($info->data[0]->firma=="")
                           <input type="hidden" id="f" value="https://placehold.it/80x80">
                        @else
                            <input type="hidden" id="f" value="{{$info->data[0]->firma}}">
                        @endif
                        
                        <div class="ml-2 col-sm-6">
                            @if($info->data[0]->sello=="")
                            <img src="https://placehold.it/80x80" id="previewSello" class="img-thumbnail">
                            @else
                            <img src="{{$info->data[0]->sello}}" id="previewSello" class="img-thumbnail">
                            @endif
                        </div>
                        <input type="file" name="selloDigital" class="custom-file-input filesello" accept="image/png, image/jpeg" id="selloDigital">

                    </div>
                   
                </div>
                <br>
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
<script src="{{asset('assets/js/sanna/personalMedico/editar.js') }}" type="text/javascript"></script> 
@endpush