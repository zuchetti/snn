@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
<link href="{{ URL::asset('/assets/css/sanna/medicamentos/medicamentos.css')}}" rel="stylesheet">

@endpush
@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp
    {{ csrf_field() }}

    <input type="hidden" id="idmedicamento" value="{{$idmedicamento}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->
			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">
                        <a href="javascript:history.back(1)" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                            Editar medicamento
                        </h3>
                    </div>
                </div>
            </div>
            
            <!-------body----------------->

            <div class="kt-portlet__body">

                <div id="alerts"></div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <label>Código producto</label>
                        <input type="text" value="{{$info->data[0]->cod_producto}}"  class="letrasyn form-control form-control-sm campo" id="cod_producto">

                        <label>Producto</label>
                        <input type="text" value="{{$info->data[0]->producto}}" class="letrasyn form-control form-control-sm campo" id="producto">

                        <label>Tipo</label>
                        <select class="form-control form-control-sm campo" id="tipo">
                            @if($info->data[0]->tipo==0)
                                <option value="0" selected>Medicamentos</option>
                                <option value="1">Material Médico</option>
                            @endif
                                @if($info->data[0]->tipo==1)
                                <option value="1" selected>Material Médico</option>
                                <option value="0">Medicamentos</option>
                                @endif
                             
                        </select>

                       

                    </div>
                    <div class="col-md-4">
                        <label>Presentación</label>
                        <select class="form-control form-control-sm campo" id="presentacion">
                            @foreach($presentacion as $item)
                                @if($item->id==$info->data[0]->presentacion)
                                <option value="{{$item->id}}" selected>{{$item->descripcion}}</option>
                                @endif
                                @if($item->id!=$info->data[0]->presentacion)
                                <option value="{{$item->id}}">{{$item->descripcion}}</option>
                                @endif
                            @endforeach
                        </select>

                        <label>Precio costo 1</label>
                        <input type="text"  value="{{$info->data[0]->precio_costo1}}" class="form-control form-control-sm campo decimales" maxlength=5 id="precio_costo1">

                        <label>Precio venta 1</label>
                        <input type="text"  value="{{$info->data[0]->precio_venta1}}" class="form-control form-control-sm campo decimales" maxlength=5 id="precio_venta1">
                    </div>
                    <div class="col-md-4">
                            
                        <label>Precio venta 2</label>
                        <input type="text"  value="{{$info->data[0]->precio_venta2}}" class="form-control form-control-sm campo decimales" maxlength=5 id="precio_venta2">

                        <label>Precio farm ext 1</label>
                        <input type="text"  value="{{$info->data[0]->precio_farmext}}" class="form-control form-control-sm campo decimales" maxlength=5 id="precio_farmext">

                    

                        <label>Cantidad presentación</label>
                        <input type="text"  value="{{$info->data[0]->cant_presentacion}}" onkeypress="return valideKey(event);" class="form-control form-control-sm campo decimales" maxlength=4 id="cant_presentacion">
                    </div>
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button class="btn agregar" id="boton">
                            Actualizar <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                        </button>
                    </div>
                </div>

            </div>

            <!-------end body----------------->


        </div>
    </div>




@endsection
@push('scripts')
<script src="{{ asset('assets/js/sanna/medicamentos/editMedicamento.js') }}" type="text/javascript"></script>
@endpush