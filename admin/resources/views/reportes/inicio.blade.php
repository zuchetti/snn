@extends('layout.app')
@push('css')
<link href="{{ URL::asset('/assets/css/sanna/gestiondebasededatos.css')}}" rel="stylesheet">

@endpush
@section('content')
    @php
        $page ='reportes';
    @endphp

        {{ csrf_field() }}    

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <div class="kt-portlet kt-portlet--mobile">

                <!--------head---------->
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        
                        <h3 class="kt-portlet__head-title" >
                        Reportes
                        </h3>
                    </div>
                </div>
                         
                                               
                <div class="kt-portlet__body">
                    <?php
                    $meses = array('01'=>'Enero','02' =>'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
                   '07' => 'Julio', '08' => 'Agosto', '09'=> 'Septiembre', 10=> 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="kt-form__group kt-form__group">
                                <label>Seleccione el mes</label>
                                <select class="form-control" name="mes" required id="mes">
                                    <option value=""></option>
                                    @foreach($meses as $key => $m)
                                    <option value="{{$key}}" @if($key==date("m")) selected @endif>{{$m}}</option>
                                    @endforeach
    
                                </select>   
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="kt-form__group kt-form__group">
                                <label>Ingrese el año</label>
                                <input type="text" name="anio" required id="anio" value="<?php echo date("Y") ?>"  maxlength=4 class="form-control form-control-sm campo numbers">
                            </div>
                        </div>

                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group">
                                <div class="kt-form__label">
                                        <label>Fecha Inicio:</label>
                                </div>
                                <div class="kt-form__control">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" placeholder="Select date" id="kt_datetimepicker_ini" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar glyphicon-th"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>                                      
                            </div>
                        </div>

                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group">
                                <div class="kt-form__label">
                                    <label>Fecha Fin:</label>
                                </div>
                                <div class="kt-form__control">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" placeholder="Select date" id="kt_datetimepicker_fin" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                 <i class="la la-calendar glyphicon-th"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>                                      
                            </div>
                        </div>      

                    </div>
                    <br><br>

                   {{--  <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">

                        <div class="row align-items-center justify-content-center">

                            <div class="col-xl-4 order-2 order-xl-1">

                                <div class="row align-items-center justify-content-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group">
                                            <div class="kt-form__label">
                                                    <label>Fecha Inicio:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" placeholder="Select date" id="kt_datetimepicker_ini" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar glyphicon-th"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group">
                                            <div class="kt-form__label">
                                                <label>Fecha Fin:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" placeholder="Select date" id="kt_datetimepicker_fin" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                             <i class="la la-calendar glyphicon-th"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>                                                          
                                </div>

                                                     



                            </div>
                        </div>                      
                    </div> --}}
                </div>
                
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-datatable" id="ajax_data"></div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center" id="paginas">
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" id="petxpag">
                              <option value="10">10</option>
                              <option value="20">20</option>
                              <option value="30">30</option>
                              <option value="40">40</option>
                              <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>

<script src="{{ asset('assets/js/sanna/reportes/reportes.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>

@endpush
