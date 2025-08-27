<!DOCTYPE html>
<html lang="es">
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Sanna | Administrador</title>
		<link rel="icon" type="image/png" href="{{ URL::asset('/assets/images/logo/favicon.png') }}" sizes="64x64">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<link href="{{ asset('assets/css/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

		<!--begin::Layout Skins(used by all pages) -->
		<link href="{{ asset('assets/css/skins/header/base/dark.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/skins/header/menu/dark.css') }}" rel="stylesheet" type="text/css" />
		
		<link href="{{ asset('assets/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script>url='{{asset('')}}'</script>


		 @stack('css')

		
	</head>

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		
		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="{{url('dashboard')}}">
					<img alt="*" src="{{ asset('/assets/images/logo/logo.svg') }}" class="img-fluid">				
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->

		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<!-- ///////////BARRA LATERAL//////////////////  -->
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- ------------------logo-------------------------------- -->
					<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<a href="{{url('dashboard')}}">
								<img alt="*" src="{{ asset('/assets/images/logo/logo.svg') }}" class="img-fluid" />
							</a>
						</div>
						<div class="kt-aside__brand-tools">
							<button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
											<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
										</g>
									</svg>
                                </span>
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
										</g>
									</svg>
                                </span>
							</button>

						</div>
					</div>

					<!-- -----------------------------Menu------------------------------------------------ -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
							 <ul class="kt-menu__nav ">
							 	

                                <?php
									$menu=Session::get('menu');
								?>
								@foreach ($menu->data as $item)
	                                <?php
	                                    $conv = ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o' , 'ú' => 'u', '/' => '_','@'=>'','ñ'=>'n'];
	                                    $link  = strtolower(str_replace(' ', '',strtr($item->funcionalidad, $conv))); 
									?>
									
								<li class="kt-menu__item  kt-menu__item--@php if ($page==$link) {
										echo 'active';
										} @endphp" aria-haspopup="true">
									<a href="{{$link}}?idfuncionalidad={{$item->idfuncionalidad}}" class="kt-menu__link ">
										<span class="kt-menu__link-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<?php
													 echo ($item->icono);
													?>
												</g>
											</svg>
										</span>
										<span class="kt-menu__link-text">{{$item->funcionalidad}}</span>
									</a>
								</li>
                                @endforeach
								

								<li class="kt-menu__item"  kt-menu__item aria-haspopup="true">
									<a href="{{url('logout')}}" class="kt-menu__link ">
										<span class="kt-menu__link-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
													<path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
										</span>
										<span class="kt-menu__link-text">Salir</span>
									</a>
								</li>

								
							</ul>

						
						</div>
					</div>


				</div>

				<!-- header -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
							
							</div>
						</div>
						<div class="kt-header__topbar">
							<!--usuario -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								
									<div class="kt-header__topbar-user">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Hola</span>
										<span class="kt-header__topbar-username kt-hidden-mobile">{{session('usuario')->data[0]->info[0]->nombres}} {{session('usuario')->data[0]->info[0]->apellidos}}</span>
										<img  alt="*" src="{{ asset('/assets/images/navbar/perfil.svg') }}" />
									</div>
									<div class="ms-3 my-auto">
										<div class="dropdown btn-group my-auto dropleft my-auto ml-3">
											<button class=" bg-transparent border-0 my-auto" type="button" data-toggle="dropdown" aria-expanded="false">
												<i class="bi bi-gear-fill text-dark h4"></i>
											</button>
											<div class="dropdown-menu">
												@if(session('state')!=null)
												@if(session('state')!=1)
													<div class="dropdown-item d-flex" >
														<div class="col-md-9 my-auto px-0">
															<p class="py-0 my-auto">Doble autenticación</p>
														</div>
														<div class="col-md-3 my-auto">
															<label class="switch my-auto">
															<input type="checkbox"   id="recibido" >
																<span class="slider round"></span>
															</label>
														</div>
													</div>
												@endif
												@else
													@if(session('usuario')->data[0]->info[0]->google2fa_secret!=1)
														<div class="dropdown-item d-flex" >
															<div class="col-md-9 my-auto px-0">
																<p class="py-0 my-auto">Doble autenticación</p>
															</div>
															<div class="col-md-3 my-auto">
																<label class="switch my-auto">
																<input type="checkbox"   id="recibido" >
																	<span class="slider round"></span>
																</label>
															</div>
														</div>
													@endif
												@endif
												<a  href="{{url('logout')}}" class="dropdown-item text-dark"> <i class="fas fa-sign-out-alt text-dark"></i> Salir</a>
												
											</div>
										</div>
									</div>
							

							</div>
						</div>

					</div>

					<!-- /////////////////INICIO DE CONTENIDO////////////////// -->
					@yield('content')



					<!--////////////////////////footer/////////////////// -->

					<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
						<div class="kt-container  kt-container--fluid">
							<div class="kt-footer__copyright">
								@php
									echo date("Y");
								@endphp
								&nbsp;&copy;&nbsp;Sanna
							</div>
							
						</div>
					</div>

				</div>
			</div>
		</div>



        <div id="kt_scrolltop" class="kt-scrolltop">

            <i class="fa fa-arrow-up"></i>
        </div>


		<!-- Scrolltop -->

		<script type="text/javascript">
			var KTAppOptions = {
			"colors": {
				"state": {
					"brand": "#5d78ff",
					"dark": "#282a3c",
					"light": "#ffffff",
					"primary": "#5867dd",
					"success": "#34bfa3",
					"info": "#36a3f7",
					"warning": "#ffb822",
					"danger": "#fd3995"
				},
				"base": {
					"label": [
						"#c5cbe3",
						"#a1a8c3",
						"#3d4465",
						"#3e4466"
					],
					"shape": [
						"#f0f3ff",
						"#d9dffa",
						"#afb4d4",
						"#646c9a"
					]
				}
			}
		};
		</script>
		
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>



         @stack('scripts')
		 <script>
            $('.dropdown-menu').on('click', function (e) {
                e.stopPropagation();
                console.log(`${e.target.textContent} clicado!`);
            });
            var checkbox = document.getElementById('recibido');
                checkbox.addEventListener( 'change', function() {
                    if(this.checked) {
                        window.location.href = url+'autentication_googleauth'
                    }
                });
        </script>
		

		
	
	</body>
</html>