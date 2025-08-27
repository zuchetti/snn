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
                    <div class="col-md-10">
                        <a href="{{url('finish_attention')}}"><img src="{{ asset('/assets/images/dashboard/back.svg') }}" alt="*"  class="img-fluid"></a>  <br><br>
                    </div>
                    <div class="col-md-10 mx-auto">
                        <div class="row filaa">
                            <div class="col-md-4">
                                <img src="{{ asset('/assets/images/logo/sanna.png') }}" alt="*"  class="img-fluid log">
                            </div>
                            <div class="col-md-4">
                                <h6 id="divici">División Ambulatoria</h6>
                            </div>
                            <div class="col-md-4">
                                <h6 id="divici">FORMATO DE FILIACIÓN</h6>
                                <?php
                                 echo  session('paciente')->num_doc."-".str_pad($datos->idatencion, 5, "0",STR_PAD_LEFT);
                                ?>
                            </div>
                            
                        </div>
                    </div>
                    <?php
                        function edad($fecha){
                            $dias = explode("-", $fecha, 3);
                            $dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
                            $edad = (int)((time()-$dias)/31556926 );
                            return $edad;
                        }
                        $fechanacimiento=date("d-m-Y", strtotime($datos->fec_nacimiento));

                    ?>
                    <div class="col-md-10 mx-auto">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    @if(session('paciente')->tipo_atencion==0)
                                    <td><small class="titlet">Código de afiliado:</small>
                                    {{$datos->hoja_filiacion->codigo_afi}}
                                    </td>
                                    @endif
                                    @if(session('paciente')->tipo_atencion==1)
                                    <td><small class="titlet">#documento del paciente:</small>
                                        {{session('paciente')->num_doc}}
                                    </td>
                                    @endif
                                    @if(session('filiacion')!=null)
                                    <td >
                                        @foreach($tipos->data as $t)
                                            @if(session('filiacion')->idtiposeguro==$t->idtiposeguro)
                                            <small class="titlet">{{$t->seguro}}:</small> X
                                            @endif
                                        @endforeach
                                    </td>
                                    @endif
                                    <td colspan="2"><small class="titlet">Fecha:</small>
                                    {{$datos->fec_atencion}}
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="3"><small class="titlet2">IDENTIFICACIÓN</small></td>
                                </tr>
                                <tr >
                                    <td colspan="3"><small class="titlet">Apellidos y nombres:</small>
                                    {{$datos->nombres}} {{$datos->ape_paterno}} {{$datos->ape_materno}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="titlet">Edad:</small> {{edad($fechanacimiento)}}</td>
                                    <td><small class="titlet">Sexo:</small> 
                                    @if($datos->sexo==1)
                                     M
                                                
                                    @endif
                                    @if($datos->sexo==2)
                                        F
                                    @endif
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><small class="titlet">Religión: </small> {{$datos->hoja_filiacion->religion}}</td>
                                    <td><small class="titlet">Estado civil: </small> {{$datos->hoja_filiacion->estadocivil}}</td>
                                </tr>
                                <tr>
                                    <td><small class="titlet">Grado de instrucción:</small> {{$datos->hoja_filiacion->gradoinstitucion}}</td>
                                    <td colspan="2"><small class="titlet">Ocupación:</small> {{$datos->hoja_filiacion->ocupacion}}</td>
                                </tr>
                                <tr>
                                    <td><small class="titlet">Fecha de nacimiento:</small> {{$datos->fec_nacimiento}}</td>
                                    <td colspan="2"><small class="titlet">Procedencia:</small> {{$datos->hoja_filiacion->procedencia}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><small class="titlet">Domicilio actual:</small> {{$datos->domicilio}}</td>
                                </tr>
                                <tr>
                                    <td><small class="titlet">Número de celular:</small> {{$datos->telf_1}}</td>
                                    <td colspan="2"><small class="titlet">Núm. de DNI:</small> {{$datos->dni}}</td>
                                </tr>
                                @if(isset($datos->hoja_filiacion->email))
                                <tr >
                                    <td colspan="3"><small class="titlet">Correo electrónico:</small>
                                    {{$datos->hoja_filiacion->email}} 
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
                                        <small class="titlet">Padres:</small> {{$datos->hoja_filiacion->padres}}
                                        </div>

                                        <div class="pad">
                                        <small class="titlet">Abuelos:</small> {{$datos->hoja_filiacion->abuelos}}
                                        </div>
                                        <div class="pad">
                                        <small class="titlet">Hermanos:</small> {{$datos->hoja_filiacion->hermanos}}
                                        </div>
                                        <div class="pad">
                                        <small class="titlet">Cónyuge:</small> {{$datos->hoja_filiacion->conyugue}}
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <td ><small class="titlet">No patológicos:</small>
                                    @if(count($datos->hoja_filiacion->no_patologico))
                                    @foreach($datos->hoja_filiacion->no_patologico as $np)
                                    
                                        {{$np->nombre}},
                                    
                                    @endforeach
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td ><small class="titlet">Patológicos:</small>
                                    @if(count($datos->hoja_filiacion->patologicos))
                                    @foreach($datos->hoja_filiacion->patologicos as $pa)
                                    
                                        {{$pa->nombre}},
                                    
                                    @endforeach
                                    @endif
                                    </td>
                                </tr>
                                  
                                <tr >
                                    <td colspan="3"><small class="titlet2">INFORMACIÓN EN CASO DE EMERGENCIA</small></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><small class="titlet">Alergías medicamentos/alimentarias:</small> {{$datos->alergias}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><small class="titlet">Grupo sanguíneo/Rh:</small> {{$datos->grupos_factorh}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><small class="titlet">Núm. de celular de persona responsable:</small> {{$datos->hoja_filiacion->celular_responsble}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><small class="titlet">Núm. de teléfono de casa del paciente:</small> {{$datos->hoja_filiacion->tlf_casa_paciente}}</td>
                                </tr>
                               <tr >
                                    <td height="70"></td>
                                    <td height="70" colspan="2" ></td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                       
                                        <div class="row justify-content-center">
                                            <br>
                                            
                                            <div class="col-md-6 mb-3">
                                                @if(isset(session('medico')->data[0]->info[0]->firma))
                                                
                                                <img class="img-fluid col-md-9" src="{{str_replace('https://200.48.199.90:8002','https://racso.doctormas.com.pe',session('medico')->data[0]->info[0]->firma)}}" alt="">
                                                @endif
                                            </div>
                                           
                                        </div>
                                        <small class="titlet  text-center">Firma y sello del médico</small>
                                    </td>
                                    
                                    <td colspan="2" class="text-center">
                                        <small class="titlet text-center">Nombres y apellidos y DNI del paciente</small>
                                        <div>
                                            {{$datos->nombres}} {{$datos->ape_paterno}} {{$datos->ape_materno}}
                                        </div>
                                        <div>
                                            {{$datos->dni}}
                                        </div>
                                        @if(isset($datos->firma))
                                        <div>
                                         <img src="{{$datos->firma}}" class="img-fluid" alt="">
                                        </div>
                                        @endif
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

