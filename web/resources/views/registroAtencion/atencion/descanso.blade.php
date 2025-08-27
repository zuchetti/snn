@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/tables.css')}}" rel="stylesheet">
<style>
    .table-bordered{
        border:none !important;
    }
</style>
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
                                @if($pdf->status==200)
                                <a href="{{$pdf->data->url}}" target="_blank" class="btn" id="download"><i class="fas fa-print"></i> Imprimir pdf.</a>  <br><br>
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
                                <h6 id="divici">DESCANSO MÉDICO</h6>
                                <?php
                                 echo  session('paciente')->num_doc."-".str_pad($datos->idatencion, 5, "0",STR_PAD_LEFT);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 mx-auto">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="2"><small class="titlet">Fecha: </small> {{session('diagnostico')->hoja_consulta->fecha}}</td>
                                </tr>
                                <tr>
                                    <td width="60%"><small class="titlet">Paciente:</small>
                                    {{session('paciente')->nombres}} {{session('paciente')->ape_paterno}} {{session('paciente')->ape_materno}}
                                     </td>
                                    <td width="40%"><small class="titlet">Póliza:</small>
                                    @if(session('paciente')->tipo_atencion==0)
                                        {{session('paciente')->NumeroPoliza}}
                                    @endif
                                    </td>

                                </tr>
                               
                                <tr>
                                    <td><small class="titlet">Empresa:</small> {{session('topico')->nombre}}</td>
                                    @if(session('paciente')->tipo_atencion==0)
                                    <td><small class="titlet">Código afiliado:</small>  {{session('paciente')->CodigoAfiliado}} </td>
                                    @endif
                                    @if(session('paciente')->tipo_atencion==1)
                                    <td>
                                    <small class="titlet">#documento del paciente:</small>{{session('paciente')->num_doc}}
                                    </td>
                                    @endif

                                </tr>

                                <tr>
                                    <td colspan="2"><small class="titlet">Presunción diagnóstica:</small>
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
                                            {{$diag[$key]->diagnostico}} (cie10:{{$u}}),
                                        @endforeach
                                    
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2"><small class="titlet">Periodo a descansar:</small>
                                    {{$datos->periodo}} días
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2"><small class="titlet">Nombre del médico:</small>
                                        {{session('medico')->data[0]->info[0]->nombres}}  {{session('medico')->data[0]->info[0]->ape_paterno}} {{session('medico')->data[0]->info[0]->ape_materno}}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2"><small class="titlet">CMP:</small>
                                    {{session('medico')->data[0]->info[0]->cod_rns}} 
                                    </td>
                                </tr>
                                <tr>
                                    <td  height="100" style="vertical-align:bottom;text-align:center;">
                                        
                                        
                                        <div class="row justify-content-center">
                                           <br>
                                            <div class="col-md-6 mb-3">
                                                @if(isset(session('medico')->data[0]->info[0]->firma))
                                                    <img class="img-fluid col-md-9" src="{{str_replace('https://200.48.199.90:8002','https://racso.doctormas.com.pe',session('medico')->data[0]->info[0]->firma)}}"  alt="">
                                                @endif
                                            </div>
                                            
                                        </div>
                                        <small class="titlet d-block">Firma y sello</small>
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

