@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='gestionmedicamentos';
    @endphp
    {{ csrf_field() }}


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-5">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('medic_topico_detail')}}?idfuncionalidad=19&idtopico={{$idtopico}}" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Actualizar stock
                        </h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <button  class="btn" id="descarga"><i class="fas fa-cloud-download-alt"></i> Descargar</button>
                </div>
              
			</div>
            

            <!-------BODY----------------->
            <div class="kt-portlet__body">
              
                <div class="row justify-content-center">
                    <div class="col-md-8 mx-auto">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">                            
                            <ol>
                                <li>Descargue la solicitud</li>
                                <li>Edite el achivo csv descargado</li>
                                <li>Adjunte el archivo csv actualizado</li>
                            </ol> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                 

                    <div class="col-md-6">
                        <form id="uploadForm" method="post" action="update_stock_botiquin"  enctype="multipart/form-data">

                            <label>Adjuntar archivo csv:</label>
                            <input class="form-control form-control-lg" required name="file" id="formFileLg" type="file"
                            accept=".csv" >
                            <br>
                            <input type="hidden" value="{{$idtopico}}" name="idtopico" id="idtopico">

                            <br>

                                
                            @if($errors->any())
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{$errors->first()}}

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <br>



                            <div class="row justify-content-center">
                                <div class="col-md-6 mx-auto">
                                    <div class="text-center">
                                        <button type="submit"   id="boton3" class="btn boton4">Subir</button>
                                    </div>
                                </div>
                            </div>


                        </form>
                    
                    </div>

                </div>
            </div>
            <!-------END BODY----------------->
    


        </div>
    </div>
  

@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
    <script src="{{ URL::asset('/assets/js/global/validar.js') }}"></script>
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/assets/js/sanna/pedidos/detalle2.js') }}"></script>

@endpush
