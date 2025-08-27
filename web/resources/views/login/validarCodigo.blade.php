<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/favicon.png') }}" sizes="64x64">
        <title>Validar | Sanna</title>
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
                            <div class="col-md-10 mx-auto">
                           
                                <form id="uploadForm" method="post" action="validate_code">


                                    <div class="text-center">
                                        <a href="https://dev.mapsalud.com/clientes/doctorsannadev/web/public/"><img src="{{ asset('/assets/images/login/login.svg') }}" class="img-fluid logo"></a>
                                    </div>

                                    <?php

                                        $parts = explode('@', session('medico')->data[0]->info[0]->email);
                                        $email =substr($parts[0], 0, min(1, strlen($parts[0])-1)) . str_repeat('*', max(1, strlen($parts[0]) - 1)) . '@' . $parts[1];

                                    ?>

                                    <h1 id="h1">Ingresa el PIN de autenticación</h1>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </span>
                                        </div>
                                        <input type="text" name="token" class="form-control form-control-sm campo letrasyn" required autocomplete="off"   placeholder="Escribe aquí..">
                                    </div> 

                                    <input type="hidden" name="dni" value="{{ $dni }}">

                                    @if($errors->any())
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            {{$errors->first()}}
                
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                       
                                    @endif
            

                                    <div class="row justify-content-center">
                                        <div class="col-md-6 mx-auto">
                                            <button id="button" class="btn login">
                                            Enviar  <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                                            </button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                  
                        </div>
                    </div>
                   

           
               


                </div>
            </div>
        </div>


        <!-------script----------->
        <script src="{{ URL::asset('/assets/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/validar.js') }}"></script>

    </body>
</html>