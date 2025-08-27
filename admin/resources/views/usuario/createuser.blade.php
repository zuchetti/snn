
@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/licencias/licencias.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
<link href="{{ asset('assets/css/login/wizard-4.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
	@php
		$page ='usuarios';
    @endphp	
						
	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="step-first">

			<!--end: Form Wizard Nav -->
			<div class="kt-portlet">

				<div class="kt-portlet__body kt-portlet__body--fit">

					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<a href="{{url('usuarios')}}" >
                        		<i class="fas fa-angle-double-left"></i> 
                    		</a>  
							<h3 class="kt-portlet__head-title" > 
								Volver
							</h3>
						</div>
               
					</div>

					<div class="kt-grid">
						<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

							<!--begin: Form Wizard Form-->
							<form class="kt-form" id="kt_user_add_form">

								<!--begin: Form Wizard Step 1-->
								<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
									
									<div class="kt-section kt-section--first">
										<div class="kt-wizard-v4__form">
											<div class="row">
												<div class="col-xl-12">
													<div class="kt-section__body">
														<div class="form-group row">
															<div class="col-lg-9 col-xl-6">
																<h3 class="kt-section__title kt-section__title-md">Crear Usuario</h3>
															</div>
														</div>
														<div id="alertaa"></div>

														<div class="form-group row">
															<label class="col-xl-3 col-lg-3 col-form-label">Nombres</label>
															<div class="col-lg-9 col-xl-9">
																<input class="form-control" type="text" value="" id="nombre">
															</div>
														</div>
														<div class="form-group row">
															<label class="col-xl-3 col-lg-3 col-form-label">Apellidos</label>
															<div class="col-lg-9 col-xl-9">
																<input class="form-control" type="text" value="" id="apellidos">
															</div>
														</div>
														<div class="form-group row">
															<label class="col-xl-3 col-lg-3 col-form-label">Email</label>
															<div class="col-lg-9 col-xl-9">
																<div class="input-group">
																	<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
																	<input type="text" class="form-control" id="email" value="" placeholder="Email" aria-describedby="basic-addon1">
																</div>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-xl-3 col-lg-3 col-form-label">DNI</label>
															<div class="col-lg-9 col-xl-9">
																<input class="form-control" maxlength="9" type="text" value="" id="dni">
															</div>
														</div>
														<div class="form-group row">
															<label class="col-xl-3 col-lg-3 col-form-label">Contraseña</label>
															<div class="col-lg-9 col-xl-9">
																<input class="form-control" type="password" value="" id="pass">
															</div>
														</div>
														<div class="form-group row">
															<label class="col-xl-3 col-lg-3 col-form-label">Validar Contraseña</label>
															<div class="col-lg-9 col-xl-9">
																<input class="form-control" type="password" value="" id="pass2">
															</div>
														</div>
														<div class="form-group row">
															<label class="col-xl-3 col-lg-3 col-form-label">Rol de usuario</label>
															<div class="col-lg-9 col-xl-9">
																<select id="idrol" class="form-control">
																							
																	<option value="2">Supervisor</option>
																	<option value="3">Gestor Operario</option>
																	<option value="4">Supervisor Seguimiento</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!--end: Form Wizard Step 1-->




								<!--begin: Form Actions -->
								<div class="kt-form__actions">

									<div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit" id="submit">
										Crear
									</div>
									
								</div>
								
								<!--end: Form Actions -->
							</form>

							<!--end: Form Wizard Form-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
					
@endsection
@push('scripts')
 <script src="{{ asset('/assets/js/sanna/usuario/crearusuario.js') }}" type="text/javascript"></script>

@endpush