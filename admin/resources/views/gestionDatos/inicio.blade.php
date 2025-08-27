@extends('layout.app')
@section('title', 'Gestión de datos')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">
@endpush

@section('content')
    @php
        $page ='gestiondebasededatos';
    @endphp

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">

            <!-------HEAD----------------->

			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title" >
						Gestion de base de datos
					</h3>
				</div>
               
			</div>
            
            <!-------BODY----------------->
            <div class="kt-portlet__body">
                <div class="row justify-content-center">
                    @foreach ($result->data as $item)
                        <?php
                                $conv = ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o' , 'ú' => 'u', '/' => '','@'=>'','ñ'=>'n','-'=>'','!'=>"",'¡'=>""];
                                $link  = strtolower(str_replace(' ', '',strtr( $item->nombre, $conv))); 
                             
                        ?>
                        <div class="col-md-3">
                            <div class="box text-center">
                                <div id="tota">Total</div>
                                <div id="text77">{{$item->cantidad}}</div>

                                <div id="texti">{{$item->nombre}}</div>

                                <a href="{{url($link)}}?idsubfuncionalidad={{$item->idsubfuncionalidad}}" id="boton4" class="btn">Ingresar</a>

                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            <!-------END BODY----------------->

        </div>
    </div>


@endsection