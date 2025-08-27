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
        @csrf

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-sm-4 mx-auto">
                    <div class="divLogin text-center">
                        <div class="justify-content-center">
                          
                            <!-- <form action="login" method="post">
                                 <button type="submit">login</button>
                            </form> -->
                            <div class="col-md-10 mx-auto">
                           
                                <h1 id="h1">Bienvenido/a</h1>

                                <div class="text-center">
                                    <a href="https://racso.doctormas.com.pe/sanna/web/public/"><img src="{{ asset('/assets/images/login/login.svg') }}" class="img-fluid logo"></a>
                                </div>

                                <div id="alerts"></div>
                                <br>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm campo"  onkeypress="return valideKey(event);" maxlength=9 id="user" autocomplete="off"   placeholder="DNI">
                                </div> 

                                
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" onclick="mostrarPassword()" id="show_password" ><i class="far fa-eye"></i></span>
                                    </div>
                                    <input type="password" id="password" class="form-control form-control-sm campo password" autocomplete="off" placeholder="Contraseña">
                                    
                                </div> 

                                <div class="text-right">
                                    <a href="{{url('forgetPassword')}}" id="olv">Olvide mi contraseña</a>
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
                        
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mx-auto">
                                        <button id="button" class="btn login">
                                        Ingresar  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                  
                        </div>
                    </div>
                   

           
               


                </div>
            </div>
        </div>
        <!-- <div style="bottom:40%" class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <div class="w-100 text-center">
                <strong>¡Comunicado Importante!</strong>
            </div>
            <br>
            A partir del 15 de Agosto de 2022 se realizará la activación progresiva del segundo factor de autenticación, el cual consiste en enviar un Código de Seguridad de 6 dígitos al correo electrónico que utilizas para acceder a la plataforma.
            <br>
            Te sugerimos verificar que tu correo electrónico sea válido y tengas acceso al mismo, de lo contrario, favor contactar al administrador de tu sede.</a>
        </div> -->

        <!-------script----------->
        <script src="{{ URL::asset('/assets/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/login/login.js') }}?ver=1.19"></script>

    </body>
</html>