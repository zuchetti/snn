@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/tables.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='finalizar';
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-10 mx-auto">
            <div class="divPrin">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <a href="{{url('finish_attention')}}"><img src="{{ asset('/assets/images/dashboard/back.svg') }}" alt="*"  class="img-fluid"></a>  <br><br>
                    </div>
                  
                    <div class="col-md-12 mx-auto">
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
                                 echo  session('paciente')->num_doc."-".str_pad($datos->idatencion, 5, "0",STR_PAD_LEFT);
                                ?>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-md-12 mx-auto">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="5"><small class="titlet">Apellidos y nombres:</small>
                                    {{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}
                                    </td>
                                    <td colspan="3"><small class="titlet">Edad:</small>
                                    {{$datos->hoja_consulta->edad}}
                                    </td>
                                </tr>
                                <tr>
                                    @if(session('paciente')->tipo_atencion==0)
                                    <td colspan="2"><small class="titlet">Código de afiliado:</small> 
                                     {{session('paciente')->CodigoAfiliado}}
                                    @else
                                    <td colspan="2">
                                        <small class="titlet">#documento del paciente:</small> 
                                        {{session('paciente')->num_doc}}
                                    @endif
                                    </td>
                                    @if(session('filiacion')!=null)
                                    <td colspan="2">
                                        @foreach($tipos->data as $t)
                                            @if(session('filiacion')->idtiposeguro==$t->idtiposeguro)
                                            <small class="titlet">{{$t->seguro}}:</small> X
                                            @endif
                                        @endforeach
                                    </td>
                                    @endif
                                    <td colspan="2"><small class="titlet">Fecha: </small> {{$datos->hoja_consulta->fecha}}</td>
                                    <td colspan="2"><small class="titlet">Hora: </small> {{$datos->hoja_consulta->hora}}</td>

                                </tr>
                                <tr>
                                    <td colspan="8"><small class="titlet">Nombre del contratante: </small> 
                                       @if($afiliacion->hoja_filiacion->NombreContratante!=-1)
                                        {{$afiliacion->hoja_filiacion->NombreContratante}}
                                        @else 
                                        Cortesía
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8"><small class="titlet">Tipo de Atención: </small> 
                                        @if($afiliacion->idmodalidad==0)
                                            Telemedicina
                                        @else
                                            Presencial
                                        @endif
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="8"><small class="titlet2">AMANMESIS</small></td>
                                </tr>
                                <tr>
                                    <td colspan="8"><small class="titlet">Motivo de consulta:</small> {{$datos->hoja_consulta->motivo_consulta}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><small class="titlet">Forma de inicio:</small> {{$datos->hoja_consulta->forma_inicio}}</td>
                                    <td colspan="3"><small class="titlet">Curso:</small> {{$datos->hoja_consulta->curso}}</td>
                                    <td colspan="2"><small class="titlet">Tiempo de enfermedad:</small> {{$datos->hoja_consulta->tiempo_enfermedad}}</td>
                                </tr>
                                <tr>
                                    <td colspan="8"><small class="titlet">Relato cronológico:</small> {{$datos->hoja_consulta->relato_cronologico}}</td>
                                </tr>
                                <tr >
                                    <td colspan="8"><small class="titlet2">Antecedentes </small></td>
                                </tr>
                                <tr>
                                    @if(!empty($datos->hoja_consulta->fur))
                                    <td colspan="4"><small class="titlet">FUR:</small> {{$datos->hoja_consulta->fur}} </td>
                                    @else 
                                    <td colspan="4"><small class="titlet">FUR:</small>No aplica</td>
                                    @endif
                                    <td colspan="4"><small class="titlet">RAM:</small> {{$datos->hoja_consulta->ram}} </td>
                                </tr>
                                <tr >
                                    <td colspan="8"><small class="titlet2">FUNCIONES BIOLÓGICAS </small></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><small class="titlet">Apetito:</small>  {{$datos->hoja_consulta->apetito}}</td>
                                    <td colspan="3"><small class="titlet">Sed:</small>  {{$datos->hoja_consulta->sed}}</td>
                                    <td colspan="3"><small class="titlet">Sueño:</small>  {{$datos->hoja_consulta->suenho}}</td>

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
                                    <td><small class="titlet">IMC:</small> {{$datos->hoja_consulta->imc}} Kg/m2</td>

                                </tr>
                                <tr>
                                    <td colspan="8"><small class="titlet">Saturación:</small> {{$datos->hoja_consulta->saturacion}} %</small></td>
                                </tr>
                                <tr>
                                    <td colspan="8"><small class="titlet2">Examen clínica regional </small></td>
                                </tr>
                        
                                @if(count($datos->hoja_consulta->clinica_regional)>0)
                                    @foreach($datos->hoja_consulta->clinica_regional as $c)
                                         @if(!empty($c->estadogeneral))
                                        <tr >
                                            <td colspan="8">{{$c->nombre}} : {{$c->estadogeneral}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($c->estadoconciencia))
                                        <tr>
                                            <td colspan="8">{{$c->nombre}} : {{$c->estadoconciencia}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endif
                              
                                <tr>
                                    <td colspan="8"><small class="titlet2">DIAGNÓSTICO:</small></td>
                                </tr>

                                <?php
                                    $presuncion_diagnostica = explode(',',$datos->cie10);
                                    $diag=[];
                                    foreach($dianostics->data as $item){
                                        $diag[]=$item;
                                    }
                                ?>
                                @foreach($presuncion_diagnostica as $u)
                                    <?php
                                        $key = array_search($u,array_column($diag,'cie10'))
                                    ?>
                                    <tr>
                                        <td colspan="8">{{$diag[$key]->diagnostico}} - cie10: {{$u}}</td>
                                    </tr>
                                     
                                @endforeach
                               
                              
                              
                                @if(session('receta')!=null)
                                    <tr>
                                        <td colspan="8"><small class="titlet2">TRATAMIENTO:</small></td>
                                    </tr>
                                    @if(session('receta')->idreceta_h_bot!=0)
                                    <tr>
                                        <td colspan="8"><small class="titlet">Número de receta:</small>
                                            Bot.interna: {{session('receta')->idreceta_h_bot}}
                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet2">Tratamiento Farmacológico:</small></td>
                                    </tr>
                                    <tr class="medic">
                                        <td><small class="titlet3">Medicamento:</small></td>
                                        <td ><small class="titlet3">Present:</small></td>
                                        <td><small class="titlet3"> CIE-10:</small></td>
                                        <td ><small class="titlet3">Cant:</small></td>
                                        <td><small class="titlet3">Dosis:</small></td>
                                        <td><small class="titlet3">Vía.admi:</small></td>
                                        <td ><small class="titlet3">Frecuencia:</small></td>
                                        <td ><small class="titlet3">Duración:</small></td>
                                    </tr>
                                    @foreach(session('receta')->medicamentoslista as $rec)
                                    @if($rec->fuente==0)
                                    <tr>
                                        <td>{{$rec->producto}}</td>
                                        <td>{{$rec->presentacion_}}</td>
                                        <td>{{$rec->cie10}}</td>
                                        <td>{{$rec->cantidad}}</td>
                                        <td>{{$rec->dosis}}</td>
                                        <td>{{$rec->via_administracion}}</td>
                                        <td>{{$rec->frecuencia}}</td>
                                        <td>{{$rec->duracion}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                    @if(session('receta')->idreceta_h_ext!=0)
                                    <tr>
                                        <td colspan="8"><small class="titlet">Número de receta:</small>
                                            Bot.ext: {{session('receta')->idreceta_h_ext}}
                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet2">Tratamiento Farmacológico:</small></td>
                                    </tr>
                                    <tr class="medic">
                                        <td><small class="titlet3">Medicamento:</small></td>
                                        <td ><small class="titlet3">Present:</small></td>
                                        <td><small class="titlet3"> CIE-10:</small></td>
                                        <td ><small class="titlet3">Cant:</small></td>
                                        <td><small class="titlet3">Dosis:</small></td>
                                        <td><small class="titlet3">Vía.admi:</small></td>
                                        <td ><small class="titlet3">Frecuencia:</small></td>
                                        <td ><small class="titlet3">Duración:</small></td>
                                    </tr>
                                    @foreach(session('receta')->medicamentoslista as $rec)
                                    @if($rec->fuente==1)
                                    <tr>
                                        <td>{{$rec->producto}}</td>
                                        <td>{{$rec->presentacion_}}</td>
                                        <td>{{$rec->cie10}}</td>
                                        <td>{{$rec->cantidad}}</td>
                                        <td>{{$rec->dosis}}</td>
                                        <td>{{$rec->via_administracion}}</td>
                                        <td>{{$rec->frecuencia}}</td>
                                        <td>{{$rec->duracion}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                @endif
                               
                                <tr>
                                    <td colspan="8"><small class="titlet">Exámenes auxiliares:</small>
                                    @if(session('examenes')!=null)
                                        @if(isset($examenes->lab->examenlista))
                                            @foreach($examenes->lab->examenlista as $e)
                                                    {{$e->examen}},
                                            @endforeach
                                        @endif
                                        @if(isset($examenes->img->examenlista))
                                        
                                            @foreach($examenes->img->examenlista as $i)
                                                    {{$i->examen}},
                                            @endforeach
                                        @endif
                                    @endif
                                    </td>
                                </tr>
                               
                                @if(session('descanso')!=null)
                                <tr>
                                    <td colspan="8"><small class="titlet">Descanso médico:</small></td>
                                </tr>
                                <tr>
                                    <td colspan="8"><small class="titlet">Presuncion diagnostica :</small>
                                    <?php
                                        $presuncion_diagnostica = explode(',',session('descanso')->presuncion_diagnostica);
                                        $diag=[];
                                        foreach($dianostics->data as $item){
                                            $diag[]=$item;
                                        }
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
                                    <td colspan="8"><small class="titlet">Periodo :</small>{{session('descanso')->periodo}} días </td>

                                </tr>
                                @endif

                                <tr>
                                    <td colspan="4" height="100" style="vertical-align:bottom;text-align:center;">
                                        
              
                                        <div class="row justify-content-center">
                                            <br>
                                            <div class="col-md-6 mb-3">
                                                @if(isset(session('medico')->data[0]->info[0]->firma))
                                                <img class="img-fluid col-md-9" src="{{str_replace('https://200.48.199.90:8002','https://racso.doctormas.com.pe',session('medico')->data[0]->info[0]->firma)}}" alt="">
                                                @endif
                                            </div>
                                           
                                        </div>
                                        <small class="titlet">Firma y sello del médico</small>

                                    </td>
                                </tr>
                                
                           
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>




@endsection

