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
                <div class="col-lg-3 col-sm-4 mx-auto">
                    <h1 id="h11">Olvidé mi contraseña</h1>

                    <div class="text-center">
                        <img src="{{ asset('/assets/images/login/login.svg') }}" class="img-fluid logo">
                    </div>

                    <div id="pp">
                        <div>
                        Ingresa tu correo para recibir el PIN 
                        </div>
                        <div>
                            para restablecer tu contraseña.
                        </div>
                    </div>
                  

                    <input class="form-control form-control-sm campo" placeholder="Ingrese su correo electrónico">

                   
                    <button id="button" class="btn">Enviar</button>


                </div>
            </div>
        </div>


        <!-------script----------->
        <script src="{{ URL::asset('/assets/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/login/login.js') }}"></script>

    </body>
</head>