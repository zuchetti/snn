@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/historiaClinica.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/select2.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='diagnostic';
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-10 mx-auto">
            <div class="divPrin">
              
                @if(!empty($histori) and session('paciente')!=null)
                    @if(count($histori->data)>0 or session('filiacion')!=null)
                    <?php
                        date_default_timezone_set("America/Lima");
                    
                    ?>
                    <input type="hidden" value="{{session('paciente')->idmodalidad}}" id="idmodalidad">
                    <div class="row justify-content-center">
                        <div class="col-md-10 mx-auto">

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h1 class="title">Formato de registro de la atención</h1>
                                </div>
                            
                            </div>
                            <br>


                            <div class="row">
                                <div class="col-md-10">
                                    <label id="label">Apellidos y nombres</label>

                                    <input type="text" id="nombres" disabled 
                                    value="{{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}" 
                                    class="input form-control form-control-sm ">

                                </div>
                            
                                <div class="col-md-2">
                                    <label id="label">Edad:</label>
                                    <input type="text" id="edad" disabled value="{{session('paciente')->edad}}" onkeypress="return valideKey(event);" maxlength=2 class="input form-control form-control-sm">
                                </div>
                                
                            </div>

                            <input type="hidden" id="tipo_atencion" 
                            value="{{session('paciente')->tipo_atencion}}">
                            <div class="row">
                                <div class="col-md-4">
                                    @if(session('paciente')->tipo_atencion==0)
                                    <label id="label">Código de afiliado:</label>
                                    <input type="text" disabled value="{{session('paciente')->CodigoAfiliado}}" class="input form-control form-control-sm">
                                    @else
                                    <label id="label">#documento del paciente</label>
                                    <input type="text" disabled value="{{session('paciente')->num_doc}}" class="input form-control form-control-sm">
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label id="label">Fecha:</label>

                                    <input type="date" id="fecha"  value="<?php echo date('Y-m-d') ?>" class="input form-control form-control-sm">

                                </div>
                                <div class="col-md-4">
                                    <label id="label">Hora:</label>
                                    <input type="time" id="hora_atencion" value="<?php echo  date('h:i:s');?>" class="input form-control form-control-sm">                            
                                </div>
                            
                            </div>
                        
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="title">Anamenesis</h1>
                                </div>
                            </div>
                        

                            <div class="row">
                                <div class="col-md-12">
                                    <label id="label">Motivo de consulta:</label>
                                    <input type="text" id="motivo_consulta" 
                                    @if(isset(session('diagnostico')->hoja_consulta->motivo_consulta)) 
                                        value="{{session('diagnostico')->hoja_consulta->motivo_consulta}}" 
                                    @endif
                                    class="input form-control form-control-sm letrasyn">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <label id="label">Forma de inicio:</label>
                                    <input type="text" id="forma_inicio" 
                                    @if(isset(session('diagnostico')->hoja_consulta->forma_inicio)) 
                                        value="{{session('diagnostico')->hoja_consulta->forma_inicio}}" 
                                    @endif
                                    class="input form-control form-control-sm">
                                </div>

                                <div class="col-md-4">
                                    <label id="label">Curso:</label>
                                    <input type="text" id="curso"
                                    @if(isset(session('diagnostico')->hoja_consulta->curso)) 
                                        value="{{session('diagnostico')->hoja_consulta->curso}}" 
                                    @endif
                                    class="input form-control form-control-sm letrasyn">
                                </div>

                                <div class="col-md-4">
                                    <label id="label">Tiempo de enfermedad:</label>
                                    <input type="text" id="tiempo_enfermedad" 
                                    @if(isset(session('diagnostico')->hoja_consulta->tiempo_enfermedad)) 
                                        value="{{session('diagnostico')->hoja_consulta->tiempo_enfermedad}}" 
                                    @endif
                                    class="input form-control form-control-sm letrasyn">
                                </div>
                            
                            </div>
                            
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <label id="label">Relato cronológico:</label>
                                    <div class="form-group">
                                        <textarea id="relato_cronologico" class="input form-control" rows="5">@if(isset(session('diagnostico')->hoja_consulta->relato_cronologico)) {{session('diagnostico')->hoja_consulta->relato_cronologico}}@endif</textarea>
                                    </div>
                                </div>

                            </div>

                        <!----------antecedentes------------->

                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <label id="label2">Antecedentes</label>
                                    </div>
                                </div>
                            </div>
                                
                            <input type="hidden" id="sexo" value="{{session('paciente')->sexo}}">
                            <div class="row">
                                @if(session('paciente')->sexo==2)
                                <div class="mb-2 d-flex w-100">
                                    <input type="checkbox" id="furaplica" class="my-auto">
                                    <label for="furaplica" class="ms-2 my-auto">No aplica</label>
                                </div>
                                <div class="col-md-6">
                                    <label id="label">FUR:</label>
                                    <input type="date" id="fur" 
                                    @if(isset(session('diagnostico')->hoja_consulta->fur)) 
                                        value="<?php echo date('Y-m-d', strtotime(session('diagnostico')->hoja_consulta->fur)) ?>"
                                    @endif
                                    class="input form-control form-control-sm">
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <label id="label">RAM:</label>
                                    <input type="text" id="ram" 
                                    @if(isset(session('diagnostico')->hoja_consulta->ram)) 
                                        value="{{session('diagnostico')->hoja_consulta->ram}}"
                                    @else
                                     @if(isset(session('filiacion')->alergias)) 
                                        value="{{session('filiacion')->alergias}}"
                                     @endif
                                    @endif
                                    class="input form-control form-control-sm">
                                </div>
                                
                            </div>
                        
                        <!----------funciones bilogicas------------->
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="title">Funciones biológicas:</h1>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label id="label">Apetito:</label>
                                    <select  class="input form-control form-control-sm " id="apetito" 
                                    aria-label="Default select example">
                                        <option value=""></option>
                                        @if($apetito)
                                            @foreach($apetito->data as $item)
                                                <option value="{{$item->nombre}}"
                                                @if(isset(session('diagnostico')->hoja_consulta->apetito)) 
                                                @if(session('diagnostico')->hoja_consulta->apetito==$item->nombre)
                                                    selected
                                                @endif
                                            @endif
                                                >{{$item->nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>         
                                </div>
                                <div class="col-md-4">
                                    <label id="label">sed:</label>
                                    <select  class="input form-control form-control-sm" id="sed" aria-label="Default select example">
                                        <option value=""></option>
                                        @if($sed)
                                            @foreach($sed->data as $item)
                                            <option value="{{$item->nombre}}"
                                            @if(isset(session('diagnostico')->hoja_consulta->sed)) 
                                                @if(session('diagnostico')->hoja_consulta->sed==$item->nombre)
                                                    selected
                                                @endif
                                            @endif
                                            >{{$item->nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>         
                                </div>
                                <div class="col-md-4">
                                    <label id="label">Sueño:</label>
                                    <select  class="input form-control form-control-sm" id="suenho" aria-label="Default select example">
                                        <option value=""></option>
                                        @if($sueno)
                                            @foreach($sueno->data as $item)
                                            <option value="{{$item->nombre}}"
                                            @if(isset(session('diagnostico')->hoja_consulta->suenho)) 
                                                @if(session('diagnostico')->hoja_consulta->suenho==$item->nombre)
                                                    selected
                                                @endif
                                            @endif
                                            >{{$item->nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>         
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label id="label">Orina:</label>
                                    <select class="input form-control form-control-sm" id="orina" aria-label="Default select example">
                                        <option value=""></option>
                                        @if($orina)
                                            @foreach($orina->data as $item)
                                            <option value="{{$item->id}}"
                                            @if(isset(session('diagnostico')->hoja_consulta->orina)) 
                                                @if(session('diagnostico')->hoja_consulta->orina->id==$item->id)
                                                    selected
                                                @endif
                                            @endif
                                            >{{$item->nombre}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(isset(session('diagnostico')->hoja_consulta->orina)) 
                                        <div class="divo">
                                            <label id="label">Comentario:</label>
                                            <textarea id="comentarioO" class="input form-control" rows="5">{{session('diagnostico')->hoja_consulta->orina->comentario}}</textarea>
                                        </div>
                                
                                    @else
                                        <div class="divo" style="display:none;">
                                            <label id="label">Comentario:</label>
                                            <textarea id="comentarioO" class="input form-control " rows="5"></textarea>
                                        </div>
                                    @endif

                                </div>
                                <div class="col-md-6">
                                    <label id="label">Deposiciones:</label>
                                    <select  class="input form-control form-control-sm" id="deposiciones" aria-label="Default select example">
                                        <option value=""></option>
                                        @foreach($dispo->data as $item)
                                        <option value="{{$item->id}}"
                                        @if(isset(session('diagnostico')->hoja_consulta->deposiciones)) 
                                            @if(session('diagnostico')->hoja_consulta->deposiciones->id==$item->id)
                                                selected
                                            @endif
                                        @endif
                                        >{{$item->nombre}}</option>
                                        @endforeach
                                    </select>   

                                    @if(isset(session('diagnostico')->hoja_consulta->deposiciones)) 
                                    <div class="divd">
                                        <label id="label">Comentario:</label>
                                        <textarea id="comentariod" class="input form-control " rows="5">{{session('diagnostico')->hoja_consulta->deposiciones->comentario}}</textarea>
                                    </div>
                                    @else
                                    <div class="divd" style="display:none;">
                                        <label id="label">Comentario:</label>
                                        <textarea id="comentariod" class="input form-control " rows="5"></textarea>
                                    </div>
                                    @endif
                                </div>

                        

                            
                            
                                
                            </div>

                            <br>
                        
                            <!----------Funciones vitales------------->
                            <div class="row">
                                <div class="col-md-4">
                                    <h1 class="title">Funciones vitales</h1>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex col-md-12">
                                        @if(isset($histori->data[0]))
                                        <input type="checkbox" id="funcionniega" {{($histori->data[0]->idmodalidad==0)?' checked':''}} ><p class="ml-2 my-auto">No aplica solo si la atención es virtual</p>
                                        @else
                                        <input type="checkbox" id="funcionniega"  ><p class="ml-2 my-auto">No aplica solo si la atención es virtual</p>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <label id="label">T*:</label>
                                    <div class="input-group  mb-2 mr-sm-2">
                                        <input type="text" 
                                        @if(isset(session('diagnostico')->hoja_consulta->tem)) 
                                            value="{{session('diagnostico')->hoja_consulta->tem}}"
                                        @else
                                            @if(isset($histori->data[0]))
                                            value="{{($histori->data[0]->idmodalidad==0)?'0':''}}"
                                            {{($histori->data[0]->idmodalidad==0)?'disabled':''}}
                                            
                                            @endif
                                        @endif
                                        class="decimales form-control input" id="tem">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">°C</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label id="label">P.A.:</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" 
                                        @if(isset(session('diagnostico')->hoja_consulta->pa)) 
                                            value="{{session('diagnostico')->hoja_consulta->pa}}" 
                                        @else
                                            @if(isset($histori->data[0]))
                                            value="{{($histori->data[0]->idmodalidad==0)?'0':''}}"
                                            {{($histori->data[0]->idmodalidad==0)?'disabled':''}}
                                            
                                            @endif
                                        @endif
                            
                                        class=" form-control input" placeholder="-- / --" id="pa">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">mmHg</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label id="label">FC:</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" 
                                        @if(isset(session('diagnostico')->hoja_consulta->fc)) 
                                            value="{{session('diagnostico')->hoja_consulta->fc}}" 
                                        @else
                                            @if(isset($histori->data[0]))
                                            value="{{($histori->data[0]->idmodalidad==0)?'0':''}}"
                                            {{($histori->data[0]->idmodalidad==0)?'disabled':''}}
                                            
                                            @endif
                                        @endif
                                        class="decimales form-control input" id="fc">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">x’</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label id="label">FR:</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" 
                                        @if(isset(session('diagnostico')->hoja_consulta->fr)) 
                                            value="{{session('diagnostico')->hoja_consulta->fr}}" 
                                        @else
                                            @if(isset($histori->data[0]))
                                            value="{{($histori->data[0]->idmodalidad==0)?'0':''}}"
                                            {{($histori->data[0]->idmodalidad==0)?'disabled':''}}
                                            
                                            @endif
                                        @endif
                                        class="decimales form-control input" id="fr">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">x’</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label id="label">Peso:</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" 
                                        @if(isset(session('diagnostico')->hoja_consulta->peso)) 
                                            value="{{session('diagnostico')->hoja_consulta->peso}}" 
                                        @else
                                            @if(isset($histori->data[0]))
                                            value="{{($histori->data[0]->idmodalidad==0)?'0':''}}"
                                            {{($histori->data[0]->idmodalidad==0)?'disabled':''}}
                                            
                                            @endif
                                        @endif
                                        class="decimales form-control input" id="peso">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label id="label">Talla:</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text"  
                                        @if(isset(session('diagnostico')->hoja_consulta->talla)) 
                                            value="{{session('diagnostico')->hoja_consulta->talla}}" 
                                        @else
                                            @if(isset($histori->data[0]))
                                            value="{{($histori->data[0]->idmodalidad==0)?'0':''}}"
                                            {{($histori->data[0]->idmodalidad==0)?'disabled':''}}
                                            
                                            @endif
                                        @endif
                                        class="decimales form-control input" id="talla">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">m</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label id="label">IMC:</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" 
                                        @if(isset(session('diagnostico')->hoja_consulta->imc)) 
                                            value="{{session('diagnostico')->hoja_consulta->imc}}" 
                                        @else
                                            @if(isset($histori->data[0]))
                                            value="{{($histori->data[0]->idmodalidad==0)?'0':''}}"
                                            {{($histori->data[0]->idmodalidad==0)?'disabled':''}}
                                            
                                            @endif
                                        @endif
                                        disabled class="form-control input" id="imc">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kg/m2</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label id="label">Saturación:</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" 
                                        @if(isset(session('diagnostico')->hoja_consulta->saturacion)) 
                                            value="{{session('diagnostico')->hoja_consulta->saturacion}}" 
                                        @else
                                            @if(isset($histori->data[0]))
                                            value="{{($histori->data[0]->idmodalidad==0)?'0':''}}"
                                            {{($histori->data[0]->idmodalidad==0)?'disabled':''}}
                                            
                                            @endif
                                        @endif
                                        class="form-control input" id="saturacion">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!---------Examen clínica regional ------------->
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <label id="label2">Examen clínica regional </label>
                                    </div>

                                    <div class="mt-3 mb-3">
                                            <div class="col-md-8">
                                                <label id="label">Estado general:</label>
                                                <input type="text" class="form-control" id="estadogeneralprincipal">
                                            </div>
                                            <div class="col-md-8 mt-3">
                                                <label id="label">Estado de conciencia:</label>
                                                <input type="text" class="form-control" id="estadoconcienciaprincipal">
                                            </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                
                                            </div>
                                            <div class="col-md-8 d-none">
                                                <label id="label">Estado general:</label>
                                            </div>
                                            <div class="col-md-4 d-none">
                                                <label id="label">Estado de conciencia:</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                
                                    <div class="col-md-12">
                                        <?php
                                            $check=[];
                                        ?>
                                        @if(isset(session('diagnostico')->hoja_consulta->clinica_regional)) 
                                            @if(count(session('diagnostico')->hoja_consulta->clinica_regional)>0)
                                                @foreach(session('diagnostico')->hoja_consulta->clinica_regional as $item)
                                                    @php
                                                        array_push($check, $item);
                                                    @endphp
                                                @endforeach
                                            @endif
                                        @endif

                                        @foreach($clinic->data as $key => $item)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" 
                                                    @if(count($check)>0)
                                                        @if(in_array($item->id,array_column($check, 'id'))) checked @endif 
                                                    @endif
                                                    name="check" type="checkbox" id="inlineCheckbox{{$key}}"   nombre="{{$item->nombre}}" value="{{$item->id}}">
                                                    <label class="form-check-label" for="inlineCheckbox{{$key}}">{{$item->nombre}}</label>
                                                </div>    
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" 
                                                @if(count($check)>0)
                                                    @if(in_array($item->id,array_column($check, 'id')))

                                                        @php
                                                        $key = array_search($item->id, array_column($check, 'id'));
                                                        $thearray = (array) $check;
                                                        @endphp
                                                        value="<?php echo $thearray[$key]->estadogeneral?>"
                                                    @else
                                                        disabled
                                                    @endif 
                                                        
                                                @else
                                                    disabled
                                                @endif
                                                name="estadogeneral" id="estadogeneral{{$item->id}}" class="input form-control form-control-sm letrasyn">
                                            </div>
                                                <div class="col-md-4 d-none">
                                                <input type="text" name="estadoconciencia"
                                                @if(count($check)>0)
                                                    @if(in_array($item->id,array_column($check, 'id')))

                                                        @php
                                                        $key = array_search($item->id, array_column($check, 'id'));
                                                        $thearray = (array) $check;
                                                        @endphp
                                                        value="<?php echo $thearray[$key]->estadoconciencia?>"
                                                    @else
                                                        disabled
                                                    @endif 
                                                        
                                                @else
                                                    disabled
                                                @endif
                                                id="estadoconciencia{{$item->id}}" class="input form-control form-control-sm letrasyn">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    

                                </div>
                            </div>

                            <br><br>

                            <!---------diagnostico ------------->
                            
                            <div class="row">
                                @if(isset(session('diagnostico')->cie10)) 
                                
                                    <?php
                                        $cie10 = session('diagnostico')->cie10;
                                        $arrayCie10 = explode(",", $cie10);
                                    ?>
                                
                                @endif
                                <div class="col-md-12">
                                    <label id="label">Diagnóstico*:(buscar por nombre o cie10)</label>
                                    <select  class="input form-control form-contro-sm" name="cie10_0" multiple="multiple" id="cie10">
                                        <option></option>
                                        @if($diagnostico)
                                            @foreach($diagnostico->data as $item)
                                            <option value="{{$item->cie10}}"
                                            @if(isset(session('diagnostico')->cie10)) 

                                                @if(in_array($item->cie10,$arrayCie10)) selected @endif
                                            @endif
                                            >{{$item->diagnostico}} (CIE-10: {{$item->cie10}})</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                        
                            
                            </div>
                        
                        
                            <br> 
                        


                            <div id="alerts"></div>

                            @if(session('finalizar')==null)
                            <div class="row justify-content-center">
                                <div class="col-md-4">
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
                    <label id="label" class="text-center">Error en el servicio del sited, por favor intente nuevamente</label>

                @endif
            </div>
        </div>
    </div>

    @include('components.modalAlert')


@endsection
@push('scripts')
<script src="{{ URL::asset('/assets/js/select2.min.js') }}"></script>
<!-- <script src="{{ URL::asset('/assets/js/validar.js') }}"></script>
 --><script src="{{ URL::asset('/assets/js/registroAtencion/diagnostico.js') }}?1.5"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush