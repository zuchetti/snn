@extends('layout.navbar')
@push('css')
<link href="{{ URL::asset('/assets/css/dashboard/topico.css')}}" rel="stylesheet">
@endpush
@section('content')

    <div class="container-fluid sectionContent">
        <div class="row justify-content-center">
            <div class="col-lg-10 mx-auto">
                <h1 class="title">
                    <a href="{{url('topico')}}" >
                        <i class="fas fa-arrow-left"></i>
                    </a>
                              
                    Ir a topicos
                </h1>

                <div class="justify-content-center">
                    <div class="col-md-10 mx-auto">

                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <a href="{{url('newAtencion')}}">
                                    <div class="divTopico">
                                        <div class="text-center">
                                            <img src="{{ asset('/assets/images/dashboard/registrer.svg') }}" class="img-fluid imgP">
                                        </div>
                                        <h2 id="textT">
                                            <div>
                                            Registro
                                            </div>
                                            <div>
                                            de atención
                                            </div>
                                                
                                        </h2>
                                                
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{url('historiasClinicas')}}">
                                    <div class="divTopico">
                                        <div class="text-center">
                                            <img src="{{ asset('/assets/images/dashboard/history.svg') }}" class="img-fluid imgP">
                                        </div>
                                        <h2 id="textT">
                                            <div>
                                                Historias
                                            </div>

                                            <div>
                                                Clínicas
                                            </div>
                                                    
                                        </h2>
                                                
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                            <a href="{{url('stockMedicamentos')}}">
                                    <div class="divTopico">
                                        <div class="text-center">
                                            <img src="{{ asset('/assets/images/dashboard/stock.svg') }}" class="img-fluid imgP">
                                        </div>
                                        <h2 id="textT">
                                            <div>
                                            Stock 
                                            </div>
                                            <div>
                                                medicamentos
                                            </div>
                                        </h2>
                                                
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <a href="{{url('basedeAtenciones')}}">

                                    <div class="divTopico">
                                        <div class="text-center">
                                            <img src="{{ asset('/assets/images/dashboard/base.svg') }}" class="img-fluid imgP">
                                        </div>
                                        <h2 id="textT">
                                            <div>
                                            Base de
                                            </div>
                                            <div>
                                                atenciones
                                            </div>
                                        </h2>
                                                
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection


