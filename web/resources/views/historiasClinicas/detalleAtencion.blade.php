@extends('layout.navbar')
@push('css')
<link href="{{ asset('assets/css/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

@endpush
@section('content')
    <br>

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
                    <a href="{{url('HistoryClinicDetail')}}?dni={{$dni}}&nombre={{$nombre}}" >
                        <i class="fas fa-angle-double-left"></i>
                    </a>
					<h3 class="kt-portlet__head-title" >
                        Detalle historia clínica
					</h3>
				</div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <div class="row justify-content-center">
                    <div class="col-md-4 p-4">
                        <h4>Fecha de atención</h4>
                        <p id="hh6"><?php echo date('Y/m/d',strtotime($info->data[0]->fec_atencion));?></p>

                        <h4 id="hh">Nº HC</h4>
                        <p id="hh6">{{$info->data[0]->nro_autorizacion}}</p>

                        <h4 id="hh">Diagnóstico</h4>
                        <?php
                            $presuncion_diagnostica = explode(",", $info->data[0]->diagnosticos);
                           $diag=[];
                            foreach($dianostics->data as $item){
                                $diag[]=$item;
                            }
                        ?>
                        @foreach($presuncion_diagnostica as $u)
                            <?php
                                $key = array_search($u,array_column($diag,'cie10'))
                            ?>
                                            
                            <p id="hh6"> {{$diag[$key]->diagnostico}} - cie10: {{$u}}</p>
                        @endforeach
               
                    </div>
                    <div class="col-md-4 p-4">

                        @if($receta->status==200)

                            @if($receta->data->url_i!="")
                            <div>
                                <h4 id="hh">Receta médica (Botica Interna)</h4>
                                <a href="{{$receta->data->url_i}}" target="_blank" class="btn" id="enlaceA"><i class="fas fa-file-medical-alt"></i> Descargar</a>
                            </div>
                            @endif
                            <br>
                            @if($receta->data->url_h!="")
                            <div>
                                <h4 id="hh">Receta médica (Botica Externa)</h4>
                                <a href="{{$receta->data->url_h}}" target="_blank" class="btn" id="enlaceA"><i class="fas fa-file-medical-alt"></i> Descargar</a>
                            </div>
                            @endif
                        @endif

                        @if($examen->status==200)

                            @if($examen->data->url_i!="")

                            <div>
                                <h4 id="hh">Ordenes de examenes auxiliares(imagenes)</h4>
                                <a href="{{$examen->data->url_i}}" target="_blank" class="btn" id="enlaceA"><i class="fas fa-file-medical-alt"></i> Descargar</a>
                            </div>
                            <br>
                            @endif

                            @if($examen->data->url_l!="")

                            <div>
                                <h4 id="hh">Ordenes de examenes auxiliares(laboratorio)</h4>
                                <a href="{{$examen->data->url_l}}" target="_blank" class="btn" id="enlaceA"><i class="fas fa-file-medical-alt"></i> Descargar</a>
                            </div>
                            <br>
                            @endif

                        @endif
                        
                    
                        @if($descanso->status==200 && $descanso!=null)
                        <div>
                            <h4 id="hh">Descanso médico</h4>
                            <a href="{{$descanso->data->url}}" target="_blank" class="btn" id="enlaceA"><i class="fas fa-file-medical-alt"></i> Descargar</a>
                        </div>
                        <br>
                        @endif
                     
                                          

                    </div>
                </div>
                
                
            </div>
            <!-------end BODY----------------->


        </div>
    </div>



@endsection


