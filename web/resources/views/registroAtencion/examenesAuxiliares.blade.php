@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/historiaClinica.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/select2.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='examenes';
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-10 mx-auto">
            <div class="divPrin">

            @if(!empty($histori) and session('paciente')!=null)
                @if(count($histori->data)>0 or session('filiacion')!=null)

                
                    @if(isset(session('paciente')->cie10))
                
                        @php
                            $arrayCie10 = explode(',', session('paciente')->cie10);
                        @endphp
                        <div class="row justify-content-center">
                            <div class="col-md-10 mx-auto">


                                <div class="row">
                                    <div class="col-md-10 mx-auto text-center">
                                        <h1 class="title">Exámenes Auxiliares</h1>
                                    </div>
                                    
                                </div>
                                <!----examenes imagenes------->
                            
                                <div class="row">
                                    <div class="col-md-5">
                                        <label id="label">Examenes de Imagen:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label id="label">Cant.</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label id="label">CIE-10</label>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                <br>
                                <input class="form-control" type="hidden" value="{{session('paciente')->cie10}}" id="arrayCie10">
                                
                                @if(session('examenes')!=null) 
                                    @if(session('examenes')->img!="")
                                        <?php
                                            $exami = count(session('examenes')->img->examenlista);
                                        ?>
                                        @foreach(session('examenes')->img->examenlista as $key => $item)
                                        <div id="lista{{$key}}">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <select  class="input form-control" name="examenI"  id="examenI{{$key}}" onchange="getval(this,{{$key}});">
                                                        <option value=""></option>
                                                        @foreach($examenImg->data as $index => $value)     
                                                            <option examen="{{$value->examen}}" 
                                                            @if($value->idexamenauxiliar==$item->idexamenauxiliar)  selected @endif
                                                            value="{{$value->idexamenauxiliar}}">{{$value->examen}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" value="{{$item->cant}}" name="cantidadI" min="1" disabled id="cantidad_{{$key}}"
                                                    class="input form-control form-control-sm numbers">
                                                </div>
                                                <div class="col-md-3">
                                                    <?php
                                                        $diag=[];
                                                        foreach($dianostics->data as $dia){
                                                            $diag[]=$dia;
                                                        }
                                                    ?>
                                                    <select class="form-control form-control-sm"  name="cie10I" disabled id="cie10_{{$key}}">
                                                        <option value=""></option>
                                                        @foreach($arrayCie10 as $u)
                                                            <?php
                                                                $key = array_search($u,array_column($diag,'cie10'))
                                                            ?>
                                                            <option value="{{$u}}"
                                                            @if($item->cie10==$u)  selected @endif
                                                            >{{$diag[$key]->diagnostico}} - cie10: {{$u}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-danger" onclick="handleRemover({{$key}})"><i style="color:#fff;" class="fas fa-minus-circle"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        @endforeach
                                    @else

                                    @if($examenImg->status==200)
                                    <div id="lista0">

                                        <div class="row">
                                            <div class="col-md-5">
                                                <select  class="input form-control" name="examenI"  id="examenI0" onchange="getval(this,0);">
                                                    <option value=""></option>
                                                @foreach($examenImg->data as $key => $item)                                
                                                    <option examen="{{$item->examen}}" value="{{$item->idexamenauxiliar}}">{{$item->examen}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="cantidadI" min="1" disabled id="cantidad_0"
                                                
                                                class="input form-control form-control-sm numbers">
                                            </div>
                                            <?php
                                                $diag=[];
                                                foreach($dianostics->data as $dia){
                                                    $diag[]=$dia;
                                                }
                                            ?>
                                            <div class="col-md-3">
                                                <select class="form-control form-control-sm"  name="cie10I" disabled id="cie10_0">
                                                    <option value=""></option>
                                                    @foreach($arrayCie10 as $u)
                                                            <?php
                                                                $key = array_search($u,array_column($diag,'cie10'))
                                                            ?>
                                                            <option value="{{$u}}"
                                                        >{{$diag[$key]->diagnostico}} - cie10: {{$u}}</option>
                                                    @endforeach
                                                
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-danger" onclick="handleRemover({{$key}})"><i style="color:#fff;" class="fas fa-minus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                @else
                                    @if($examenImg->status==200)
                                    <div id="lista0">

                                        <div class="row">
                                            <div class="col-md-5">
                                                <select  class="input form-control" name="examenI"  id="examenI0" onchange="getval(this,0);">
                                                    <option value=""></option>
                                                @foreach($examenImg->data as $key => $item)                                
                                                    <option examen="{{$item->examen}}" value="{{$item->idexamenauxiliar}}">{{$item->examen}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="cantidadI" min="1" disabled id="cantidad_0"
                                                
                                                class="input form-control form-control-sm numbers">
                                            </div>
                                            <?php
                                                $diag=[];
                                                foreach($dianostics->data as $dia){
                                                    $diag[]=$dia;
                                                }
                                            ?>
                                            <div class="col-md-3">
                                                <select class="form-control form-control-sm"  name="cie10I" disabled id="cie10_0">
                                                    <option value=""></option>
                                                    @foreach($arrayCie10 as $u)
                                                            <?php
                                                                $key = array_search($u,array_column($diag,'cie10'))
                                                            ?>
                                                            <option value="{{$u}}"
                                                        >{{$diag[$key]->diagnostico}} - cie10: {{$u}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-danger" onclick="handleRemover({{$key}})"><i style="color:#fff;" class="fas fa-minus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                <div id="otros">

                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-md-3 text-right">
                                        <button id="boton" class="btn agregarExami">
                                            <i class="fas fa-plus"></i> Añadir otro
                                        </button>
                                    </div>
                                </div>

                        
                            
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label id="label">Indicaciones generales</label>
                                        <textarea id="indicaciones_I" minlength="500" class="input  form-control form-control-sm " placeholder="Escribir aqui..." name="" rows="5">@if(session('examenes')!=null)@if(session('examenes')->img!=""){{session('examenes')->img->indicaciones}}@endif @endif</textarea>
                                    </div>
                                </div>
                            

                                <hr>
                                <!----examenes laboratorio------->

                                <div class="row">
                                    <div class="col-md-5">
                                        <label id="label">Examenes de laboratorio:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label id="label">Cant.</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label id="label">CIE-10</label>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                <br>

                                @if(session('examenes')!=null) 
                                    @if(session('examenes')->lab!="")
                                        <?php
                                            $examl = count(session('examenes')->lab->examenlista);
                                        ?>
                                        @foreach(session('examenes')->lab->examenlista as $key => $item)
                                        <div id="lista2{{$key}}">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <select  class="input form-control" name="examenL"  id="examenL{{$key}}" onchange="getval2(this,{{$key}});">
                                                        <option value=""></option>
                                                        @foreach($examenLab->data as $index => $value)     
                                                            <option examen="{{$value->examen}}" 
                                                            @if($value->idexamenauxiliar==$item->idexamenauxiliar)  selected @endif
                                                            value="{{$value->idexamenauxiliar}}">{{$value->examen}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" value="{{$item->cant}}" name="cantidadL" min="1" disabled id="cantidadL_{{$key}}"
                                                    class="input form-control form-control-sm numbers">
                                                </div>
                                                <div class="col-md-3">
                                                    <?php
                                                        $diag=[];
                                                        foreach($dianostics->data as $dia){
                                                            $diag[]=$dia;
                                                        }
                                                    ?>
                                                    <select class="form-control form-control-sm"  name="cie10L" disabled id="cie10_L{{$key}}">
                                                        <option value=""></option>
                                                        @foreach($arrayCie10 as $u)
                                                            <?php
                                                                $key = array_search($u,array_column($diag,'cie10'))
                                                            ?>
                                                            <option value="{{$u}}"
                                                            @if($item->cie10==$u) selected @endif
                                                            >{{$diag[$key]->diagnostico}} - cie10: {{$u}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-danger" onclick="handleRemover2(0)"><i style="color:#fff;" class="fas fa-minus-circle"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        @endforeach
                                    @else

                                        @if($examenLab->status==200)
                                        <div id="lista20">

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <select  class="input form-control" name="examenL"  id="examenL0" onchange="getval2(this,0);">
                                                        <option value=""></option>
                                                        @foreach($examenLab->data as $key => $item)                                
                                                            <option examen="{{$item->examen}}" value="{{$item->idexamenauxiliar}}">{{$item->examen}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="cantidadL" min="1" disabled id="cantidadL_0"
                                                    
                                                    class="input form-control form-control-sm numbers">
                                                </div>
                                                <?php
                                                    $diag=[];
                                                    foreach($dianostics->data as $dia){
                                                        $diag[]=$dia;
                                                    }
                                                ?>
                                                <div class="col-md-3">
                                                    <select class="form-control form-control-sm"  name="cie10L" disabled id="cie10_L0">
                                                        <option value=""></option>
                                                        @foreach($arrayCie10 as $u)
                                                            <?php
                                                                $key = array_search($u,array_column($diag,'cie10'))
                                                            ?>
                                                            <option value="{{$u}}"
                                                            >{{$diag[$key]->diagnostico}} - cie10: {{$u}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-danger" onclick="handleRemover2(0)"><i style="color:#fff;" class="fas fa-minus-circle"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                @else
                                    @if($examenLab->status==200)
                                    <div id="lista20">

                                        <div class="row">
                                            <div class="col-md-5">
                                                <select  class="input form-control" name="examenL"  id="examenL0" onchange="getval2(this,0);">
                                                    <option value=""></option>
                                                    @foreach($examenLab->data as $key => $item)                                
                                                        <option examen="{{$item->examen}}" value="{{$item->idexamenauxiliar}}">{{$item->examen}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="cantidadL" min="1" disabled id="cantidadL_0"
                                                
                                                class="input form-control form-control-sm numbers">
                                            </div>
                                            <?php
                                                $diag=[];
                                                foreach($dianostics->data as $dia){
                                                    $diag[]=$dia;
                                                }
                                            ?>
                                            <div class="col-md-3">
                                                <select class="form-control form-control-sm"  name="cie10L" disabled id="cie10_L0">
                                                    <option value=""></option>
                                                    @foreach($arrayCie10 as $u)
                                                        <?php
                                                            $key = array_search($u,array_column($diag,'cie10'))
                                                        ?>
                                                        <option value="{{$u}}"
                                                        >{{$diag[$key]->diagnostico}} - cie10: {{$u}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-danger" onclick="handleRemover2(0)"><i style="color:#fff;" class="fas fa-minus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif

                                <div id="otros2">

                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-md-3 text-right">
                                        <button id="boton" class="btn agregarExamiL">
                                            <i class="fas fa-plus"></i> Añadir otro
                                        </button>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label id="label">Indicaciones generales</label>
                                        <textarea id="indicaciones_L" minlength="500" class="input  form-control form-control-sm " placeholder="Escribir aqui..." name="" rows="5">@if(session('examenes')!=null)@if(session('examenes')->lab!=""){{session('examenes')->lab->indicaciones}}@endif @endif</textarea>
                                    </div>
                                </div>




                
                            
                                <input type="hidden" id="contarmI" 
                                @if(session('examenes')!=null)  @if(session('examenes')->img!="") value="{{$exami}}" @endif @else value="0" @endif>

                                <input type="hidden" id="contarmL" 
                                @if(session('examenes')!=null)  @if(session('examenes')->lab) value="{{$examl}}" @endif @else value="0" @endif>

                                <div id="alerts"></div>

                                @if(session('finalizar')==null)
                                <div class="row justify-content-center">

                                    <div class="col-md-4 mx-auto">
                                        <a id="boton" href="{{url('descansoMedico')}}" class="btn">
                                            SALTAR PASO  
                                        </a>
                                    </div>
                                

                                    <div class="col-md-4 mx-auto">
                                        <button id="boton" class="btn generar">
                                            CONTINUAR  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
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
            @else
                <label id="label" class="text-center">Error en el servicio del sited, por favor intente nuevamente</label>

            @endif
            </div>
        </div>
    </div>

    @include('components.modalAlert')


@endsection
@push('scripts')
<script src="{{ URL::asset('/assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/validar.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/js/registroAtencion/examenesAuxiliares.js') }}" type="text/javascript"></script> 
@endpush

