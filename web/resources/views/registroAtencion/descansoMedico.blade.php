@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/historiaClinica.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/select2.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='descanso';
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-10 mx-auto">
            <div class="divPrin">
             
            @if(count($histori->data)>0 or session('filiacion')!=null)
                    @if(isset(session('paciente')->cie10))

                    <div class="row justify-content-center">
                        <div class="col-md-10 mx-auto">
                            
                            <div class="row">
                                <div class="col-md-10 mx-auto text-center">
                                    <h1 class="title">Descanso Médico</h1>
                                </div>
                               
                            </div>
                            @php
                                $arrayCie10 = explode(',', session('paciente')->cie10);

                            @endphp
                            @if(session('descanso')!=null)
                                <?php
                                $presuncion_diagnostica = explode(',', session('descanso')->presuncion_diagnostica);
                                ?>
                            @endif
                            <?php
                                $diag=[];
                                foreach($dianostics->data as $item){
                                    $diag[]=$item;
                                }
                            ?>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label id="label">Presunción diagnóstica</label>
                                    <select class="form-control form-control-sm input" multiple="multiple"  id="presuncion_diagnostica">
                                        @foreach($arrayCie10 as $u)
                                            <option value="{{$u}}"
                                            <?php
                                                $key = array_search($u,array_column($diag,'cie10'))
                                            ?>
                                            @if(session('descanso')!=null)
                                                @if(in_array($u,$presuncion_diagnostica)) selected @endif
                                            @endif
                                            >

                                           {{$diag[$key]->diagnostico}}
                                    
                                        
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            @php
                                setlocale(LC_TIME, "spanish");
                            @endphp
                            <div class="row mb-3">
                                <input type="hidden" id="fechaini" value="{{session('diagnostico')->hoja_consulta->fecha}}">
                                 <div class="col-md-5">
                                    <label for="" class="mb-1">Fecha de inicio</label>
                                    <input type="text" id="fecharegistro" value="{{strftime('%A, %d de %B de %Y')}}" disabled class="form-control">
                                 </div>
                                 <div class="col-md-5 ms-2">
                                    <label for="" class="mb-1">Fecha fin</label>
                                    <input type="text" id="fechafin" disabled class="form-control">
                                 </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <label id="label">Periodo a descansar</label>
                                    
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input  min="0" type="number" id="periodo" name="periodo"
                                        @if(session('descanso')!=null)
                                            value="{{session('descanso')->periodo}}" 
                                        @endif
                                        class="numbers form-control input">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">días</div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label id="label">CMP:</label>
                                    <input class="form-control form-control-sm input" disabled value="{{session('medico')->data[0]->info[0]->cod_rns}}" type="text" id="cmp" name="cmp">
                                </div>
                            </div>

                        
                            <div id="alerts"></div>

                            @if(session('finalizar')==null)

                            <div class="row justify-content-center">
                                <div class="col-md-4 mx-auto">
                                    <a id="boton" href="{{url('finish_attention')}}" class="btn">
                                        SALTAR PASO  
                                    </a>
                                </div>

                                <div class="col-md-4 mx-auto">
                                    <button id="boton" class="btn generar">
                                        CONTINUAR <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                                    </button>
                                </div>
                               
                            </div>
                            @endif

                            
                      
                        
                        </div>
                    </div>
                    @else

                        <label id="label" class="text-center">Primero debe generar la Hoja de registro de atención</label>

                    @endif
                @else
                    <label id="label" class="text-center">Primero debe generar la hoja de atención del paciente</label>
                @endif
            </div>
        </div>
    </div>

    @include('components.modalAlert')



@endsection
@push('scripts')
<script src="{{ URL::asset('/assets/js/select2.min.js') }}"></script>
<script src="{{asset('assets/js/registroAtencion/descansoMedico.js') }}" type="text/javascript"></script> 
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush

