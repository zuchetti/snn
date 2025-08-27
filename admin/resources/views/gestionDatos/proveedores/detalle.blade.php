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

    <input type="hidden" id="idproveedor" value="{{$idproveedor}}">
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg row myhead">
                <div class="col-md-12">
                    <div class="kt-portlet__head-label">

                        <a href="{{url('proveedores')}}" >
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <h3 class="kt-portlet__head-title" >
                           {{$razon_social}}
                        </h3>
                    </div>
                </div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">

                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">RUC</th>
                            <th scope="col">Razón social</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Email contacto</th>
                            <th scope="col">Tlf contacto</th>
                            <th scope="col">Concepto PL</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$info->data->ruc}}</td>
                            <td>{{$info->data->razon_social}}</td>
                            <td>{{$info->data->contacto}}</td>
                            <td>{{$info->data->email_contacto}}</td>
                            <td>{{$info->data->telf_contacto}}</td>
                            <td>{{$info->data->concepto_pl}}</td>
                        
                        </tr>
                    </tbody>
                </table>
               

            </div>


            <!-------end body----------------->


        </div>
    </div>



@endsection
