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

    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-sm-4 mx-auto">
                    <div class="divLogin text-center">
                        <div class="justify-content-center">
                            <div class="col-md-10 mx-auto">
                           
                                <h1 id="h1">Cambiar contraseña</h1>

                                <div class="text-center">
                                    <a href="https://200.48.199.90:8090/sanna/web/public/"><img src="{{ asset('/assets/images/login/login.svg') }}" class="img-fluid logo"></a>
                                </div>

                                <div id="alerts"></div>
                                <br>
                                

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm campo" value="{{$dni}}" disabled  onkeypress="return valideKey(event);" maxlength=9 id="user" autocomplete="off"   placeholder="DNI">
                                </div> 

                                
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" onclick="mostrarPassword()" id="show_password" ><i class="far fa-eye"></i></span>
                                    </div>
                                    <input type="password" id="password" class="form-control form-control-sm campo password" autocomplete="off" placeholder="Ingresa la nueva contraseña">
                                    
                                </div> 

                        
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mx-auto">
                                        <button id="button" class="btn change">
                                            Cambiar  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                  
                        </div>
                    </div>
                   

           
               


                </div>
            </div>
        </div>


        <!-------script----------->
        <script src="{{ URL::asset('/assets/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/login/login.js') }}"></script>

    </body>
</html>