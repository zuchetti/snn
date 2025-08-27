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
                        <div class="row">
                            <div class="col-md-9">
                                <a href="{{url('finish_attention')}}"><img src="{{ asset('/assets/images/dashboard/back.svg') }}" alt="*"  class="img-fluid"></a>  <br><br>
                            </div>
                            <div class="col-md-3">
                                @if(isset($pdf->status))
                                    @if($pdf->status==200 && $pdf->data->url_i!="")
                                    <a href="{{$pdf->data->url_i}}" target="_blank" class="btn" id="download"><i class="fas fa-print"></i> Imprimir pdf.</a>  <br><br>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                 

                  
                    <div class="col-md-10 mx-auto">
                        <div class="row filaa">
                            <div class="col-md-4">
                                <img src="{{ asset('/assets/images/logo/sanna.png') }}" alt="*"  class="img-fluid log">
                            </div>
                            <div class="col-md-4">
                                <h6 id="divici">CSO</h6>
                            </div>
                            <div class="col-md-4">
                                <h6 id="divici">RECETA MÉDICA</h6>
                                <?php
                                 echo  session('paciente')->num_doc."-".str_pad($datos->idatencion, 5, "0",STR_PAD_LEFT);
                                ?>

                            </div>
                        </div>
                    </div>

                    @if($datos)
                        @if($datos->idreceta_h_bot!=0)

                        <div class="col-lg-10 mx-auto">

                            <small class="titlet">Bótica interna</small>
                            <br>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Orden médica</small></td>
                                    </tr>
                                    <tr>
                                        
                                        <td colspan="4"><small class="titlet">Nº Orden:</small>
                                        <?php
                                            echo session('topico')->cod_cso."-".str_pad($datos->idreceta_h_bot, 5, "0",STR_PAD_LEFT);
                                        ?>
                                    </td>
                                    @if(session('filiacion')!=null)
                                        <td colspan="4">
                                            @foreach($tipos->data as $t)
                                                @if(session('filiacion')->idtiposeguro==$t->idtiposeguro)
                                                <small class="titlet">{{$t->seguro}}:</small> X
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Apellidos y nombres:</small>
                                        {{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(session('paciente')->tipo_atencion==0)
                                        <td colspan="8"><small class="titlet">Código afiliado:</small> 
                                        {{session('paciente')->CodigoAfiliado}}
                                        @else
                                        <td colspan="8">
                                            <small class="titlet">#documento del paciente:</small> 
                                            {{session('paciente')->num_doc}}
                                        @endif </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Sede:</small> {{session('topico')->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Indicaciones:</small> {{$datos->indicaciones}}</td>
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
                                    @foreach($datos->medicamentoslista as $rec)
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
                                    @if($datos->delivery==1)
                                    <tr>
                                        <td colspan="8"><small class="titlet">Delivery</small></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Departamento:</small>
                                            @foreach($pais->data as $p)
                                                @if($p->idubigeo==$datos->delivery_datos->iddepartamento)
                                                    {{$p->nombre}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Provincia:</small>
                                        @foreach($prov->data as $p)
                                            @if($p->idubigeo==$datos->delivery_datos->idprovincia)
                                                {{$p->nombre}}
                                            @endif
                                        @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Distrito:</small>
                                        @foreach($dist->data as $d)
                                            @if($d->idubigeo==$datos->delivery_datos->idubigeo)
                                                {{$d->nombre}}
                                            @endif
                                        @endforeach
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Dirección:</small> {{$datos->delivery_datos->direccion}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Referencia:</small> {{$datos->delivery_datos->referencia}} </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><small class="titlet">Teléfono1:</small> {{$datos->delivery_datos->telf1}}</td>
                                        <td  colspan="4"><small class="titlet">Teléfono2:</small> {{$datos->delivery_datos->telf2}}</td>

                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Correo eléctronico:</small> {{$datos->delivery_datos->email}}</td>
                                    </tr>
                                    @endif
                                    
                                    
                                    <tr>
                                        <td colspan="4" height="100" style="vertical-align:bottom;text-align:center;">
                                            
                                            
                                            <div class="row justify-content-center mb-2">
                                                <br>
                                                <div class="col-md-6">
                                                    @if(isset(session('medico')->data[0]->info[0]->firma))
                                                    <img class="img-fluid col-md-9" src="{{str_replace('https://200.48.199.90:8002','https://racso.doctormas.com.pe',session('medico')->data[0]->info[0]->firma)}}" alt="">
                                                    @endif
                                                </div>
                                              
                                            </div>
                                            <small class="titlet">Firma y sello del médico</small>
                                        </td>
                                        <td colspan="4" height="100" style="vertical-align:bottom;text-align:center;">
                                            
                                            
                                            <div class="row justify-content-center mb-2">
                                                <br>
                                                <div class="col-md-6">
                                                   
                                                    <img class="img-fluid col-md-10" src="{{session('firmapaciente')}}" alt="">
                                                    
                                                </div>
                                               
                                            </div>
                                            <small class="titlet">Firma del paciente</small>
                                        </td>
                                        
                                    
                                    </tr>
                                    
                            
                                </tbody>
                            </table>
                        </div>

                        @endif
                        @if($datos->idreceta_h_ext!=0)
                        <div class="col-md-10">
                            <div class="row justify-content-end">
                                <div class="col-md-3">
                                    @if(isset($pdf->status))
                                        @if($pdf->status==200 && $pdf->data->url_h!="")
                                        <a href="{{$pdf->data->url_h}}" target="_blank" class="btn" id="download"><i class="fas fa-print"></i> Imprimir pdf.</a>  <br><br>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 mx-auto">
                            <small class="titlet">Bótica ext</small>
                            <br>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Orden médica</small></td>
                                    </tr>
                                    <tr>
                                        
                                        
                                        <td colspan="4">
                                        <div>
                                            <small class="titlet">Nº Orden:</small> 
                                            <?php
                                                echo session('topico')->cod_cso."-".str_pad($datos->idreceta_h_ext, 5, "0",STR_PAD_LEFT);
                                            ?>
                                        </div>
                                        <div>
                                            <small class="titlet">Nº Receta:</small> 
                                            {{session('receta')->codigoreceta}}

                                        </div>

                                        </td>

                                        @if(session('filiacion')!=null)
                                        <td colspan="4">
                                            @foreach($tipos->data as $t)
                                                @if(session('filiacion')->idtiposeguro==$t->idtiposeguro)
                                                <small class="titlet">{{$t->seguro}}:</small> X
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Apellidos y nombres:</small>
                                        {{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(session('paciente')->tipo_atencion==0)
                                        <td colspan="8"><small class="titlet">Código afiliado:</small> 
                                            {{session('paciente')->CodigoAfiliado}}
                                        @else
                                        <td colspan="8">
                                            <small class="titlet">#documento del paciente:</small> 
                                            {{session('paciente')->num_doc}}
                                        @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Sede:</small> {{session('topico')->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Indicaciones:</small> {{$datos->indicaciones}}</td>
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
                                    @foreach($datos->medicamentoslista as $rec)
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
                                    @if($datos->delivery==1)
                                    <tr>
                                        <td colspan="8"><small class="titlet">Delivery</small></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Departamento:</small>
                                            @foreach($pais->data as $p)
                                                @if($p->idubigeo==$datos->delivery_datos->iddepartamento)
                                                    {{$p->nombre}}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Provincia:</small>
                                        @foreach($prov->data as $p)
                                            @if($p->idubigeo==$datos->delivery_datos->idprovincia)
                                                {{$p->nombre}}
                                            @endif
                                        @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Distrito:</small>
                                        @foreach($dist->data as $d)
                                            @if($d->idubigeo==$datos->delivery_datos->idubigeo)
                                                {{$d->nombre}}
                                            @endif
                                        @endforeach
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Dirección:</small> {{$datos->delivery_datos->direccion}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Referencia:</small> {{$datos->delivery_datos->referencia}} </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><small class="titlet">Teléfono1:</small> {{$datos->delivery_datos->telf1}}</td>
                                        <td  colspan="4"><small class="titlet">Teléfono2:</small> {{$datos->delivery_datos->telf2}}</td>

                                    </tr>
                                    <tr>
                                        <td colspan="8"><small class="titlet">Correo eléctronico:</small> {{$datos->delivery_datos->email}}</td>
                                    </tr>
                                    @endif
                                    
                                    
                                    <tr>
                                        <td colspan="4" height="100" style="vertical-align:bottom;text-align:center;">
                                            
                                            
                                            <div class="row justify-content-center mb-2">
                                                <br>
                                                <div class="col-md-6">
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
                        @endif
                    @else
                        <h6 id="divici" class="text-center">HA OCURRIDO UN ERROR</h6>

                    @endif
                </div>
                
            </div>
        </div>
    </div>




@endsection

