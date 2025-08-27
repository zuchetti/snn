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

    
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-4">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('personalmedico')}}?idsubfuncionalidad=6">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Nuevo personal médico
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
                                    <option value=""></option>
                                    <option value="1">DNI</option>
                                    <option value="2">CARNET EXTRANJERIA</option>
                                    <option value="3">PASAPORTE</option>
                                    <!-- <option value="7">SIN DOC DE INDENTIDAD</option> -->
                                </select>
                            </div>
                            <div class="col-md-8">
                                <input type="text" maxlength=9 onkeypress="return valideKey(event);" class="form-control form-control-sm campo" id="num_doc">
                            </div>
                        </div>
                        
                        <label>Nombres</label>
                        <input type="text"  class="letras form-control form-control-sm campo" id="nombres">

                        <label>Apellido paterno</label>
                        <input type="text"  class="letras form-control form-control-sm campo" id="ape_paterno">

                        <label>Apellido materno</label>
                        <input type="text"  class="letras form-control form-control-sm campo" id="ape_materno">

                       <label>Sexo</label>
                        <select class="form-control form-control-sm campo" id="sexo">
                            <option value=""></option>
                            <option value="0">Femenino</option>
                            <option value="1">Masculino</option>
                        </select>
                        <label>Contraseña</label>
                        <input type="text" value="Sanna2024$*@" class="form-control form-control-sm " id="password">

                        
                        
                     
                        
                    </div>
                    <div class="col-md-4">

                        <label>Fecha de nacimiento</label>
                        <input type="date" class="form-control form-control-sm campo" id="fec_nacimiento">

                        <label>Correo electrónico</label>
                        <input type="email" class="form-control form-control-sm campo" id="email">

                        

                        <label>Teléfono</label>
                        <input type="text"  maxlength=11  onkeypress="return valideKey(event);" class="form-control form-control-sm campo" id="telefono">

                        
                        <label>Asignación familiar</label>
                        <select class="form-control form-control-sm campo" id="asignacion_familiar">
                            <option value=""></option>
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>

                        <label>Profesión</label>
                        <select class="form-control form-control-sm campo" id="idtipoprofesional">
                            <option value=""></option>
                            @foreach($tipoProfesional->data as $item)
                            <option value="{{$item->idtipoprofesional}}">{{$item->profesion}}</option>
                            @endforeach
                        </select>

                        <label>Repetir contraseña</label>
                        <input type="text" value="Sanna2024$*@" class="form-control form-control-sm" id="password1">
                    </div>
                    <div class="col-md-4">

                        <label>Tarifa por hora</label>
                        <input type="text" class="form-control form-control-sm campo decimales" maxlength=20 id="tarifa">

                    
                        <label>Número de colegiatura</label>
                        <input type="text"  class="form-control form-control-sm campo letrasyn" id="cod_rns">

                        <label>Código overall</label>
                        <input type="text" maxlength=11 class="form-control form-control-sm campo letrasyn" id="cod_overall">

                        <label>Ingreso a planilla</label>
                        <input type="date" class="form-control form-control-sm campo" id="fec_ingplanilla">

                       

                        <label>Planilla</label>
                        <select class="form-control form-control-sm campo" id="idtipoplanilla">
                            <option value=""></option>
                            @foreach($planilla->data as $item)
                            <option value="{{$item->idtipoplanilla}}">{{$item->planilla}}</option>
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
                            <img src="https://placehold.it/80x80" id="previewFirma" class="img-thumbnail">
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

                        <div class="ml-2 col-sm-6">
                            <img src="https://placehold.it/80x80" id="previewSello" class="img-thumbnail">
                        </div>
                        <input type="file" name="selloDigital" class="custom-file-input filesello" accept="image/png, image/jpeg" id="selloDigital">


                    </div>
                   
                </div>
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
<script src="{{asset('assets/js/sanna/personalMedico/nuevo.js') }}" type="text/javascript"></script> 
@endpush





