@extends('layout.navbar')
@push('css')
<link href="{{ asset('assets/css/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/dashboard/dashboard.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/sanna/tables.css')}}" rel="stylesheet">
@endpush
@section('content')
    <br>
  

    <div class="container-fluid" id="content">
            <div class="row justify-content-center">
                <div class="col-md-10 mx-auto">
                    <div class="divPrin">

                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="kt-portlet__head-label">
                                   
                                    <h3 class="kt-portlet__head-title" >
                                    <a href="javascript:history.back(1)" >
                                        <i class="fas fa-angle-double-left"></i>
                                    </a>
                                        Base de atenciones
                                    </h3>
                                    <br>
                                </div>
                            </div>
                            @foreach($antenciones->data as $datos)
                            <!--------hoja consulta-------->
                            <div class="col-md-10 mx-auto">
                                <div class="row filaa">
                                    <div class="col-md-4">
                                        <img src="{{ asset('/assets/images/logo/sanna.png') }}" alt="*"  class="img-fluid log">
                                    </div>
                                    <div class="col-md-4">
                                        <h6 id="divici">División Ambulatoria</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 id="divici">FORMATO DE REGISTRO DE LA ATENCIÓN</h6>
                                        <?php
                                            echo  $datos->dni."-".str_pad($datos->idatencion, 5, "0",STR_PAD_LEFT);
                                        ?>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td colspan="4"><small class="titlet">Apellidos y nombres:</small>
                                            {{$datos->nombres}}  {{$datos->ape_paterno}} {{$datos->ape_materno}}                                    
                                            </td>
                                            <td colspan="4"><small class="titlet">Edad:</small>
                                            {{$datos->hoja_consulta->edad}}
                                            </td>
                                        </tr>
                                        <tr>
                                            @if($datos->tipo_atencion==0)
                                            <td colspan="2"><small class="titlet">Código de afiliado:</small> 
                                            {{$datos->hoja_filiacion->codigo_afi}}
                                            @else
                                            <td colspan="2">
                                                <small class="titlet">#documento del paciente: </small> 
                                                {{$datos->dni}}                                    
                                            @endif
                                            
                                            </td>
                                            <td colspan="2">
                                                @foreach($tipos->data as $t)
                                                    @if($datos->idtiposeguro==$t->idtiposeguro)
                                                    <small class="titlet">{{$t->seguro}}:</small> X
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td colspan="2"><small class="titlet">Fecha: </small> {{$datos->hoja_consulta->fecha}}</td>
                                            <td colspan="2"><small class="titlet">Hora: </small> {{$datos->hoja_consulta->hora}}</td>

                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Nombre del contratante: </small> 
                                                {{$datos->hoja_filiacion->NombreContratante}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Tipo de Atención: </small> 
                                                @if($datos->idmodalidad==0)
                                                    Telemedicina
                                                @else
                                                    Presencial
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="8"><small class="titlet2">AMANMESIS</small></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Motivo de consulta:</small> {{$datos->hoja_consulta->motivo_consulta}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><small class="titlet">Forma de inicio:</small> {{$datos->hoja_consulta->forma_inicio}}</td>
                                            <td colspan="2"><small class="titlet">Curso:</small> {{$datos->hoja_consulta->curso}}</td>
                                            <td colspan="2"><small class="titlet">Tiempo de enfermedad:</small> {{$datos->hoja_consulta->tiempo_enfermedad}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Relato cronológico:</small> {{$datos->hoja_consulta->relato_cronologico}}</td>
                                        </tr>
                                        <tr >
                                            <td colspan="8"><small class="titlet2">Antecedentes </small></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><small class="titlet">FUR:</small> {{$datos->hoja_consulta->fur}} </td>
                                            <td colspan="4"><small class="titlet">RAM:</small> {{$datos->hoja_consulta->ram}} </td>
                                        </tr>
                                        <tr >
                                            <td colspan="8"><small class="titlet2">FUNCIONES BIOLÓGICAS </small></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><small class="titlet">Apetito:</small>  {{$datos->hoja_consulta->apetito}}</td>
                                            <td colspan="2"><small class="titlet">Sed:</small>  {{$datos->hoja_consulta->sed}}</td>
                                            <td colspan="2"><small class="titlet">Sueño:</small>  {{$datos->hoja_consulta->suenho}}</td>

                                        </tr>
                                        <tr>
                                            <td colspan="4"><small class="titlet">Orina:</small> 
                                            @foreach($orina->data as $o)
                                                @if($o->id==$datos->hoja_consulta->orina->id)
                                                    {{$o->nombre}} <small class="titlet">Comentario:</small>{{$datos->hoja_consulta->orina->comentario}}
                                                @endif
                                        
                                            @endforeach
                                            </td>
                                            <td colspan="4"><small class="titlet">Deposiciones:</small> 
                                            @foreach($dispo->data as $dis)
                                                @if($dis->id==$datos->hoja_consulta->deposiciones->id)
                                                    {{$dis->nombre}} <small class="titlet">Comentario:</small>{{$datos->hoja_consulta->deposiciones->comentario}}
                                                @endif
                                        
                                            @endforeach
                                            </td>
                                        </tr>
                                        <tr >
                                            <td colspan="8"><small class="titlet2">FUNCIONES VITALES</small></td>
                                        </tr>
                                        <tr>
                                            <td ><small class="titlet">T:</small>  {{$datos->hoja_consulta->tem}} °C</td>
                                            <td><small class="titlet">PA:</small> {{$datos->hoja_consulta->pa}} mmHg</td>
                                            <td><small class="titlet">FC:</small> {{$datos->hoja_consulta->fc}} x’</td>
                                            <td><small class="titlet">FR:</small>  {{$datos->hoja_consulta->fr}} x’</td>
                                            <td><small class="titlet">Peso:</small> {{$datos->hoja_consulta->peso}} Kg</td>
                                            <td><small class="titlet">Talla:</small> {{$datos->hoja_consulta->talla}} m</td>
                                            <td colspan="2"><small class="titlet">IMC:</small> {{$datos->hoja_consulta->imc}} Kg/m2</td>

                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Saturación:</small> {{$datos->hoja_consulta->saturacion}} %</small></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet2">Examen clínica regional </small></td>
                                        </tr>
                                        @if(count($datos->hoja_consulta->clinica_regional)>0)
                                            @foreach($datos->hoja_consulta->clinica_regional as $c)
                                            <tr >
                                                <td rowspan="2"><small class="titlet2">{{$c->nombre}}</small></td>
                                              @if(!empty($c->estadoconciencia))
                                                <td colspan="7"><small class="titlet"></small> {{$c->estadoconciencia}}</td>
                                              @endif 
                                            </tr>

                                            <tr>
                                            @if(!empty($c->estadogeneral))
                                                <td colspan="7"><small class="titlet"></small> {{$c->estadogeneral}}</td>
                                            @endif
                                            </tr>
                                            @endforeach
                                        @endif
                                        <?php
                                            $presuncion_diagnostica = explode(",", $datos->diagnosticos);
                                            $diag=[];
                                            foreach($dianostics->data as $item){
                                                $diag[]=$item;
                                            }
                                        ?>
                                       
                                    
                                        <tr>
                                            <td colspan="8"><small class="titlet2">DIAGNÓSTICO:</small></td>
                                        </tr>
                                        
                                    
                                        @foreach($presuncion_diagnostica as $u)
                                            <?php
                                                $key = array_search($u,array_column($diag,'cie10'))
                                            ?>
                                            
                                            
                                            <tr>
                                                <td colspan="8">{{$diag[$key]->diagnostico}} - cie10: {{$u}}</td>
                                            </tr>
                                        @endforeach
                                        
                                        <tr>
                                            <td colspan="8"><small class="titlet2">TRATAMIENTO:</small></td>
                                        </tr>
                                        @if(count($datos->recetas)>0)
                                            @foreach($datos->recetas as $recet)
                                            <tr>
                                                <td colspan="8"><small class="titlet">Número de receta:</small>
                                                    @if($recet->tipo==0)
                                                        Bot.interna :   {{$recet->idreceta}}
                                                    @endif
                                                    @if($recet->tipo==1)
                                                        Bot.ext :   {{$recet->idreceta}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="8"><small class="titlet2">Tratamiento Farmacológico:</small></td>
                                            </tr>
                                            <tr>
                                                <td ><small class="titlet">Medicamento</small></td>
                                                <td ><small class="titlet">Present:</small></td>
                                                <td ><small class="titlet">CIE-10:</small></td>
                                                <td ><small class="titlet">Cant:</small></td>
                                                <td><small class="titlet">Dosis:</small></td>
                                                <td ><small class="titlet">Vía.admi:</small></td>
                                                <td ><small class="titlet">Frecuencia:</small></td>
                                                <td ><small class="titlet">Duración:</small></td>
                                            </tr>
                                                @foreach($recet->medicamentos as $da)
                                                <tr>
                                                    <td >{{$da->producto}}</td>
                                                    <td >{{$da->presentacion_}}</td>
                                                    <td >{{$da->cie10}}</td>
                                                    <td >{{$da->cantidad}}</td>
                                                    <td >{{$da->dosis}}</td>
                                                    <td >{{$da->via_administracion}}</td>
                                                    <td >{{$da->frecuencia}}</td>
                                                    <td >{{$da->duracion}}</td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        @endif
                                        
                                        @if(count($datos->examenes)>0)

                                        <tr>
                                            <td colspan="8"><small class="titlet">Exámenes auxiliares:</small>
                                            
                                                @foreach($datos->examenes as $exa)
                                                    @foreach($exa->examenes as $a)
                                                    {{$a->examen}},
                                                    @endforeach
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endif
                                        @if(count((array)$datos->descansosmedico) != 0)

                                        <tr>
                                            <td colspan="8"><small class="titlet">Descanso médico</small>  </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Presuncion diagnostica :</small> 
                                            
                                                <?php
                                                    $presuncion_diagnostica = explode(",", $datos->descansosmedico->presuncion_diagnostica);
                                                    $key = array_search($u,array_column($diag,'cie10'))
                                                ?>
                                                 @foreach($presuncion_diagnostica as $u)
                                                    <?php
                                                        $key = array_search($u,array_column($diag,'cie10'))
                                                    ?>
                                                    
                                                    {{$diag[$key]->diagnostico}},
                                                   
                                                @endforeach
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Periodo :</small> {{$datos->descansosmedico->periodo}} días </td>

                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <br>
                                <br>
                            </div>
            
                            @endforeach

                            
                        
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>

@endsection



