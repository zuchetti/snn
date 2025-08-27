@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='gestionmedicamentos';
    @endphp
    {{ csrf_field() }}


    <input type="hidden" value="{{$idreposicionh}}" id="idreposicionh">
    <input type="hidden" value="{{$state}}" id="estado">

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
			
                <div class="col-md-5">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('gestionmedicamentos')}}?idfuncionalidad=19" >

                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Detalle solicitud de reposición
                        </h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <button  class="btn" id="descarga"><i class="fas fa-cloud-download-alt"></i> Descargar solicitud</button>
                </div>
                @if($state==0)
                <div class="col-md-2">
                    <button class="btn" onclick="remover()" id="boton10"> Denegar </button>
                </div>
                <div class="col-md-2">
                    <button  class="btn aprobar" id="boton"> Aprobar </button>
                </div>
                @endif
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
              

                <br>
                <div id="alerts"></div>
                <br>
                <div class="kt-datatable" id="ajax_data"></div>
    
                <div class="row">
                    <div class="col-md-10">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center" id="paginas">                                          
                            </ul>
                        </nav>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" id="petxpag">
                            <option value="150">150</option>
                                <option value="300">300</option>
                                <option value="450">450</option>
                                <option value="650">650</option>
                                <option value="800">800</option>
                            </select>
                        </div>
                    </div>
                </div>

            
              
            </div>
            <!-------END BODY----------------->

        </div>
    </div>
    <br>

    
    @include('components.modalConfirm')

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/assets/js/sanna/pedidos/detalle.js') }}"></script>

@endpush


