@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/historiaClinica.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/select2.min.css')}}" rel="stylesheet">


@endpush
@section('content')
    @php
        $page ='receta';
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-12 mx-auto">
            <div class="divPrin">

            @if(count($histori->data)>0 or session('filiacion')!=null)

                    @if(isset(session('paciente')->cie10))
                    <?php
                        date_default_timezone_set("America/Lima");
                    ?>

                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="row justify-content-center p-4">
                                <div class="col-md-9 text-center">
                                    <h1 class="title">Receta médica</h1>
                                </div>
                                <div class="col-md-3 text-right">
                                    <a href="{{url('examenesAuxiliares')}}" style="margin-top:0px" id="boton" class="btn">
                                        Saltar este paso 
                                    </a>
                                
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto">

                            <div class="row">
                                <div class="col-md-4">
                                    <label id="label">Fecha:</label>
                                    <input type="date" id="fecha"  disabled value="<?php echo date('Y-m-d') ?>" class="input form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label id="label">Sede:</label>
                                    <input type="text" id="nombres" disabled 
                                    value="{{session('topico')->nombre}}" 
                                    class="letras input form-control form-control-sm">
                                </div>
                            
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label id="label">Apellidos y nombres</label>
                                    <input type="text" id="nombres" disabled 
                                    value="{{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}" 
                                    class="letras input form-control form-control-sm">
                                </div>
                               
                                <div class="col-md-6">
                                    @if(session('paciente')->tipo_atencion==0)
                                    <label id="label">Código de afiliado:</label>
                                    <input type="text" disabled value="{{session('paciente')->CodigoAfiliado}}" class="input form-control form-control-sm">
                                    @else
                                    <label id="label">#documento del paciente</label>
                                    <input type="text" disabled value="{{session('paciente')->num_doc}}" id="dni" class="input form-control form-control-sm">
                                    @endif
                                </div>
                            </div>
                        </div>
                            
                        


                        <div class="col-md-10 mx-auto">

                            <div class="row justify-content-center">
                                <div class="col-md-9">
                                    <div>
                                        <label id="label2">Agregar medicamento:</label>
                                    </div>
                                    <select id="idmedicamento"  class="input form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach($medicamentos->data as $item)
                                        <option value="{{$item->idmedicamento}}">{{$item->producto}}</option>
                                        @endforeach
                                    </select>
                      

                                </div>
                                <div class="col-md-3">
                                    <button id="boton" class="btn agregar">
                                        Agregar  <span class="spinner-border spinner-border-sm" id="spiner2" style="display:none;"></span>
                                    </button>
                                </div>
                                <br>

                                <div class="col-md-12">
                                    <br>
                                    <div id="alerts1"></div>
                                </div>

                            </div>
                            
                        </div>
                     
                       

                        <div class="col-md-12 mx-auto">
                            <br><br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad.</th>
                                        <th scope="col">Dosis</th>
                                        <th scope="col">Present</th>
                                        <th scope="col">Vía de adm.</th>
                                        <th scope="col">Frec.</th>
                                        <th scope="col">Duración.</th>
                                        <th scope="col">CIE-10.</th>
                                        <th scope="col">Fuente</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Quitar</th>

                                    </tr>
                                </thead>
                                
                                <input class="form-control" type="hidden" value="{{session('paciente')->cie10}}" id="arrayCie10">
                                <tbody id="tableMedicaments">
                                    
                                    @if(session('receta')!=null)
                                        @php
                                            $arrayCie10 = explode(',', session('paciente')->cie10);
                                            $dataU = $object = json_decode(json_encode(session('receta')), FALSE);
                                        @endphp

                                        @foreach($dataU->medicamentoslista as $key => $item)

                                        <tr id="mytr{{$key}}">
                                            <td><input type="hidden" medic="{{$key}}" name="idmedicamento" 
                                                counter="{{$key}}"
                                                id="idmedicamento{{$key}}" value="{{$item->idmedicamento}}">
                                                <input type="hidden" name="idbotiquinitem" id="idbotiquinitem{{$key}}" value="{{$item->idbotiquinitem}}">
                                                <input type="hidden" name="cod_producto" id="cod_producto{{$key}}" value="{{$item->cod_producto}}">
                                                <input type="hidden" name="producto" id="producto{{$key}}" value="{{$item->producto}}">
                                                {{$item->producto}}
                                            </td>

                                            <td><input type="number" value="{{$item->cantidad}}" 
                                            id="cantidadE{{$key}}" class="form-control form-control-sm numbers" name="cantidadE"  min='1' ></td>
                                            <td><input type="text" id="dosis{{$key}}" value="@if(isset($item->dosis)){{$item->dosis}}@endif" class="form-control form-control-sm" name="dosis"></td>
                                            <td>
                                            <input type="hidden"  name="presentacion" id="presentacion{{$key}}" value="{{$item->presentacion}}">
                                            {{$item->presentacion_}}
                                            <input type="hidden"  name="presentacion_" id="presentacion_{{$key}}" value="{{$item->presentacion_}}">
                                            </td>
                                            <td><input type="text"  value="@if(isset($item->via_administracion)){{$item->via_administracion}}@endif" id="via_administracion{{$key}}" class="form-control form-control-sm" name="via_administracion"></td>
                                            <td><input type="text" value="@if(isset($item->frecuencia)){{$item->frecuencia}} @endif" id="frecuencia{{$key}}" class="form-control form-control-sm" name="frecuencia"></td>
                                            <td><input type="text" value="@if(isset($item->duracion)){{$item->duracion}}@endif" id="duracion{{$key}}"  class="form-control form-control-sm" name="duracion"></td>
                                            <td width="15%">
                                                <?php
                                                    $diag=[];
                                                    foreach($dianostics->data as $dia){
                                                        $diag[]=$dia;
                                                    }
                                                ?>
                                                <select class="form-control form-control-sm " id="cie10{{$key}}">
                                                    <option value=""></option>
                                                    @foreach($arrayCie10 as $u)
                                                    <option value="{{$u}}" @if(isset($item->cie10)) @if($item->cie10==$u)  selected  @endif @endif>{{$u}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                            @if(isset($item->cantidad))
                                            @php
                                                $stock=$item->stock-$item->cantidad;
                                            @endphp
                                            @endif
                             
                                                <select class="form-control botica-fuente form-control-sm"  id="fuente{{$key}}" name="fuente">
                                                    <option value=""></option>
                                                    @if($item->cantidad < $stock && $item->fuente==0)
                                                    <option value="0" selected >Botiquín ampliado</option>
                                                    @endif
        
                                                    @if($item->cantidad >= $stock && $item->fuente==0)
                                                    <option value="0" selected >Botiquín ampliado</option>
                                                    @endif

                                                    @if($item->fuente==1)
                                                    <option value="1" selected >Fuente Externa</option>
                                                    @endif

                                                </select>
                                            </td>
                                       
                                            <td><input type="hidden" id="stock{{$key}}" name="stock" value="{{$item->stock}}">
                                                @if(isset($item->fuente))
                                                   
                                                    @if($item->fuente==0)
                                                    <h7 id="stockfuent0{{$key}}" >{{$item->stock}}</h7>
                                                    @else
                                                    <h7 id="stockfuent0{{$key}}">{{$item->stock}}</h7>
                                                    @endif
                                                @else
                                                <h7 id="stockfuent0{{$key}}">{{$item->stock}}</h7>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="delete" onclick="handleRemover2({{$item->idmedicamento}},{{$key}})"><i class="fas  fa-minus-circle"></i></a>                                            
                                            </td>
                                        </tr>
                                        @endforeach

                                    @else

                                    @endif
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="col-md-10 mx-auto">
                            <h2 id="text77">Indicaciones</h2>
                            <div class="form-group">
                            <textarea id="indicaciones"  minlength="500" class="input  form-control form-control-sm" placeholder="Escribir aqui..." name="indicaciones" rows="5">@if(session('receta')!=null) {{$dataU->indicaciones}} @endif</textarea>
                            </div>
                        </div>

                        <div class="col-md-10 mx-auto">
                            <div class="d-flex">
                                <h2 id="text77">Código de la receta</h2>
                                <div class="d-flex ml-3">
                                
                                    <input type="checkbox" id="recetafisica"  ><p class="ml-2 my-auto">Se genera receta fisica</p>
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                 <input type="text" disabled @if(session('receta')!=null) value="{{session('receta')->codigoreceta}}" @else value="0" @endif  id="codigoreceta" class="input form-control letrasyn form-control-sm">

                                </div>
                            </div>
                        </div>
                       
                       

                       

                        <div class="col-md-10 mx-auto">
                            <div class="form-check form-check-inline delivery">
                                <input class="form-check-input" type="checkbox" 
                                @if(session('receta')!=null)
                                 @if($dataU->delivery==1) checked value="1" @endif
                                @endif
                                @if(session('receta')!=null)
                                 @if($dataU->delivery==1) checked value="1" @endif
                                 @if($dataU->delivery==0) value="0" @endif
                                @endif
                                id="delivery">
                                <label class="form-check-label" for="delivery">Delivery</label>
                            </div>
                        
                            <div class="row">
                                @if(session('receta')!=null)
                                    @if($dataU->delivery==1) 
                                        <input type="hidden" value="{{$dataU->delivery_datos->idprovincia}}" id="idprovinciaselec">
                                        <input type="hidden" value="{{$dataU->delivery_datos->idubigeo}}" id="idubigeoselec">
                                    @endif
                                @else
                                    @if(count($histori->data)>0)

                                        @if($histori->data[0]->delivery_datos!="") 
                                            <input type="hidden" 
                                            value="{{$histori->data[0]->delivery_datos->idprovincia}}" id="idprovinciaselec">
                                            <input type="hidden" value="{{$histori->data[0]->delivery_datos->idubigeo}}" id="idubigeoselec">
                                        @endif

                                    @endif
                                @endif
                                <div class="col-md-4">
                                    <label>Departamento:</label>
                                    <select class="form-control form-control-sm pais input"  
                                    @if(session('receta')!=null)
                                        @if($dataU->delivery!=1) disabled @endif
                                    @else
                                        @if(count($histori->data)>0)
                                            @if($histori->data[0]->delivery_datos=="") 
                                                disabled
                                            @endif
                                        @else
                                            disabled
                                        @endif
                                    @endif
                                    
                                     id="idubigeo">
                                        <option value=""></option>
                                        @foreach($pais->data as $item)
                                        <option value="{{$item->idubigeo}}"
                                        @if(session('receta')!=null)
                                            @if($dataU->delivery==1) 
                                                @if($dataU->delivery_datos->iddepartamento==$item->idubigeo) selected @endif
                                            @endif
                                        @else
                                            @if(count($histori->data)>0)
                                                @if($histori->data[0]->delivery_datos!="") 
                                                    @if($histori->data[0]->delivery_datos->iddepartamento==$item->idubigeo)
                                                        selected
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                       
                                        >{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Provincia</label>
                                    <select class="form-control form-control-sm input"   
                                    @if(session('receta')!=null)
                                        @if($dataU->delivery!=1) disabled @endif
                                    @else
                                        @if(count($histori->data)>0)
                                            @if($histori->data[0]->delivery_datos=="") 
                                                disabled
                                            @endif
                                        @else
                                            disabled
                                        @endif
                                    @endif
                                    
                                    id="idprovincia"></select>
                                </div>
                                <div class="col-md-4">
                                    <label>Distrito</label>
                                    <select class="form-control form-control-sm input"
                                    @if(session('receta')!=null)
                                        @if($dataU->delivery!=1) disabled @endif
                                    @else
                                        @if(count($histori->data)>0)
                                            @if($histori->data[0]->delivery_datos=="") 
                                                disabled
                                            @endif
                                        @else
                                            disabled
                                        @endif
                                    @endif
                                     id="idDistriro">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Dirección:</label>
                                    <input class="form-control form-control-sm input" 
                                     type="text" id="direccion" 
                                     @if(session('receta')!=null)
                                        @if($dataU->delivery==1) 
                                            value="{{$dataU->delivery_datos->direccion}}"
                                        @else
                                            disabled
                                        @endif
                                    @else
                                        @if(count($histori->data)>0)

                                            @if($histori->data[0]->delivery_datos!="") 
                                                value="{{$histori->data[0]->delivery_datos->direccion}}"
                                            @else
                                                value="{{$histori->data[0]->domicilio}}"
                                            @endif
                                        @else
                                            @if(isset(session('filiacion')->domicilio)) 
                                                value="{{session('filiacion')->domicilio}}" 
                                                disabled                                                
                                            @endif
                                        @endif
                                    @endif
                                    name="direccion">
                                </div>
                                <div class="col-md-6">
                                    <label>Referencia:</label>
                                    <input class="form-control form-control-sm input"
                                    @if(session('receta')!=null)
                                        @if($dataU->delivery==1) 
                                            value="{{$dataU->delivery_datos->referencia}}"
                                        @else
                                          disabled
                                        @endif
                                    @else
                                        @if(count($histori->data)>0)
                                            @if($histori->data[0]->delivery_datos!="") 
                                                value="{{$histori->data[0]->delivery_datos->referencia}}"
                                            @else
                                                disabled
                                            @endif 
                                        @else
                                            disabled
                                        @endif
                                    @endif
                                     type="text" id="referencia" name="referencia">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Teléfono 1:</label>
                                    <input class="form-control form-control-sm input numbers" 
                                    @if(session('receta')!=null)
                                        @if($dataU->delivery==1) 
                                            value="{{$dataU->delivery_datos->telf1}}"
                                        @else
                                            disabled
                                        @endif
                                    @else
                                        @if(count($histori->data)>0)

                                            @if($histori->data[0]->delivery_datos!="") 
                                                value="{{$histori->data[0]->delivery_datos->telf1}}"
                                            @else
                                                disabled
                                            @endif
                                        @else
                                            disabled
                                        @endif
                                    @endif
                                     type="text" id="telf1" name="telf1">
                                </div>
                                <div class="col-md-3">
                                    <label>Teléfono 2:</label>
                                    <input class="form-control form-control-sm input numbers" 
                                    @if(session('receta')!=null)
                                        @if($dataU->delivery==1) 
                                            value="{{$dataU->delivery_datos->telf2}}"
                                        @else
                                            disabled
                                        @endif
                                    @else
                                        @if(count($histori->data)>0)
                                            @if($histori->data[0]->delivery_datos!="") 
                                                value="{{$histori->data[0]->delivery_datos->telf2}}"
                                            @else
                                                disabled
                                            @endif
                                        @else
                                            disabled
                                        @endif
                                    @endif
                                     type="text" id="telf2" name="telf2">
                                </div>
                                <div class="col-md-6">
                                    <label>Correo electrónico:</label>
                                    <input class="form-control form-control-sm input" type="email" 
                                    @if(session('receta')!=null)
                                        @if($dataU->delivery==1) 
                                            value="{{$dataU->delivery_datos->email}}"
                                        @else
                                            disabled
                                        @endif
                                    @else
                                        @if(count($histori->data)>0)

                                            @if($histori->data[0]->delivery_datos!="") 
                                                value="{{$histori->data[0]->delivery_datos->email}}"
                                            @else
                                                disabled
                                            @endif
                                        @else
                                            disabled
                                        @endif
                                    @endif
                                     id="email" name="email">
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <div class="col-md-6 mx-auto">
                            <div id="alerts"></div>
                        </div>
                        <br>
                        <?php
                            if(session('receta')!=null){
                                $medicamentos=count($dataU->medicamentoslista);

                                if($medicamentos!=0){
                                    $medicamentos=count($dataU->medicamentoslista) - 1;
                                }
                            }
                        ?>
                        <input type="hidden" value="{{session('paciente')->num_doc}}" id="dni" class="input form-control form-control-sm">
                        <input type="hidden" id="contarm" @if(session('receta')!=null) @if(isset($medicamentos))
                        value="{{$medicamentos}}" @endif @endif>
                        
                        
                        @if(session('finalizar')==null)
                        <div class="col-md-10 mx-auto">
                            <div class="row justify-content-center">
                                <div class="col-md-4 mx-auto">
                                    <button id="boton" class="btn generar">
                                        CONTINUAR  <span class="spinner-border spinner-border-sm" id="spiner3" style="display:none;"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif


                        
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
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('/assets/js/registroAtencion/recetaMedica.js') }}?ver=1.7"></script>
@endpush
