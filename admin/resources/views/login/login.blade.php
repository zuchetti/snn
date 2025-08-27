<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/favicon.png') }}" sizes="64x64">
        <title>Iniciar sesión | Sanna</title>
        <link href="{{ URL::asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/all.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('/assets/css/login/login.css')}}" rel="stylesheet">
        <script>url='{{asset('')}}'</script>

    </head>
    <body>
        {{ csrf_field() }}

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-4 mx-auto">
                    <h1 id="h1">Bienvenido/a</h1>

                    <div class="text-center">
                        <img src="{{ asset('/assets/images/login/login.svg') }}" class="img-fluid logo">
                    </div>

                    <div id="alerts"></div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input type="text" class="form-control form-control-sm campo"  onkeypress="return valideKey(event);" maxlength=9 id="user" autocomplete="off"   placeholder="Ingrese su DNI">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input type="password" id="password" class="form-control form-control-sm campo" autocomplete="off" placeholder="Ingrese su contraseña">
                    </div> 
                    <br>
                         
                    @if($errors->any())
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{$errors->first()}}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <br>


                 <!--    <div class="text-right">
                        <a href="{{url('olvidePassword')}}" id="enlace">
                            Olvide mi contraseña
                        </a>
                    </div> -->
                    
                    <button id="button" class="btn login">
                       Ingresar  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                    </button>


                </div>
            </div>
        </div>


        <!-------script----------->
        <script src="{{ URL::asset('/assets/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/login/login.js') }}"></script>

    </body>
</head>