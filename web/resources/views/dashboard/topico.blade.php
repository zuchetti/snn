@extends('layout.navbar')
@push('css')
<link href="{{ URL::asset('/assets/css/dashboard/topico.css')}}" rel="stylesheet">
@endpush
@section('content')

    <div class="container-fluid sectionContent">
        <div class="row justify-content-center">
            <div class="col-lg-10 mx-auto">
                <div class="divPrin">
                    <div class="justify-content-center">
                        <div class="col-md-10 mx-auto">
                            <h1 class="title">Selecciona el Tópico</h1>
                            <div class="row justify-content-center">
                            @foreach($topicos->data as $item)
                                <div class="col-md-4">
                                    <a href="{{route('dashboard')}}?idtopico={{$item->idtopico}}&cod_cso={{$item->cod_cso}}&nombre={{$item->nombre}}">
                                        <div class="divTopico">
                                            <div class="text-center">
                                                <img src="{{ URL::asset('/assets/images/dashboard/topico.svg') }}" class="img-fluid imgT">
                                            </div>
                                            <h2 id="textT">CSO - {{$item->cod_cso}}</h2>

                                            <h2 id="textT">{{$item->nombre}}</h2>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


