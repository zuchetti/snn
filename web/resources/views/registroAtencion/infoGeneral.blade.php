@extends('layout.navbar')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/historiaClinica.css')}}" rel="stylesheet">
<link  href="{{ URL::asset('/assets/css/bootstrap-select.min.css')}}" rel="stylesheet" />

@endpush
@section('content')
    <div class="container-fluid sectionContent">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto">
                <div class="divPrin">
                

                    <div class="row justify-content-center">
                        <div class="col-md-10 mx-auto">
                            
                            <h1 class="title">
                                <a href="{{url('newAtencion')}}" >
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                              
                                Información general
                            </h1>

                            
                            @if($message==200)

                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Código de asegurado:</th>
                                        <th scope="col">Póliza/Contrato:</th>
                                        <th scope="col">Certificado:</th>
                                        <th scope="col">Producto:</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <td bgcolor="yellow" style="color:#000;font-weight:500;">{{$detalle->data->DatosAfiliado->CodigoAfiliado}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->NumeroPoliza}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->NumeroCertificado}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->CodProducto}}</td>
                                        </tr>
                                    </tbody>
                                </table>



                                <!---------Datos del Paciente----------->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 id="text77">Datos del Paciente</h2>
                                    </div>
                                </div>

                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Apellidos y Nombres:</th>
                                        <th scope="col">Genero:</th>
                                        <th scope="col">Fecha de Nacimiento:</th>
                                        <th scope="col">Parentesco:</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <td bgcolor="yellow" style="color:#000;font-weight:500;">{{$detalle->data->DatosAfiliado->ApellidoPaternoAfiliado}} {{$detalle->data->DatosAfiliado->ApellidoMaternoAfiliado}} {{$detalle->data->DatosAfiliado->NombresAfiliado}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->DesGenero}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->FechaNacimiento}}</td>
                                            <td bgcolor="yellow" style="color:#000;font-weight:500;">{{$detalle->data->DatosAfiliado->DesParentesco}}</td>
                                        </tr>
                                    </tbody>
                                </table>


                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Tipo Documento:</th>
                                        <th scope="col">Nº Documento:</th>
                                        <th scope="col">Edad:</th>
                                        <th scope="col">Inicio Vigencia:</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$detalle->data->DatosAfiliado->DesTipoDocumentoAfiliado}}</td>
                                            <td >{{$detalle->data->DatosAfiliado->NumeroDocumentoAfiliado}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->Edad}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->FechaInicioVigencia}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Fin Vigencia:</th>
                                        <th scope="col">Estado Civil:</th>
                                        <th scope="col">Tipo Plan de Salud:</th>
                                        <th scope="col">Nº Plan:</th>
                                        <th scope="col">Estado</th>

                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$detalle->data->DatosAfiliado->FechaFinVigencia}}</td>
                                            <td >{{$detalle->data->DatosAfiliado->DesEstadoCivil}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->DesTipoPlan}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->NumeroPlan}}</td>
                                            <td bgcolor="yellow" style="color:#000;font-weight:500;">{{$detalle->data->DatosAfiliado->DesEstado}}</td>

                                        </tr>
                                    </tbody>
                                </table>



                                <!---------Datos del Titular----------->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 id="text77">Datos del titular</h2>
                                    </div>
                                </div>

                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Apellidos y Nombres</th>
                                        <th scope="col">Código Titular:</th>
                                        <th scope="col">Tipo Documento:</th>
                                        <th scope="col">Tipo Moneda:</th>

                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <td bgcolor="yellow" style="color:#000;font-weight:500;">{{$detalle->data->DatosAfiliado->ApellidoPaternoTitular}} {{$detalle->data->DatosAfiliado->ApellidoMaternoTitular}} {{$detalle->data->DatosAfiliado->NombresTitular}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->CodigoTitular}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->NumeroDocumentoTitular}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->DesMoneda}}</td>

                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre del contratante:</th>
                                        <th scope="col">Tipo Documento contratante:</th>
                                        <th scope="col">Tipo de Afiliación:</th>
                                        <th scope="col">Fecha de Afiliación:</th>
                                        <th scope="col">Nº Documento contratante:</th>

                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <td bgcolor="yellow" style="color:#000;font-weight:500;">{{$detalle->data->DatosAfiliado->NombreContratante}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->DesTipoDocumentoContratante}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->DesTipoAfiliacion}}</td>
                                            <td bgcolor="yellow" style="color:#000;font-weight:500;">{{$detalle->data->DatosAfiliado->FechaAfiliacion}}</td>
                                            <td>{{$detalle->data->DatosAfiliado->NumeroDocumentoContratante}}</td>

                                        </tr>
                                    </tbody>
                                </table>


                                <!---------Listado de beneficios----------->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 id="text77">Listado de beneficios</h2>
                                    </div>
                                </div>

                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col">Seleccione</th>
                                        <th scope="col">Beneficios</th>
                                        <th scope="col">Restricciones</th>
                                        <th scope="col">Copago fijo</th>
                                        <th scope="col">Copago Variable</th>
                                        <th scope="col">Fin de carencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detalle->data->Coberturas as $item)
                                        <tr>
                                            <td>
                                            <div class="form-check text-center">
                                            <label class="form-check-label">
                                                <input type="radio" name="CodigoTipoCobertura"
                                                value="{{$item->CodigoTipoCobertura}}" 
                                                bene="{{$item->Beneficios}}"
                                                BeneficioMaximoInicial="{{$item->BeneficioMaximoInicial}}"
                                                ApellidoMaternoAfiliado="{{$detalle->data->DatosAfiliado->ApellidoMaternoAfiliado}}"
                                                ApellidoPaternoAfiliado="{{$detalle->data->DatosAfiliado->ApellidoPaternoAfiliado}}" 
                                                CodigoAfiliado="{{$detalle->data->DatosAfiliado->CodigoAfiliado}}" 
                                                CodigoTitular="{{$detalle->data->DatosAfiliado->CodigoTitular}}"
                                                CodCalificacionServicio="{{$item->CodCalificacionServicio}}"
                                                CodEstado="{{$detalle->data->DatosAfiliado->CodEstado}}"
                                                CodEspecialidad=""
                                                CodMoneda="{{$detalle->data->DatosAfiliado->CodMoneda}}"
                                                CodCopagoFijo="{{$item->CodCopagoFijo}}"  
                                                CodCopagoVariable="{{$item->CodCopagoVariable}}"  
                                                CodParentesco="{{$detalle->data->DatosAfiliado->CodParentesco}}"
                                                CodProducto="{{$detalle->data->DatosAfiliado->CodProducto}}"
                                                NumeroDocumentoContratante="{{$detalle->data->DatosAfiliado->NumeroDocumentoContratante}}"
                                                CodSubTipoCobertura="{{$item->CodigoSubTipoCobertura}}"
                                                CodTipoCobertura="{{$item->CodigoTipoCobertura}}"
                                                CodTipoAfiliacion="{{$detalle->data->DatosAfiliado->CodTipoAfiliacion}}"
                                                DesProducto="{{$detalle->data->DatosAfiliado->DesProducto}}"
                                                CodEstadoMarital="{{$detalle->data->DatosAfiliado->CodEstadoCivil}}"
                                                CodFechaFinCarencia="{{$item->CodFechaFinCarencia}}"
                                                CodFechaAfiliacion="{{$detalle->data->DatosAfiliado->CodFechaAfiliacion}}"
                                                CodFechaInicioVigencia="{{$detalle->data->DatosAfiliado->CodFechaInicioVigencia}}"
                                                CodFechaNacimiento="{{$detalle->data->DatosAfiliado->CodFechaNacimiento}}"
                                                CodGenero="{{$detalle->data->DatosAfiliado->CodGenero}}"
                                                SUNASA="00023920"
                                                IAFAS="{{$iafas}}"
                                                CondicionesEspeciales="{{$item->CondicionesEspeciales}}"
                                                ApellidoMaternoTitular="{{$detalle->data->DatosAfiliado->ApellidoMaternoTitular}}"
                                                NombreContratante="{{$detalle->data->DatosAfiliado->NombreContratante}}"
                                                ApellidoPaternoTitular="{{$detalle->data->DatosAfiliado->ApellidoPaternoTitular}}"
                                                NombresAfiliado="{{$detalle->data->DatosAfiliado->NombresAfiliado}}"
                                                NombresTitular="{{$detalle->data->DatosAfiliado->NombresTitular}}"
                                                NumeroCertificado="{{$detalle->data->DatosAfiliado->NumeroCertificado}}"
                                                NumeroContrato="{{$detalle->data->DatosAfiliado->NumeroContrato}}"
                                                NumeroDocumentoAfiliado="{{$detalle->data->DatosAfiliado->NumeroDocumentoAfiliado}}"
                                                NumeroDocumentoTitular="{{$detalle->data->DatosAfiliado->NumeroDocumentoTitular}}"
                                                NumeroPlan="{{$detalle->data->DatosAfiliado->NumeroPlan}}"
                                                NumeroPoliza="{{$detalle->data->DatosAfiliado->NumeroPoliza}}"
                                                RUC="20251011461"
                                                CodTipoDocumentoContratante="{{$detalle->data->DatosAfiliado->CodTipoDocumentoContratante}}"
                                                CodTipoDocumentoAfiliado="{{$detalle->data->DatosAfiliado->CodTipoDocumentoAfiliado}}"
                                                CodTipoDocumentoTitular="{{$detalle->data->DatosAfiliado->CodTipoDocumentoTitular}}"
                                                CodTipoPlan="{{$detalle->data->DatosAfiliado->CodTipoPlan}}"
                                                CodIndicadorRestriccion="{{$item->CodIndicadorRestriccion}}"

                                                class="form-check-input" name="optradio">
                                            </label>
                                            </div>
                                            </td>
                                            <td @if($item->Beneficios=='CENTRO SALUD EN OFICINA') bgcolor="yellow" style="color:#000;font-weight:500;" @endif >
                                                {{$item->Beneficios}}
                                            </td>
                                    
                                            <td>{{$item->Restricciones}}</td>
                                            <td>{{$item->CodCopagoFijo}}</td>
                                            <td>{{$item->CodCopagoVariable}}</td>
                                            <td>{{$item->FechaFinCarencia}}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                <br>

                                <div class="row justify-content-center">
                                    <div class="col-md-8 mx-auto text-center">
                                        <label id="label">Seleccionar subcliente:</label>
                                        <select class="form-control form-control-sm selectpicker" data-live-search="true"  id="idsubcliente">
                                            <option value=""></option>
                                            @foreach($subcliente->data as $u)
                                                <option value="{{$u->idempresa}}">{{$u->empresa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br><br>

                                <div class="row justify-content-center">
                                    <div class="col-md-8 mx-auto text-center">
                                        <label id="label">Modalidad de atención:</label>
                                        <select class="form-control form-control-sm"  id="idmodalidad">
                                            <option value=""></option>
                                            <option value="0">Telemedicina </option>
                                            <option value="1">Presencial </option>
                                        </select>
                                    </div>
                                </div>
                                <br>

                            
                        
                                <div id="alerts"></div>
                            
                                
                                <div class="row justify-content-center">
                                    <div class="col-md-4 mx-auto text-center">
                                        <a href="{{url('PacienteCortesia_iafas')}}" id="boton" class="btn pacienteC">
                                            Paciente por cortesía  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                                        </a>
                                    </div>

                                    <div class="col-md-4 text-center">
                                        @foreach($detalle->data->Coberturas as $item)
                                            @if($item->Beneficios=='CENTRO SALUD EN OFICINA' && $CodEstado==1)
                                            <button  id="boton" class="btn next botones">
                                                Siguiente <span class="spinner-border spinner-border-sm" id="spiner2" style="display:none;"></span>
                                            </button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <br><br>
                                <div class="alert alert-primary" role="alert">
                                    {{$message}}, por favor intente nuevamente
                                </div>
                                    
                            @endif
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    

@endsection
@push('scripts')
<script  src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/registroAtencion/infoGeneral.js') }}"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush

