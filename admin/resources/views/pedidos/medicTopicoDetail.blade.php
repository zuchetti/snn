@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
@endpush
@section('content')
    @php
        $page ='gestionmedicamentos';
    @endphp
    {{ csrf_field() }}


    <input type="hidden" id="idtopico" value="{{$idtopico}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-6">
                    <div class="kt-portlet__head-label">
                        <a href="{{url('medicamentos_topico')}}?idfuncionalidad=19" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                                Medicamentos en el tópico
                        </h3>
                    </div>

                </div>

                <div class="col-md-4">
                    <a class="btn descarga" id="descarga" href="{{url('medic_TopicoDetail2')}}?idtopico={{$idtopico}}" ><i class="fas fa-pencil-alt"></i>Carga masiva</a>
                </div>


         
              
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
               
                <div id="alerts6"></div>
                <br>

                <div class="kt-datatable" id="ajax_data"></div>
    
              <!--   <div class="row">
                    <div class="col-md-10">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center" id="paginas">                                          
                            </ul>
                        </nav>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" id="petxpag">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>

                </div> -->
            </div>

            <!-------end body----------------->


        </div>
    </div>
   

    <input type="hidden"  id="idbotiquinitem">

    @include('components.modalConfirm')


@endsection


@push('scripts')
    <script src="{{asset('assets/js/sanna/pedidos/allMedicamentoTopico.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
@endpush