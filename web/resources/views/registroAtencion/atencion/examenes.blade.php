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
                                <h6 id="divici">EXAMENES</h6>
                                <?php
                                 echo  session('paciente')->num_doc."-".str_pad($datos->idatencion, 5, "0",STR_PAD_LEFT);
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    @if($pdf)
                        @if($pdf->status==200)
                            @if($pdf->data->url_l!="")
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-9">
                                    </div>
                                    @if($pdf->data->url_l!="")
                                        <div class="col-md-3">
                                            <a href="{{$pdf->data->url_l}}" target="_blank" class="btn" id="download"><i class="fas fa-print"></i> Imprimir pdf.</a>  <br><br>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-10 mx-auto">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td colspan="5"><small class="titlet">Orden Examen laboratorio:</small>
                                            <?php
                                                echo  session('topico')->cod_cso."-".str_pad($datos->idexamenaux_h_L, 5, "0",STR_PAD_LEFT);
                                            ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            @if(session('filiacion')!=null)
                                            <td >
                                                @foreach($tipos->data as $t)
                                                    @if(session('filiacion')->idtiposeguro==$t->idtiposeguro)
                                                    <small class="titlet">{{$t->seguro}}:</small> X
                                                    @endif
                                                @endforeach
                                            </td>
                                            @endif
                                            <td colspan="4"><small class="titlet">Nº Orden:</small>
                                            <?php
                                                echo session('topico')->cod_cso."-".str_pad($datos->idexamenaux_h_L, 5, "0",STR_PAD_LEFT);
                                            ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><small class="titlet">Apellidos y nombres:</small>
                                            {{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}
                                            </td>
                                        </tr>
                                        <tr>
                                            @if(session('paciente')->tipo_atencion==0)
                                            <td colspan="4"><small class="titlet">Código afiliado:</small> 
                                            {{session('paciente')->CodigoAfiliado}}
                                            @else
                                            <td colspan="4">
                                                <small class="titlet">#documento del paciente:</small> 
                                                {{session('paciente')->num_doc}}
                                            @endif </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><small class="titlet">Sede:</small> {{session('topico')->nombre}}</td>
                                        </tr>
                                    
                                        <tr class="medic">
                                            <td><small class="titlet3">Examen</small></td>
                                            <td ><small class="titlet3">Cant.</small></td>
                                            <td ><small class="titlet3">Tipo</small></td>
                                            <td><small class="titlet3"> CIE-10:</small></td>
                                        </tr>
                                        @if(!empty(session('examenes')->lab->examenlista))
                                            @foreach(session('examenes')->lab->examenlista as $rec)
                                
                                            <tr>
                                                <td>{{$rec->examen}}</td>
                                                <td>{{$rec->cant}}</td>
                                                <td>laboratorio</td>
                                                <td>{{$rec->cie10}}</td>
                                            </tr>
                                            
                                            @endforeach
                                        @endif
                                    
                                        
                                        <tr>
                                            <td colspan="2" height="100" style="vertical-align:bottom;text-align:center;">
                                                
                                                <small class="titlet">Firma y sello del médico</small>

                                                <div class="row justify-content-center">
                                                <br>
                                                    <div class="col-md-6 mt-3">
                                                        @if(isset(session('medico')->data[0]->info[0]->firma))
                                                            <img class="img-fluid col-md-6" src="{{str_replace('https://200.48.199.90:8002','https://racso.doctormas.com.pe',session('medico')->data[0]->info[0]->firma)}}"  alt="">
                                                        @endif
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        @if(isset(session('medico')->data[0]->info[0]->sello))
                                                            <img class="img-fluid" src="{{session('medico')->data[0]->info[0]->sello}}" alt="">
                                                        @endif 
                                                    </div> -->
                                                </div>
                                            </td>
                                            
                                        
                                        </tr>
                                        
                                
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        

                            @if($pdf->data->url_i!="")
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-9">
                                    </div>
                                    @if($pdf->data->url_i!="")
                                        <div class="col-md-3">
                                            <a href="{{$pdf->data->url_i}}" target="_blank" class="btn" id="download"><i class="fas fa-print"></i> Imprimir pdf.</a>  <br><br>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-10 mx-auto">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td colspan="5"><small class="titlet">Orden Examen imagen</small></td>
                                        </tr>
                                        <tr>
                                            @if(session('filiacion')!=null)
                                            <td >
                                                @foreach($tipos->data as $t)
                                                    @if(session('filiacion')->idtiposeguro==$t->idtiposeguro)
                                                    <small class="titlet">{{$t->seguro}}:</small> X
                                                    @endif
                                                @endforeach
                                            </td>
                                            @endif
                                            <td colspan="4"><small class="titlet">Nº Orden:</small>
                                            <?php
                                                echo session('topico')->cod_cso."-".str_pad($datos->idexamenaux_h_I, 5, "0",STR_PAD_LEFT);
                                            ?>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><small class="titlet">Apellidos y nombres:</small>
                                            {{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}
                                            </td>
                                        </tr>
                                        <tr>
                                            @if(session('paciente')->tipo_atencion==0)
                                            <td colspan="4"><small class="titlet">Código afiliado:</small> 
                                            {{session('paciente')->CodigoAfiliado}}
                                            @else
                                            <td colspan="4">
                                                <small class="titlet">#documento del paciente:</small> 
                                                {{session('paciente')->num_doc}}
                                            @endif </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><small class="titlet">Sede:</small> {{session('topico')->nombre}}</td>
                                        </tr>
                                    
                                        <tr class="medic">
                                            <td><small class="titlet3">Examen</small></td>
                                            <td ><small class="titlet3">Cant.</small></td>
                                            <td ><small class="titlet3">Tipo</small></td>
                                            <td><small class="titlet3"> CIE-10:</small></td>
                                        </tr>
                                        @if(!empty(session('examenes')->img->examenlista))
                                        @foreach(session('examenes')->img->examenlista as $rec)
                            
                                        <tr>
                                            <td>{{$rec->examen}}</td>
                                            <td>{{$rec->cant}}</td>
                                            <td>imagen</td>
                                            <td>{{$rec->cie10}}</td>
                                        </tr>
                                        
                                        @endforeach
                                        @endif
                                    
                                        
                                        <tr>
                                            <td colspan="2" height="100" style="vertical-align:bottom;text-align:center;">
                                                
                                                <small class="titlet">Firma y sello del médico</small>

                                                <div class="row justify-content-center">
                                                <br>
                                                    <div class="col-md-6 mt-3">
                                                        @if(isset(session('medico')->data[0]->info[0]->firma))
                                                            <img class="img-fluid col-md-6" src="{{str_replace('https://200.48.199.90:8002','https://racso.doctormas.com.pe',session('medico')->data[0]->info[0]->firma)}}" alt="">
                                                        @endif
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        @if(isset(session('medico')->data[0]->info[0]->sello))
                                                            <img class="img-fluid" src="{{session('medico')->data[0]->info[0]->sello}}" alt="">
                                                        @endif
                                                    </div> -->
                                                </div>
                                            </td>
                                            
                                        
                                        </tr>
                                        
                                
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        @else
                            <h6 id="divici" class="text-center">HA OCURRIDO UN ERROR</h6>

                        @endif
                    @else
                        <h6 id="divici" class="text-center">HA OCURRIDO UN ERROR</h6>

                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
