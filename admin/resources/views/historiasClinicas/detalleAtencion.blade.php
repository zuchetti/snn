@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='historiasclinicas';
    @endphp
    {{ csrf_field() }}


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
                    <a href="javascript:history.back(1)" >
                        <i class="fas fa-angle-double-left"></i>
                    </a>
					<h3 class="kt-portlet__head-title" >
                        Detalle historia medica
                        <!-- <img src="https://200.48.199.90:8002/sanna/web/public/assets/images/logo/sanna.png" alt=""> -->
					</h3>
				</div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <div class="row">
                    <div class="col-md-4 p-4">
                        <h1 id="hh">Fecha de atención</h1>
                        <p id="hh6"><?php echo date('Y/m/d',strtotime($info->data[0]->fec_atencion));?></p>

                        <h1 id="hh">Nº HC</h1>
                        <p id="hh6">{{$info->data[0]->nro_autorizacion}}</p>

                        <h1 id="hh">Nº Autorización siteds</h1>
                        <p id="hh6">{{$info->data[0]->autorizacion}}</p>

                        <h1 id="hh">Diagnóstico</h1>
                        <p id="hh6">{{$info->data[0]->diagnosticos}}</p>
                    </div>
                    <div class="col-md-4 p-4">

                        @if($filiacion->status==200)
                            <div>
                                <h4 id="hh">Hojas de filiación</h4>
                                <a href="{{$filiacion->data->url}}" target="_blank" class="btn" id="enlaceA"><i class="fas fa-file-medical-alt"></i> Descargar</a>
                            </div>
                        @endif

                        @if($atencion->status==200)
                            <div>
                                <h4 id="hh">Registro de la atención</h4>
                                <a href="{{$atencion->data->url}}" target="_blank" class="btn" id="enlaceA"><i class="fas fa-file-medical-alt"></i> Descargar</a>
                            </div>
                        @endif

                   
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
                            <div>
                                <h4 id="hh">Pdf siteds </h4>
                                <a href="pdf_siteds?idatencion={{$idatencion}}" target="_blank" class="btn" id="enlaceA"><i class="fas fa-file-medical-alt"></i> Descargar</a>
                            </div>
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
                            
                    
                        @if($descanso->status==200)
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


