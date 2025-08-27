@extends('layout.navbar')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/historiaClinica.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/bootstrap-select.min.css')}}" rel="stylesheet" />
@endpush
@section('content')


<div class="container-fluid section">

    <div class="row justify-content-center">
          
        <div class="col-lg-10 col-sm-8 mx-auto">
            <div class="divPrin">
                @if(session('topico')!=null)
                <div class="justify-content-center">
                    <div class="col-md-8 mx-auto">

                        <div class="text-center">
                            <img src="{{ asset('/assets/images/login/login.svg') }}" class="img-fluid logo">
                        </div>

                        <h1 class="subtitle">Nueva atención</h1>

                        <label id="label">Seleccione la aseguradora:</label>
                        <select class="input selectpicker form-control form-control-sm" data-live-search="true">
                            <option value=""></option>
                            @foreach($aseguradoras->data as $item)
                                <option value="{{$item->id}}">{{$item->aseguradora}}</option>
                            @endforeach
                        </select>
                    
                    
                        <br>    <br>
                        <label id="label">Buscar por:</label>
                        <select id="search" onchange="selectSearch(this)" disabled class="input form-control form-control-sm">
                            <option value=""></option>
                            <option value="doc">Documento de indentidad</option>
                            <option value="selectnombresyapellidos">Nombres y apellidos</option>
                           
                        </select>
                        
                        <div id="documento" style="display:none;">
                            <select id="tipo_doc" onchange="tipoDoc(this)" class="input form-control form-control-sm">
                                <option value=""></option>
                                <option value="1">DNI</option>
                                <option value="2">CARNET EXTRANJERIA</option>
                                <option value="3">PASAPORTE</option>
                            </select>
                        </div>

                        <div id="diVdoc" style="display:none;">
                            <input type="text" placeholder="N° de documento"   id="num_doc" maxlength=10 class="input form-control form-control-sm">
                        </div>


                        <div id="diVnombres" style="display:none;">
                            <input type="text" id="nombres" onkeyup="mayus(this);" placeholder ="Nombres" class="letras input form-control form-control-sm">
                            <input type="text" id="ape_paterno" onkeyup="mayus(this);" placeholder ="Apellido paterno" class="letras input form-control form-control-sm">
                            <input type="text" id="ape_materno" onkeyup="mayus(this);" placeholder ="Apellido materno" class="letras input form-control form-control-sm">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-4 mx-auto">
                            <button id="boton" class="btn ingresar">
                                    Buscar  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                            </svg>
                                    
                                    <span class="spinner-border spinner-border-sm" id="spinner1" style="display:none;"></span>
                            </button>
                        </div>
                    </div>
                    <br><br>

                    <div class="col-md-12 mx-auto">

                        <div id="contenidoAfiliado">
                        
                        </div>


                        <div id="alerts"></div>


                        <div class="row justify-content-center">
                            <div class="col-md-4 mx-auto">
                                <a href="{{url('paciente_cortesia')}}" id="boton" class="btn pacienteC">
                                    Paciente por cortesía  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                                </a>
                            </div>
                           
                        </div>

                    </div>


                </div>
                @else

                    <h1 class="subtitle">Falta seleccionar el topico</h1>


                @endif
            </div>
        </div>
        

    </div>

</div>



@endsection
@push('scripts')
<script src="{{ URL::asset('/assets/js/registroAtencion/newAtencion.js') }}?ver=1.8"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>

@endpush

