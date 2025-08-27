<html>
    <head>
        <title>Sanna</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="cache-control" content="no-cache"/>
		<meta http-equiv="expires" content="43200"/>
        <link rel="icon" type="image/png" href="{{ URL::asset('/assets/images/logo/favicon.png') }}" sizes="64x64">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="base_url" content="{{ URL::to('/') }}">
        <link href="{{ URL::asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/all.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/navbar/navbar.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/dashboard/dashboard.css')}}" rel="stylesheet">
           
        @stack('css')
        <script src="{{ URL::asset('/assets/js/jquery.js') }}"></script>     
        <script type="text/javascript">
            window.history.forward();
           function noBack() {
               window.history.forward();
           }
       </script>
       
    </head>
  
    <body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
        <nav class="navbar navbar-expand" id="navbar" >
            <div class="container-fluid">
                <div class="col-lg-8 col-md-5">
                    <div class="navbar-brand">
                        @if(session('topico')!=null)
                        <a href="{{url('dashboard')}}"><img src="{{ asset('/assets/images/logo/logo.svg') }}" alt="*"  class="img-fluid atento"></a>
                        @else
                        <a href="{{url('topico')}}"><img src="{{ asset('/assets/images/logo/logo.svg') }}" alt="*"  class="img-fluid atento"></a>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-7 text-right">
                        @if(session('topico')!=null)
                        <a id="logout" href="{{url('dashboard')}}"> <i class="fas fa-clinic-medical"></i> Inicio</a>
                        @else
                        <a id="logout" href="{{url('topico')}}"> <i class="fas fa-clinic-medical"></i> Inicio</a>
                        @endif

                        <a id="logout" href="{{url('logout')}}"> <i class="fas fa-sign-out-alt"></i> Salir</a>
                </div>

            </div>
        </nav>
        <div class="wrapper">
        
            @if(session('paciente')!=null)
            <nav id="sidebar">        
                <ul class="list-unstyled components">
                    
                    <li class="menu @if($page=='history') active @endif" id="menu">
                            <a href="{{url('historyClinic')}}">
                                <img src="{{ asset('/assets/images/navbar/historia.svg') }}" alt="*" class="img-fluid imgM">
                                <div id="text_menu">Hoja de Filiación</div>
                     
                            </a>
                        
                    </li>

                    <li class="menu @if($page=='diagnostic') active @endif" id="menu">
                        <a href="{{url('diagnostico')}}">
                            <img src="{{ asset('/assets/images/navbar/diagnost.svg') }}" alt="*" class="img-fluid imgM">
                            <div id="text_menu">Hoja de Registro de Atención</div>

                        </a>
                    </li>
                    

                    @if(session('paciente')->tipo_atencion!=1)
                    <li class="menu @if($page=='receta') active @endif" id="menu">
                        <a href="{{url('recetaMedica')}}">

                            <img src="{{ asset('/assets/images/navbar/receta.svg') }}" alt="*" class="img-fluid imgM">
                            <div id="text_menu">Receta médica</div>
                        </a>
                    </li>
                    @endif


                    @if(session('paciente')->tipo_atencion!=1)

                    <li class="menu @if($page=='examenes') active @endif" id="menu">
                        <a href="{{url('examenesAuxiliares')}}">
                            <img src="{{ asset('/assets/images/navbar/examenes.svg') }}" alt="*" class="img-fluid imgM">
                            <div id="text_menu">Examenes Auxiliares</div>
                        </a>
                    </li>
                    @endif


                    <li class="menu @if($page=='descanso') active @endif" id="menu">
                        <a href="{{url('descansoMedico')}}">
                            <img src="{{ asset('/assets/images/navbar/descanso.svg') }}" alt="*" class="img-fluid imgM">
                            <div id="text_menu">Descanso médico</div>
                        </a>
                    </li>
          

                    <li class="menu @if($page=='finalizar') active @endif" id="menu">
                        <a href="{{url('finish_attention')}}">

                            <img src="{{ asset('/assets/images/navbar/finalizar.svg') }}" alt="*" class="img-fluid imgM">
                            <div id="text_menu">Finalizar Atención</div>
                        </a>
                        
                    </li>

                   
                    
                </ul>
            </nav>
            
            <div id="content" class="container-fluid">

                    
                    
                @yield('content')

            </div>
            @else
            <div id="content" class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10 mx-auto">
                        <div class="divPrin">
                            ERROR EN LA SESION DEL PACIENTE INTENTE

                        <div>

                    </div>
                </div>
            </div>
           
            @endif

        </div>
        
    <script src="{{ URL::asset('/assets/js/popper.min.js') }}" ></script>
    <script src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/validar/validar.js') }}"></script>

    @stack('scripts')


</body>
</html>