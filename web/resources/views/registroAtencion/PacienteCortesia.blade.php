@extends('layout.navbar')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/historiaClinica.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/bootstrap-select.min.css')}}" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid sectionContent">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto">
                <div class="divPrin">
                

                    <div class="row justify-content-center">
                        <div class="col-md-10 mx-auto">
                            
                            <h1 class="title">
                                <a href="{{url('newAtencion')}}" >
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                              
                                Paciente de cortesía
                            </h1>

                            
                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-sm-8 mx-auto">
                                    <div class="row">
                            
                                        <div class="col-md-5">
                                            <label id="label">Tipo doc:</label>
                                            <select id="tipo_doc" class="input form-control form-control-sm">
                                                <option value=""></option>
                                                <option value="1">DNI</option>
                                                <option value="2">CARNET EXTRANJERIA</option>
                                                <option value="3">PASAPORTE</option>
                                                <option value="7">SIN DOC DE INDENTIDAD</option>
                                            </select>
                                        </div>
                                        <div class="col-md-7">
                                            <label id="label">N° de documento</label>

                                            <input type="text" onkeypress="return valideKey(event);" maxlength=10 id="num_doc" class="input form-control form-control-sm">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            

                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-sm-8 mx-auto">
                                    <input type="text" onkeyup="mayus(this);" id="ape_paterno" placeholder ="Apellido paterno" class=" input form-control form-control-sm">                            
                                    <input type="text" onkeyup="mayus(this);" id="ape_materno" placeholder ="Apellido materno" class=" input form-control form-control-sm">
                                    <input type="text" onkeyup="mayus(this);" id="nombres" placeholder ="Nombres" class=" input form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-sm-8 mx-auto">
                                    <label id="label">Fecha de Nacimiento:</label>
                                    <input type="date" id="fec_nacimiento" class="input form-control form-control-sm">
                                    
                                    <label id="label">Sexo:</label>
                                    <select id="sexo" class="input form-control form-control-sm">
                                        <option value=""></option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 mx-auto text-center">
                                    <label id="label">Seleccionar subcliente:</label>
                                    <select class="form-control form-control-sm selectpicker" data-live-search="true"  id="idsubcliente">
                                        
                                        @foreach($subcliente->data as $u)
                                            <option value="{{$u->idempresa}}">{{$u->empresa}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col-md-6 mx-auto text-center">
                                    <label id="label">Modalidad de atención:</label>
                                    <select class="form-control form-control-sm"  id="idmodalidad">
                                       
                                        <option value="0">Telemedicina </option>
                                        <option value="1">Presencial </option>
                                    </select>
                                </div>
                            </div>

                            

                            
                            <div id="alerts"></div>


                            <div class="row justify-content-center">
                                <div class="col-md-4 text-center">
                                    <button id="boton" class="btn ingresar">
                                        Siguiente
                                    </button>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    

@endsection
@push('scripts')
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/registroAtencion/pacienteCortesia.js') }}"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush


