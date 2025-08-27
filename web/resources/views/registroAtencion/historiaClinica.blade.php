@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/historiaClinica.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='history';
    @endphp
  
    <div class="row justify-content-center">
        <div class="col-md-10 mx-auto">
            <div class="divPrin">

                <?php
                    date_default_timezone_set("America/Lima");
                  
                ?>
                @if(session('paciente')!=null)
                <div class="row justify-content-center">
                    <div class="col-md-10 mx-auto">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1 class="title">Formato de filiación</h1>

                                @if(count($info->data)>0)
                                <div class="text-center">
                                    <a href="{{url('all_attentions')}}?dni={{session('paciente')->num_doc}}" target="_blank" id="atenc">Ver historial de atenciones</a>
                                </div> 

                                @endif

                                @if((count($info->data)>0 or session('filiacion')!=null) and session('finalizar')==null)
                                <div class="text-right">
                                    <i class="fas fa-edit update"></i>
                                </div>
                                @endif
                            </div>
                           
                        </div>
                     
                        <!------------identificacion--------------->
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="title">Identificación</h1>
                            </div>
                        </div>

                        <div class="row">
                            
                            @if(session('paciente')->tipo_atencion==0) 
                             <div class="col-md-4">
                                <label id="label">Código de afiliado:</label>
                                <input type="text" id="codigo_afi" disabled  
                                value="{{session('paciente')->CodigoAfiliado}}" class="input form-control form-control-sm">
                            </div>
                            @endif
                            <div class="col-md-4">
                                <label id="label">Fecha de atención:</label>
                                <input type="date" id="fec_atencion" disabled value="<?php echo date('Y-m-d') ?>" class="input form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <label id="label">Hora:</label>
                                <input type="time" id="hora_atencion" disabled value="<?php echo  date('h:i:s');?>" class="input form-control form-control-sm">
                            </div>
                         
                            <div class="col-md-6">
                                <label id="label">Seguro:</label>
                             
                                
                                @if(session('paciente')->iafas==20002)
                                <select  class="input form-control form-control-sm" disabled id="idtiposeguro" >
                                     @foreach($seguro->data as $item)
                                        <option value="{{$item->idtiposeguro}}" {{($item->idtiposeguro==1)? 'selected':''}}
                                        >{{$item->seguro}}</option>
                                    @endforeach
                                </select>
                                @elseif(session('paciente')->iafas==40004)
                                <select  class="input form-control form-control-sm" disabled id="idtiposeguro" >
                                    @foreach($seguro->data as $item)
                                        <option value="{{$item->idtiposeguro}}" {{($item->idtiposeguro==2)? 'selected':''}}
                                        >{{$item->seguro}}</option>
                                    @endforeach
                                </select>
                                @else
                                <select  class="input form-control form-control-sm" id="idtiposeguro" 
                                @if(session('filiacion')!=null)
                                    disabled
                                @else
                                    @if(isset($info->data[0]->idtiposeguro)) 
                                        disabled
                                    @else
                                    disabled
                                    @endif
                                @endif
                                
                                aria-label="Default select example">
                                    <option value=""></option>
                                        @foreach($seguro->data as $item)
                                        <option value="{{$item->idtiposeguro}}" 
                                        @if(session('filiacion')!=null)
                                            @if(session('filiacion')->idtiposeguro==$item->idtiposeguro) selected @endif
                                        @else
                                            @if(isset($info->data[0]->idtiposeguro)) 
                                                @if($info->data[0]->idtiposeguro==$item->idtiposeguro) selected @endif
                                            @endif
                                        @endif
                                        >{{$item->seguro}}</option>
                                    @endforeach
                                    <option value="-1"
                                   
                                    @if(session('filiacion')!=null)
                                        @if(session('filiacion')->idtiposeguro==-1) selected @endif
                                    @else
                                        @if(isset($info->data[0]->idtiposeguro)) 
                                                @if($info->data[0]->idtiposeguro==-1) selected @endif
                                        @else
                                        selected
                                        @endif
                                    @endif
                                    >POR CORTESÍA</option>
                                 
                                </select>
                              @endif
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label id="label">Apellidos y nombres:</label>
                                <input type="text" disabled value="{{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}" class="letras input form-control form-control-sm">
                               
                            </div>
                            <div class="col-md-6">
                                <label id="label">
                                    DNI/CE/Pasaporte
                                    <!-- @if(session('paciente')->tipo_doc==1)
                                        DNI:
                                    @endif
                                    @if(session('paciente')->tipo_doc==2)
                                    CARNET EXTRANJERIA
                                    @endif
                                    @if(session('paciente')->tipo_doc==3)
                                        PASAPORTE
                                    @endif
                                    @if(session('paciente')->tipo_doc==7)
                                        SIN DOC
                                    @endif -->
                                
                                </label>
                                <input type="text" id="dni" value="{{session('paciente')->num_doc}}" disabled onkeypress="return valideKey(event);" maxlength=9 class="input form-control form-control-sm">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <label id="label">Fecha de nac.:</label>
                                @php
                                    $date = str_replace("/", "-", session('paciente')->fec_nacimiento);
                                @endphp
                               
                                <input type="date" disabled value="{{date('Y-m-d', strtotime($date))}}"
                               class="input form-control form-control-sm">
                            </div>
                            <div class="col-md-3">
                                <label id="label">Edad:</label>
                                <input type="text" disabled value="{{session('paciente')->edad}}" onkeypress="return valideKey(event);" maxlength=2 class="input form-control form-control-sm">
                            </div>
                            <div class="col-md-3">
                                <label id="label">Sexo:</label>
                                <select id="sexo" disabled class="input form-control form-control-sm">
                                    <option value="1" @if(session('paciente')->sexo==1)  selected @endif>M</option>
                                    <option value="2" @if(session('paciente')->sexo==2)  selected @endif>F</option>
                                </select>
                            </div>

                            <div class="col-md-3 d-none">
                                <!-- <label id="label">Raza/Etnia:</label>
                                <input type="text" id="etnia"  
                                @if(isset(session('filiacion')->hoja_filiacion->etnia)) 
                                    value="{{session('filiacion')->hoja_filiacion->etnia}}" disabled
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->etnia)) 
                                        value="{{$info->data[0]->hoja_filiacion->etnia}}" 
                                        disabled
                                    @endif 
                                @endif
                                
                                 class="input form-control form-control-sm"> -->
                            </div>

                            <div class="col-md-3 d-none">
                                <!-- <label id="label">Idioma:</label>
                                <input type="text" id="idioma"  
                                @if(isset(session('filiacion')->hoja_filiacion->idioma)) 
                                    value="{{session('filiacion')->hoja_filiacion->idioma}}" disabled
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->idioma)) 
                                        value="{{$info->data[0]->hoja_filiacion->idioma}}" 
                                        disabled
                                    @endif 
                                @endif
                                 class="input form-control form-control-sm"> -->
                            </div>

                            <div class="col-md-3">
                                <label id="label">Religion:</label>
                                <input type="text" id="religion"  
                                @if(isset(session('filiacion')->hoja_filiacion->religion)) 
                                    value="{{session('filiacion')->hoja_filiacion->religion}}" 
                                    disabled
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->religion)) 
                                        value="{{$info->data[0]->hoja_filiacion->religion}}" 
                                        disabled
                                    @endif 
                                @endif
                                 class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-3">
                                <label id="label">Estado civil:</label>
                                <select id="estadocivil" @if(isset(session('filiacion')->hoja_filiacion->estadocivil) or isset($info->data[0]->hoja_filiacion->estadocivil)) disabled  
                                @endif class="input form-control form-control-sm">
                                    <option value=""></option>
                                    <option value="soltero(a)"
                                    @if(isset(session('filiacion')->hoja_filiacion->estadocivil)) 
                                        @if(session('filiacion')->hoja_filiacion->estadocivil=='soltero(a)')
                                        selected
                                        @endif
                                    @else 
                                        @if(isset($info->data[0]->hoja_filiacion->estadocivil)) 
                                            @if($info->data[0]->hoja_filiacion->estadocivil=='soltero(a)')
                                            selected
                                            @endif
                                        @endif 
                                    @endif
                                    >Soltero(a)
                                    </option>
                                    <option value="casado(a)"
                                    @if(isset(session('filiacion')->hoja_filiacion->estadocivil)) 
                                        @if(session('filiacion')->hoja_filiacion->estadocivil=='casado(a)')
                                        selected
                                        @endif
                                    @else 
                                        @if(isset($info->data[0]->hoja_filiacion->estadocivil)) 
                                            @if($info->data[0]->hoja_filiacion->estadocivil=='casado(a)')
                                            selected
                                            @endif
                                        @endif 
                                    @endif
                                    >Casado(a)</option>
                                    <option value="viudo(a)"
                                    @if(isset(session('filiacion')->hoja_filiacion->estadocivil)) 
                                        @if(session('filiacion')->hoja_filiacion->estadocivil=='viudo(a)')
                                        selected
                                        @endif
                                    @else 
                                        @if(isset($info->data[0]->hoja_filiacion->estadocivil)) 
                                            @if($info->data[0]->hoja_filiacion->estadocivil=='viudo(a)')
                                            selected
                                            @endif
                                        @endif 
                                    @endif
                                    >Viudo(a)</option>
                                    <option value="divorciado(a)"
                                    @if(isset(session('filiacion')->hoja_filiacion->estadocivil)) 
                                        @if(session('filiacion')->hoja_filiacion->estadocivil=='divorciado(a)')
                                        selected
                                        @endif
                                    @else 
                                        @if(isset($info->data[0]->hoja_filiacion->estadocivil)) 
                                            @if($info->data[0]->hoja_filiacion->estadocivil=='divorciado(a)')
                                            selected
                                            @endif
                                        @endif 
                                    @endif
                                    >Divorciado(a)</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label id="label">Grado de instrucción:</label>
                                <input type="text" id="gradoinstitucion"  
                                @if(isset(session('filiacion')->hoja_filiacion->gradoinstitucion)) 
                                    value="{{session('filiacion')->hoja_filiacion->gradoinstitucion}}" 
                                    disabled
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->gradoinstitucion)) 
                                        value="{{$info->data[0]->hoja_filiacion->gradoinstitucion}}" 
                                        disabled
                                    @endif 
                                @endif
                                 class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-4">
                                <label id="label">Ocupación :</label>
                                <input type="text" id="ocupacion"  
                                @if(isset(session('filiacion')->hoja_filiacion->ocupacion)) 
                                    value="{{session('filiacion')->hoja_filiacion->ocupacion}}"
                                    disabled
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->ocupacion)) 
                                        value="{{$info->data[0]->hoja_filiacion->ocupacion}}" 
                                        disabled
                                    @endif 
                                @endif
                                 class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-4">
                                <label id="label">Procedencia:</label>
                                <input type="text" id="procedencia"  
                                @if(isset(session('filiacion')->hoja_filiacion->procedencia)) 
                                    value="{{session('filiacion')->hoja_filiacion->procedencia}}"
                                    disabled 
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->procedencia)) 
                                        value="{{$info->data[0]->hoja_filiacion->procedencia}}" 
                                        disabled
                                    @endif 
                                @endif
                                 class="input form-control form-control-sm">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label id="label">Domicilio:</label>
                                <input type="text" id="domicilio"   
                                @if(isset(session('filiacion')->domicilio)) 
                                    value="{{session('filiacion')->domicilio}}" 
                                    disabled
                                @else 
                                    @if(isset($info->data[0]->domicilio)) 
                                        value="{{$info->data[0]->domicilio}}" 
                                        disabled
                                    @endif 
                                @endif
                                class=" input form-control form-control-sm">
                            </div>
                            <div class="col-md-3">
                                <label id="label">Numero de celular:</label>
                                <input type="text" id="telf_1" maxlength="9"
                                @if(isset(session('filiacion')->telf_1)) 
                                    value="{{session('filiacion')->telf_1}}" 
                                    disabled
                                @else 
                                    @if(isset($info->data[0]->telf1)) 
                                        value="{{$info->data[0]->telf1}}" 
                                        disabled
                                    @endif 
                                @endif
                                 maxlength=11 class="input form-control form-control-sm numbers">
                            </div>
                            <div class="col-md-3">
                                <label id="label">Correo electrónico personal</label>
                                <input type="text" id="correo" 
                                @if(isset(session('filiacion')->hoja_filiacion->email)) 
                                    value="{{session('filiacion')->hoja_filiacion->email}}" 
                                    disabled
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->email)) 
                                        value="{{$info->data[0]->hoja_filiacion->email}}" 
                                        disabled
                                    @endif 
                                @endif
                                class="input form-control form-control-sm">
                            </div>
                        </div>

                        <br>
                        <!----------antecendentes personales------------->
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="title">Antecedentes personales</h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <label id="label2">No patológicos:</label>
                                </div>
                                <?php
                                    $np=[];
                                    $pa=[];
                                    $contar1=0;
                                    $contar2=0;
                                ?>
                                @if(isset(session('filiacion')->hoja_filiacion->no_patologico)) 
                                    @if(count(session('filiacion')->hoja_filiacion->no_patologico)>0)
                                        @foreach(session('filiacion')->hoja_filiacion->no_patologico as $item)
                                            @php
                                                array_push($np, $item);
                                            @endphp
                                        @endforeach
                                    @endif
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->no_patologico)) 
                                        @if(count($info->data[0]->hoja_filiacion->no_patologico)>0)
                                            @foreach($info->data[0]->hoja_filiacion->no_patologico as $item)
                                                @php
                                                    array_push($np, $item);

                                                @endphp
                                            @endforeach
                                        @endif

                                    @endif 
                                @endif

                                @if(isset(session('filiacion')->hoja_filiacion->patologicos)) 
                                    @if(count(session('filiacion')->hoja_filiacion->patologicos)>0)
                                        @foreach(session('filiacion')->hoja_filiacion->patologicos as $item)
                                            @php
                                                array_push($pa, $item);
                                            @endphp
                                        @endforeach
                                    @endif
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->patologicos)) 
                                        @if(count($info->data[0]->hoja_filiacion->patologicos)>0)
                                            @foreach($info->data[0]->hoja_filiacion->patologicos as $item)
                                                @php
                                                    array_push($pa, $item);
                                                @endphp
                                            @endforeach
                                        @endif

                                    @endif 
                                @endif

                                

                                @foreach($antencedent_np->data as $key => $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  onchange="checknopatologico(this)"  
                                    @if(isset(session('filiacion')->hoja_filiacion->no_patologico)) 
                                        disabled 
                                    @else
                                        @if(isset($info->data[0]->hoja_filiacion->no_patologico)) 
                                            disabled
                                         @endif
                                    @endif
                                     name="no_patologico" type="checkbox"
                                     id="no_patologico{{$key}}" txt="" nombre="{{$item->nombre}}"
                                      value="{{$item->id}}" 
                                      @if(count($np)>0)
                                        @if(in_array($item->id,array_column($np, 'id'))) checked  @endif 
                                      @endif>
                                    <label class="form-check-label" for="no_patologico{{$key}}">{{$item->nombre}}</label>
                                </div>
                                @endforeach

                                <div>
                                    <label id="label2">Patológicos:</label>
                                </div>

                                @foreach($antencedent_p->data as $key => $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" onchange="checkpatologico(this)"
                                    @if(isset(session('filiacion')->hoja_filiacion->patologicos)) 
                                        disabled 
                                    @else
                                        @if(isset($info->data[0]->hoja_filiacion->patologicos)) 
                                            disabled
                                         @endif
                                    @endif
                                     name="patologicos" type="checkbox" id="patologicos{{$key}}" 
                                    @if(count($pa)>0)
                                        @if(in_array($item->id,array_column($pa, 'id'))) checked disabled  @endif 
                                    @endif
                                    txt="" nombre="{{$item->nombre}}" value="{{$item->id}}">
                                    <label class="form-check-label" for="patologicos{{$key}}">{{$item->nombre}}</label>
                                </div>
                                @endforeach
                            
                                @if(isset(session('filiacion')->hoja_filiacion->patologicos)) 
                                    @if(count(session('filiacion')->hoja_filiacion->patologicos)>0)
                                        @foreach(session('filiacion')->hoja_filiacion->patologicos as $item)
                                            @if($item->id==8)
                                            <?php
                                                $contar1++;
                                                $txt=$item->txt;
                                            ?>
                                            @endif
                                        @endforeach
                                    @endif
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->patologicos)) 
                                        @if(count($info->data[0]->hoja_filiacion->patologicos)>0)
                                            @foreach($info->data[0]->hoja_filiacion->patologicos as $item)
                                                @if($item->id==8)
                                                <?php
                                                    $contar2++;
                                                    $txt=$item->txt;
                                                ?>
                                                @endif
                                            @endforeach
                                        @endif

                                    @endif
                                @endif

                                @if($contar1>0 or $contar2>0)
                            
                                <br>
                                <div class="form-group divotros" style="display:block;">
                                    <textarea id="texto" disabled class="input form-control" rows="3">{{$txt}}</textarea>
                                </div>
                                @else
                                    <br>
                                    <div class="form-group divotros" style="display:none;">
                                        <br>
                                        <textarea id="texto" class="input form-control" placeholder="Escriba aquí" rows="3"></textarea>
                                   
                                    </div>
                                @endif
                               
                            </div>

                            <div class="col-md-12">
                                <label id="label2">Quirúrgicos:</label>

                            </div>
                            <div class="d-flex mb-2 col-md-12">
                            @if(isset(session('filiacion')->hoja_filiacion->quirurgico))
                            <input type="hidden" value="1" id="activeq">
                            <input type="checkbox" id="qniega" disabled ><p class="ml-2 my-auto">Niega</p>
                            @else
                                @if(isset($info->data[0]->hoja_filiacion->quirurgico)) 
                                <input type="hidden" value="1" id="activeq">
                                <input type="checkbox" id="qniega" disabled ><p class="ml-2 my-auto">Niega</p>
                                @else
                                <input type="hidden" value="0" id="activeq">
                                <input type="checkbox" id="qniega" ><p class="ml-2 my-auto">Niega</p>
                                @endif
                            @endif
                                
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="quirurgico" 
                                @if(isset(session('filiacion')->hoja_filiacion->quirurgico)) 
                                    value="{{session('filiacion')->hoja_filiacion->quirurgico}}" 
                                    disabled
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->quirurgico)) 
                                        value="{{$info->data[0]->hoja_filiacion->quirurgico}}" 
                                        disabled
                                    @endif 
                                @endif
                                class="input form-control form-control-sm">
                            </div>
                            
                        </div>

                        <!----------Antecedentes------------->
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="title">Antecedentes quirúrgicos</h1>
                            </div>
                            @if(isset(session('filiacion')->hoja_filiacion->padres))
                            <input type="hidden" value="1" id="activeaq">
                            <div class="d-flex col-md-12">
                                <input type="checkbox" id="aqniega" disabled ><p class="ml-2 my-auto">Niega</p>
                            </div>
                            @else
                            @if(isset($info->data[0]->hoja_filiacion->padres)) 
                            <input type="hidden" value="1" id="activeaq">
                            <div class="d-flex col-md-12">
                                <input type="checkbox" id="aqniega" disabled ><p class="ml-2 my-auto">Niega</p>
                            </div>
                            @else
                            <input type="hidden" value="0" id="activeaq">
                            <div class="d-flex col-md-12">
                                <input type="checkbox" id="aqniega" ><p class="ml-2 my-auto">Niega</p>
                            </div>
                            @endif
                            
                            @endif
                            <div class="col-md-12">
                                <label id="label2">Heredo-familiares</label>
                            </div>

                            <div class="col-md-12">
                                <label id="label">Padres:</label>
                                <input type="text" id="padres" 
                                @if(isset(session('filiacion')->hoja_filiacion->padres)) 
                                    value="{{session('filiacion')->hoja_filiacion->padres}}" 
                                    disabled
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->padres)) 
                                        value="{{$info->data[0]->hoja_filiacion->padres}}" 
                                        disabled
                                    @endif 
                                @endif
                                class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-12">
                            
                                <label id="label">Abuelos:</label>
                                <input type="text" id="abuelos" 
                                @if(isset(session('filiacion')->hoja_filiacion->abuelos)) 
                                    value="{{session('filiacion')->hoja_filiacion->abuelos}}"
                                    disabled 
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->abuelos)) 
                                        value="{{$info->data[0]->hoja_filiacion->abuelos}}" 
                                        disabled
                                    @endif 
                                @endif
                                class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-12">
                                <label id="label">Hermanos:</label>
                                <input type="text" id="hermanos" 
                                @if(isset(session('filiacion')->hoja_filiacion->hermanos)) 
                                    value="{{session('filiacion')->hoja_filiacion->hermanos}}"
                                    disabled 
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->hermanos)) 
                                        value="{{$info->data[0]->hoja_filiacion->hermanos}}" 
                                        disabled
                                    @endif 
                                @endif
                                class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-12">
                                <label id="label">Conyugue:</label>
                                <input type="text" id="conyugue" 
                                @if(isset(session('filiacion')->hoja_filiacion->conyugue)) 
                                    value="{{session('filiacion')->hoja_filiacion->conyugue}}"
                                    disabled 
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->conyugue)) 
                                        value="{{$info->data[0]->hoja_filiacion->conyugue}}" 
                                        disabled
                                    @endif 
                                @endif
                                class="input form-control form-control-sm ">
                            </div>

                        </div>

                          <!----------Antecedentes------------->
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="title">Información en caso de emergencia</h1>
                            </div>

                            <div class="col-md-6">
                                <label id="label">Alergías medicamentos/alimentarias:</label>
                                <input type="text" id="alergias" 
                                @if(isset(session('filiacion')->alergias))                                     
                                    value="{{session('filiacion')->alergias}}" disabled
                                @else 
                                    @if(isset($info->data[0]->alergias)) 
                                        value="{{$info->data[0]->alergias}}" 
                                        disabled
                                    @endif 
                                @endif
                                class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-6">
                                <label id="label">Nombre de persona responsable:</label>
                                <input type="text" id="persona_responsable" 
                                @if(isset(session('filiacion')->hoja_filiacion->persona_responsable)) 
                                    value="{{session('filiacion')->hoja_filiacion->persona_responsable}}"disabled 
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->persona_responsable)) 
                                        value="{{$info->data[0]->hoja_filiacion->persona_responsable}}" 
                                        disabled
                                    @endif 
                                @endif
                                class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-6">
                                <label id="label">Grupo sanguíneo/Rh:</label>
                                <input type="text" id="grupos_factorh" 
                                @if(isset(session('filiacion')->grupos_factorh)) 
                                    value="{{session('filiacion')->grupos_factorh}}"
                                    disabled 
                                @else 
                                    @if(isset($info->data[0]->grupos_factorh)) 
                                        value="{{$info->data[0]->grupos_factorh}}"
                                        disabled 
                                    @endif 
                                @endif
                                class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-6">
                                <label id="label">Núm. de teléfono de casa del paciente:</label>
                                <input type="text" maxlength="9"
                                @if(isset(session('filiacion')->hoja_filiacion->tlf_casa_paciente)) 
                                    value="{{session('filiacion')->hoja_filiacion->tlf_casa_paciente}}"
                                    disabled 
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->tlf_casa_paciente)) 
                                        value="{{$info->data[0]->hoja_filiacion->tlf_casa_paciente}}"
                                        disabled 
                                    @endif 
                                @endif
                                onkeypress="return valideKey(event);" maxlength=11 id="tlf_casa_paciente" class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-6">
                                <label id="label">Núm. de celular de persona responsable:</label>
                                <input type="text" 
                                onkeypress="return valideKey(event);" maxlength=11 
                                @if(isset(session('filiacion')->hoja_filiacion->celular_responsble)) 
                                    value="{{session('filiacion')->hoja_filiacion->celular_responsble}}"
                                    disabled 
                                @else 
                                    @if(isset($info->data[0]->hoja_filiacion->celular_responsble)) 
                                        value="{{$info->data[0]->hoja_filiacion->celular_responsble}}" 
                                        disabled
                                    @endif 
                                @endif
                                id="celular_responsble" class="input form-control form-control-sm">
                            </div>

                            <div class="col-md-10">
                                <div class="form-check ">
                                    <label class="form-check-label" >¿Autorizas el uso de tus datos personales?</label>
                                   <div class="col-md-12 mt-2 d-flex">
                                      
                                   <div class="d-flex col-2">
                                            <input class="form-check-input" type="checkbox" id="autorizacion" 
                                                
                                                name="autorizacion" 
                                                @if(isset(session('filiacion')->manejodatos)) 
                                                    @if(session('filiacion')->manejodatos==0)
                                                        value="{{session('filiacion')->manejodatos}}"
                                                     
                                                    @else
                                                        value="0"
                                                    @endif
                                                    
                                                @else 
                                                    @if(isset($info->data[0]->manejodatos)) 
                                                        @if($info->data[0]->manejodatos==0)
                                                            value="{{$info->data[0]->manejodatos}}"
                                                       
                                                        @else
                                                            value="0"
                                                        @endif
                                                       
                                                    
                                                    @else
                                                        value="0"
                                                    @endif
                                                @endif
                                                >
                                                <p class="ml-2 my-auto">Si</p>
                                        </div>
                                        <div class="d-flex col-2">
                                            <input class="form-check-input" type="checkbox" id="autorizacion2" 
                                                
                                                name="autorizacion" 
                                                @if(isset(session('filiacion')->manejodatos)) 
                                                    @if(session('filiacion')->manejodatos==1)
                                                        value="{{session('filiacion')->manejodatos}}"
                                                     
                                                    @else
                                                        value="1"
                                                    @endif
                                                    
                                                @else 
                                                    @if(isset($info->data[0]->manejodatos)) 
                                                        @if($info->data[0]->manejodatos==1)
                                                            value="{{$info->data[0]->manejodatos}}"
                                                         
                                                        @else
                                                            value="1"
                                                        @endif
                                                    @else
                                                        value="1"
                                                    @endif
                                                @endif
                                                >
                                                <p class="ml-2 my-auto">Niega</p>
                                        </div>
                                   </div> 
                                </div>
                            </div>
                            <br><br>
                           


                        </div>
                        
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
                    <h1 class="title">Error al guardar los datos del paciente</h1>
                @endif

            </div>
        </div>
    </div>
    
    @include('components.modalAlert')

@endsection

@push('scripts')
<script src="{{ asset('assets/js/validar.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('/assets/js/registroAtencion/historiaClinica.js') }}?ver=2.2"></script>
@endpush