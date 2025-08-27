<html>
    <head>
        <title>Sanna</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ URL::asset('/assets/images/logo/favicon.png') }}" sizes="64x64">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="base_url" content="{{ URL::to('/') }}">
        <link href="{{ URL::asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/all.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/navbar/navbar.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/dashboard/dashboard.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script>url='{{asset('')}}'</script>
        @stack('css')
        <script src="{{ URL::asset('/assets/js/jquery.js') }}"></script>     
        <script type="text/javascript">
            window.history.forward();
           function noBack() {
               window.history.forward();
           }
       </script>
    </head>
  
    <body  onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
        <nav class="navbar navbar-expand" id="navbar" >
            <div class="container-fluid">
                <div class="col-lg-8 col-md-5">
                    <div class="navbar-brand">
                        <a href="{{url('dashboard')}}"><img src="{{ asset('/assets/images/logo/logo.svg') }}" alt="*"  class="img-fluid atento"></a>
                    </div>
                </div>
                
                <div class="col-lg-4 d-flex justify-content-end col-md-7 text-right">

                    
                    <a id="logout" href="{{url('dashboard')}}" class="my-auto"> <i class="fas fa-clinic-medical"></i> Inicio</a>
                    <div class="dropdown btn-group dropleft my-auto ml-3">
                        <button class=" bg-transparent border-0 my-auto" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear-fill text-white h4"></i>
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
                                @if(session('medico')->data[0]->info[0]->google2fa_secret!=1)
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
        </nav>

        @yield('content')

        <script src="{{ URL::asset('/assets/js/popper.min.js') }}" ></script>
        <script src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/validar/validar.js') }}"></script>
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

        @stack('scripts')

    </body>
</html>