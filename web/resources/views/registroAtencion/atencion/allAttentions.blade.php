<html>
    <head>
        <title>Sanna</title>
        <meta name="csrf-token" content="{{ csrf_token() ?? '' }}">
        <link rel="icon" type="image/png" href="{{ URL::asset('/assets/images/logo/favicon.png') ?? '' }}" sizes="64x64">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="base_url" content="{{ URL::to('/') ?? '' }}">

        <link href="{{ URL::asset('/assets/css/bootstrap.min.css')?? '' }}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/all.min.css')?? '' }}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/sanna/tables.css')?? '' }}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/navbar/navbar.css')?? '' }}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/dashboard/dashboard.css')?? '' }}" rel="stylesheet">

    </head>
    <body>
        <div class="container-fluid" id="content">
            <div class="row justify-content-center">
                <div class="col-md-10 mx-auto">
                    <div class="divPrin">
                        <div class="row justify-content-center">

                            @foreach($antenciones->data as $datos)

                            <!--------formato filiación-------->
                        
                            
                            <div class="col-md-10 mx-auto">
                                <div class="row filaa">
                                    <div class="col-md-4">
                                        <img src="{{ asset('/assets/images/logo/sanna.png') ?? '' }}" alt="*"  class="img-fluid log">
                                    </div>
                                    <div class="col-md-4">
                                        <h6 id="divici">División Ambulatoria</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <h6 id="divici">FORMATO DE FILIACIÓN</h6>
                                        <?php
                                            echo  $datos->dni."-".str_pad($datos->idatencion, 5, "0",STR_PAD_LEFT);
                                        ?>

                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            @if($datos->tipo_atencion==0)

                                            <td><small class="titlet">Código de afiliado:</small>
                                                {{$datos->hoja_filiacion->codigo_afi?? '' }}
                                            </td>
                                            @else
                                            <td><small class="titlet">#documento del paciente:</small>
                                                {{$datos->dni?? '' }}  
                                            </td>
                                            @endif
                                            <td >
                                                @foreach($tipos->data as $t)
                                                    @if($datos->idtiposeguro==$t->idtiposeguro)
                                                    <small class="titlet">{{$t->seguro?? '' }}:</small> X
                                                    @endif
                                                @endforeach
                                            </td>
                                                  
                                            <td ><small class="titlet">Fecha:</small>
                                            {{$datos->fec_atencion?? '' }}
                                            </td>
                                        </tr>
                                        <tr >
                                            <td colspan="3"><small class="titlet2">IDENTIFICACIÓN</small></td>
                                        </tr>
                                        <tr >
                                            <td colspan="3"><small class="titlet">Apellidos y nombres:</small>
                                            {{$datos->nombres?? '' }} {{$datos->ape_paterno?? '' }} {{$datos->ape_materno?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><small class="titlet">Edad:</small> {{$datos->hoja_consulta->edad?? '' }}</td>
                                            <td><small class="titlet">Sexo:</small> 
                                                @if($datos->sexo==1)
                                                    M
                                                @endif
                                                @if($datos->sexo==2)
                                                    F
                                                @endif
                                            </td>
                                            <td></td>
                                            <!-- <td><small class="titlet">Raza/Etnia:</small> {{$datos->hoja_filiacion->etnia?? '' }}</td> -->
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <!-- <td><small class="titlet">Idioma:</small> {{$datos->hoja_filiacion->idioma?? '' }}</td> -->
                                            <td width="30%"><small class="titlet">Religión: </small> {{$datos->hoja_filiacion->religion?? '' }}</td>
                                            <td><small class="titlet">Estado civil: </small> {{$datos->hoja_filiacion->estadocivil?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><small class="titlet">Grado de instrucción:</small> {{$datos->hoja_filiacion->gradoinstitucion?? '' }}</td>
                                            <td colspan="2"><small class="titlet">Ocupación:</small> {{$datos->hoja_filiacion->ocupacion?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><small class="titlet">Fecha de nacimiento:</small> {{$datos->fec_nacimiento?? '' }}</td>
                                            <td colspan="2"><small class="titlet">Procedencia:</small> {{$datos->hoja_filiacion->procedencia?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><small class="titlet">Domicilio actual:</small> {{$datos->domicilio?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><small class="titlet">Número de celular:</small> {{$datos->telf_1?? '' }}</td>
                                            <td colspan="2"><small class="titlet">Núm. de DNI:</small> {{$datos->dni?? '' }}</td>
                                        </tr>
                                        @if(isset($datos->hoja_filiacion->email))
                                        <tr >
                                            <td colspan="3"><small class="titlet">Correo electrónico:</small>
                                            {{$datos->hoja_filiacion->email?? '' }} 
                                            </td>
                                        </tr>
                                        @endif
                                        <tr >
                                            <td colspan="3"><small class="titlet2">ANTECEDENTES</small></td>
                                        </tr>
                                        <tr>
                                            <td ><small class="titlet">Antecedentes personales</small></td>
                                            <td colspan="2" rowspan=3><small class="titlet">Antecedentes heredo-familiares</small>
                                                <div class="pad">
                                                <small class="titlet">Padres:</small> {{$datos->hoja_filiacion->padres?? '' }}
                                                </div>

                                                <div class="pad">
                                                <small class="titlet">Abuelos:</small> {{$datos->hoja_filiacion->padres?? '' }}
                                                </div>
                                                <div class="pad">
                                                <small class="titlet">Hermanos:</small> {{$datos->hoja_filiacion->hermanos?? '' }}
                                                </div>
                                                <div class="pad">
                                                <small class="titlet">Cónyuge:</small> {{$datos->hoja_filiacion->conyugue?? '' }}
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td ><small class="titlet">No patológicos:</small>
                                            @if(count($datos->hoja_filiacion->no_patologico))
                                                @foreach($datos->hoja_filiacion->no_patologico as $np)
                                                    {{$np->nombre?? '' }},
                                                
                                                @endforeach
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td ><small class="titlet">Patológicos:</small>
                                            @if(count($datos->hoja_filiacion->patologicos))
                                                @foreach($datos->hoja_filiacion->patologicos as $pa)
                                                
                                                    {{$pa->nombre?? '' }},
                                                
                                                @endforeach
                                            @endif
                                            </td>
                                        </tr>
                                        
                                        <tr >
                                            <td colspan="3"><small class="titlet2">INFORMACIÓN EN CASO DE EMERGENCIA</small></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><small class="titlet">Alergías medicamentos/alimentarias:</small> {{$datos->alergias?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><small class="titlet">Grupo sanguíneo/Rh:</small> {{$datos->grupos_factorh?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><small class="titlet">Núm. de celular de persona responsable:</small> {{$datos->hoja_filiacion->celular_responsble?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><small class="titlet">Núm. de teléfono de casa del paciente:</small> {{$datos->hoja_filiacion->tlf_casa_paciente?? '' }}</td>
                                        </tr>
                                    <tr >
                                            <td height="70"></td>
                                            <td height="70" colspan="2" ></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><small class="titlet  text-center">Firma y sello del médico</small>
                                                <div class="row justify-content-center">
                                                    <br>
                                                    <div class="col-md-6">
                                                        <img class="img-fluid" src="{{$datos->firmadoctor?? '' }}" alt="">
                                                    </div>
                                                    <div class="col-md-6">
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="2" class="text-center"><small class="titlet text-center">Nombres y apellidos y DNI del paciente</small>
                                                <div>
                                                {{$datos->nombres?? '' }} {{$datos->ape_paterno?? '' }} {{$datos->ape_materno?? '' }}
                                                </div>
                                                <div>
                                                {{$datos->dni?? '' }}
                                                </div>
                                                <div>
                                                <img src="{{$datos->firmaatencion?? '' }}" class="img-fluid" alt="">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                        
                            </div>
                     
                        
                            <!--------hoja consulta-------->

                            <div class="col-md-10 mx-auto">
                                <div class="row filaa">
                                    <div class="col-md-4">
                                        <img src="{{ asset('/assets/images/logo/sanna.png') ?? '' }}" alt="*"  class="img-fluid log">
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
                                            <td colspan="6"><small class="titlet">Apellidos y nombres:</small>
                                            {{$datos->nombres?? '' }}  {{$datos->ape_paterno?? '' }} {{$datos->ape_materno?? '' }}                                    
                                            </td>
                                            <td colspan="2"><small class="titlet">Edad:</small>
                                            {{$datos->hoja_consulta->edad?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            @if($datos->tipo_atencion==0)
                                            <td colspan="2"><small class="titlet">Código de afiliado:</small> 
                                            {{$datos->hoja_filiacion->codigo_afi?? '' }}
                                            @else
                                            <td colspan="2">
                                                <small class="titlet">#documento del paciente: </small> 
                                                {{$datos->dni?? '' }}                                    
                                            @endif
                                            </td>
                                            <td colspan="2">
                                                @foreach($tipos->data as $t)
                                                    @if($datos->idtiposeguro==$t->idtiposeguro)
                                                    <small class="titlet">{{$t->seguro?? '' }}:</small> X
                                                    @endif
                                                @endforeach
                                            </td>
                                            
                                            <td colspan="2"><small class="titlet">Fecha: </small> {{$datos->hoja_consulta->fecha?? '' }}</td>
                                            <td colspan="2"><small class="titlet">Hora: </small> {{$datos->hoja_consulta->hora?? '' }}</td>

                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Nombre del contratante: </small> 
                                               @if(isset($datos->hoja_filiacion->NombreContratante))
                                                   {{($datos->hoja_filiacion->NombreContratante!=-1)?$datos->hoja_filiacion->NombreContratante:'Cortesía'}}     
                                               @endif
                                          
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
                                        <tr >
                                            <td colspan="8"><small class="titlet2">AMANMESIS</small></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Motivo de consulta:</small> {{$datos->hoja_consulta->motivo_consulta?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><small class="titlet">Forma de inicio:</small> {{$datos->hoja_consulta->forma_inicio?? '' }}</td>
                                            <td colspan="2"><small class="titlet">Curso:</small> {{$datos->hoja_consulta->curso?? '' }}</td>
                                            <td colspan="3"><small class="titlet">Tiempo de enfermedad:</small> {{$datos->hoja_consulta->tiempo_enfermedad?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Relato cronológico:</small> {{$datos->hoja_consulta->relato_cronologico?? '' }}</td>
                                        </tr>
                                        <tr >
                                            <td colspan="8"><small class="titlet2">Antecedentes </small></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><small class="titlet">FUR:</small> {{$datos->hoja_consulta->fur?? '' }} </td>
                                            <td colspan="4"><small class="titlet">RAM:</small> {{$datos->hoja_consulta->ram?? '' }} </td>
                                        </tr>
                                        <tr >
                                            <td colspan="8"><small class="titlet2">FUNCIONES BIOLÓGICAS </small></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><small class="titlet">Apetito:</small>  {{$datos->hoja_consulta->apetito?? '' }}</td>
                                            <td colspan="2"><small class="titlet">Sed:</small>  {{$datos->hoja_consulta->sed?? '' }}</td>
                                            <td colspan="3"><small class="titlet">Sueño:</small>  {{$datos->hoja_consulta->suenho?? '' }}</td>

                                        </tr>
                                        <tr>
                                            <td colspan="4"><small class="titlet">Orina:</small> 
                                            @foreach($orina->data as $o)
                                                @isset($datos->hoja_consulta->orina->id)
                                                @if($o->id==$datos->hoja_consulta->orina->id)
                                                    {{$o->nombre?? '' }} <small class="titlet">Comentario:</small>{{$datos->hoja_consulta->orina->comentario?? '' }}
                                                @endif
                                                @endisset
                                        
                                            @endforeach
                                            </td>
                                            <td colspan="4"><small class="titlet">Deposiciones:</small> 
                                            @foreach($dispo->data as $dis)
                                                @isset($datos->hoja_consulta->deposiciones->id)
                                                @if($dis->id==$datos->hoja_consulta->deposiciones->id)
                                                    {{$dis->nombre?? '' }} <small class="titlet">Comentario:</small>{{$datos->hoja_consulta->deposiciones->comentario?? '' }}
                                                @endif
                                                @endisset
                                        
                                            @endforeach
                                            </td>
                                        </tr>
                                        <tr >
                                            <td colspan="8"><small class="titlet2">FUNCIONES VITALES</small></td>
                                        </tr>
                                        <tr>
                                            <td ><small class="titlet">T:</small>  {{$datos->hoja_consulta->tem?? '' }} °C</td>
                                            <td><small class="titlet">PA:</small> {{$datos->hoja_consulta->pa?? '' }} mmHg</td>
                                            <td><small class="titlet">FC:</small> {{$datos->hoja_consulta->fc?? '' }} x’</td>
                                            <td><small class="titlet">FR:</small>  {{$datos->hoja_consulta->fr?? '' }} x’</td>
                                            <td><small class="titlet">Peso:</small> {{$datos->hoja_consulta->peso?? '' }} Kg</td>
                                            <td><small class="titlet">Talla:</small> {{$datos->hoja_consulta->talla?? '' }} m</td>
                                            <td><small class="titlet">IMC:</small> {{$datos->hoja_consulta->imc?? '' }} Kg/m2</td>

                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet2">Saturación</small> {{$datos->hoja_consulta->saturacion?? '' }} %</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet2">Examen clínica regional </small></td>
                                        </tr>
                                       @isset($datos->hoja_consulta->clinica_regional)
                                        @if(count($datos->hoja_consulta->clinica_regional)>0)
                                            @foreach($datos->hoja_consulta->clinica_regional as $c)
                                            @if(!empty($c->estadogeneral))
                                            <tr >
                                                <td colspan="8">{{$c->nombre?? '' }} : {{$c->estadogeneral?? '' }}</td>
                                            </tr>
                                            @endif
                                            @if(!empty($c->estadoconciencia))
                                            <tr>
                                                <td colspan="8">{{$c->nombre?? '' }} : {{$c->estadoconciencia?? '' }}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        @endif
                                        @endisset
                                       
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
                                                <td colspan="8">{{$diag[$key]->diagnostico?? '' }} - cie10: {{$u?? '' }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="8"><small class="titlet2">TRATAMIENTO:</small></td>
                                        </tr>
                                        @if(count($datos->recetas)>0)
                                            @foreach($datos->recetas as $recet)
                                            @if($recet->tipo==0)
                                                <tr>
                                                    <td colspan="8"><small class="titlet">Número de receta:</small>
                                                        Bot.interna :   {{$recet->idreceta?? '' }}
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
                                                    <td ><small class="titlet">Vía.admi:</small></td>
                                                    <td ><small class="titlet">Frecuencia:</small></td>
                                                    <td ><small class="titlet">Duración:</small></td>
                                                </tr>
                                                @foreach($recet->medicamentos as $da)
                                                <tr>
                                                    <td >{{$da->producto?? '' }}</td>
                                                    <td >{{$da->presentacion?? '' }}</td>
                                                    <td >{{$da->cie10?? '' }}</td>
                                                    <td >{{$da->cantidad?? '' }}</td>
                                                    <td >{{$da->via_administracion?? '' }}</td>
                                                    <td >{{$da->frecuencia?? '' }}</td>
                                                    <td >{{$da->duracion?? '' }}</td>
                                                </tr>
                     
                                                @endforeach
                                            @endif
                                            @if($recet->tipo==1)
                                                <tr>
                                                    <td colspan="8"><small class="titlet">Número de receta:</small>
                                                        Bot.ext :   {{$recet->idreceta?? '' }}
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
                                                    <td ><small class="titlet">Vía.admi:</small></td>
                                                    <td ><small class="titlet">Frecuencia:</small></td>
                                                    <td ><small class="titlet">Duración:</small></td>
                                                </tr>
                                                @foreach($recet->medicamentos as $da)
                                                <tr>
                                                    <td >{{$da->producto?? '' }}</td>
                                                    <td >{{$da->presentacion?? '' }}</td>
                                                    <td >{{$da->cie10?? '' }}</td>
                                                    <td >{{$da->cantidad?? '' }}</td>
                                                    <td >{{$da->via_administracion?? '' }}</td>
                                                    <td >{{$da->frecuencia?? '' }}</td>
                                                    <td >{{$da->duracion?? '' }}</td>
                                                </tr>
                     
                                                @endforeach
                                            @endif
                                            @endforeach
                                        @endif
                                        
                                        @if(count($datos->examenes)>0)

                                        <tr>
                                            <td colspan="8"><small class="titlet">Exámenes auxiliares:</small>
                                            
                                                @foreach($datos->examenes as $exa)
                                                    @foreach($exa->examenes as $a)
                                                    {{$a->examen?? '' }},
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
                                                $presuncion_diagnostica = explode(',',$datos->descansosmedico->presuncion_diagnostica);
                                                $diag=[];
                                                foreach($dianostics->data as $item){
                                                    $diag[]=$item;
                                                }
                                                
                                            ?>
                                               @foreach($presuncion_diagnostica as $u)
                                                <?php
                                                    $key = array_search($u,array_column($diag,'cie10'))
                                                ?>
                                                {{$diag[$key]->diagnostico?? '' }},
                                               @endforeach
                                            
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="8"><small class="titlet">Periodo :</small> {{$datos->descansosmedico->periodo?? '' }} días </td>

                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="4" class="text-center"><small class="titlet  text-center">Firma y sello del médico</small>
                                                <div class="row justify-content-center">
                                                    <br>
                                                    <div class="col-md-6">
                                                        <img style="max-width:150px" class="img-fluid" src="{{$datos->firmadoctor?? '' }}" alt="">
                                                    </div>
                                                    <div class="col-md-6">
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="4" class="text-center"><small class="titlet text-center">Nombres y apellidos y DNI del paciente</small>
                                                <div>
                                                {{$datos->nombres?? '' }} {{$datos->ape_paterno?? '' }} {{$datos->ape_materno?? '' }}
                                                </div>
                                                <div>
                                                {{$datos->dni?? '' }}
                                                </div>
                                                <div>
                                                <img  style="max-width:150px" src="{{$datos->firmaatencion?? '' }}" class="img-fluid" alt="">
                                                </div>
                                            </td>
                                        </tr>
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
    </body>

</html>

  

