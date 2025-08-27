@extends('layout.app')
@section('content')
	@php
	$page ='usuarios';
	@endphp
		{{ csrf_field() }}
		<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
				<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="kt-font-brand flaticon-users-1"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								Usuarios
							</h3>
						</div>

					</div>
					<div class="kt-portlet__body">
						<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
							<div class="row align-items-center justify-content-center">
								<div class="col-xl-10 order-2 order-xl-1">
									<div class="row align-items-center">
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-input-icon kt-input-icon--left">
												<input type="text" class="form-control" placeholder="Buscar por nombres" id="generalSearch">
												<span class="kt-input-icon__icon kt-input-icon__icon--left">
													<span><i class="la la-search"></i></span>
												</span>
											</div>
										</div>
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__label">
													<label>Tipo:</label>
												</div>
												<div class="kt-form__control">
													<select class="form-control bootstrap-select" id="kt_form_type">
														<option value="-1">Todos</option>
														<option value="1">Super administrador</option>
														<option value="2">Supervisor</option>
														<option value="3">Gestor</option>
														<option value="4">Supervisor Seguimiento</option>
													</select>
												</div>
											</div>
										</div>
										 <a href="{{url('crearusuario')}}" class="btn btn-label-brand btn-bold">Agregar Usuario</a>
									</div>


								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__body kt-portlet__body--fit">
						<div class="kt-datatable" id="ajax_data">
						</div>
					</div>
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
								  <option value="10">5</option>
								  <option value="20">10</option>
								  <option value="30">20</option>
								  <option value="40">30</option>
								  <option value="50">40</option>
								</select>
							</div>
						</div>
					</div>
			</div>				





@endsection

@push('scripts')
 	<script src="{{asset('/assets/js/sanna/usuario/usuarios-ajax.js')}}" type="text/javascript"></script> 
@endpush