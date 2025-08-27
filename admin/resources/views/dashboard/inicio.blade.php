@extends('layout.app')
@push('css')
<script src="{{ asset('assets/js/apexcharts.js') }}" type="text/javascript"></script>
@endpush
@section('content')
    @php
        $page ='inicio';
    @endphp


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title" >
						Dashboard
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">

				<div id="kt_gchart_1" style="height:100%;"></div>


				<div id="kt_gchart_2" style="height:100%;"></div>

			</div>
		
        </div>

		

               
    </div>
	
	<div id="prueba">
		@include('components.graficasInicio');
	</div>
	


@endsection
@push('scripts')
<!--     <script src="{{ asset('assets/js/dashboard/inicio.js') }}" type="text/javascript"></script>	
 -->@endpush