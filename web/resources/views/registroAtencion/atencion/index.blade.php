@extends('layout.app')

@section('content')
    @php
        $page ='finalizar';
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-10 mx-auto">
            <div class="divPrin">

                <div class="row justify-content-center">
                    <div class="col-md-10 mx-auto">
                        <div class="row">
                            <div class="col-md-10 mx-auto text-center">

                                @if(session('finalizar')==null and session('filiacion')!=null and session('diagnostico')!=null)
                                    <h1 class="title">Finalizar atención</h1>

                                    <div class="alert alert-warning" role="alert">
                                        <i class="fas fa-info-circle"></i>Antes de finalizar la atención debe verificar que los datos ingresados sean correctos, ya que una vez finalizada no podrá modificarla.
                                    </div>
                                    @if(session('modalidad')==1)
                                    <div class="form-group col-md-12 my-2 py-3">
                                        <label for="" class="mb-3 fw-bold">Firmar aquí</label>
                                        <div class="bg-light py-3 d-flex w-100">
                                            <button onclick="firmarOpen()"
                                                class="w-75 py-2 px-3 small border-0 sin-focus bg-transparent text-left  text-secondary">Presiona
                                                aquí para firmar</button>
                                            <button onclick="firmarOpen()" style="color:#33b3a9"
                                                class="w-25 sin-focus py-2 font-weight-bold d-none edit-firma px-3 border-0 bg-transparent text-center ">Editar
                                                firma</button>

                                        </div>
                                    </div>
                                    @endif

                                    <div class="row justify-content-center">
                                        <div  class="col-md-6 mx-auto">
                                            <button  id="boton" {{(session('modalidad')==0)?'':'disabled'}}  class="btn generar">
                                                FINALIZAR <span class="spinner-border spinner-border-sm" style="display:none;"></span>
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                @if(session('filiacion')==null or session('diagnostico')==null)

                                    <div class="alert alert-info" role="alert">
                                        <i class="fas fa-info-circle"> </i> Guardar la hoja de filiación y la hoja de registro de atención
                                    </div>
                                @endif

                                @if(session('finalizar')==2 and (session('filiacion')!=null or session('diagnostico')!=null or
                                 session('receta')!=null or session('descanso')!=null))
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fas fa-info-circle"> </i> Ocurrió un error
                                    </div>
                                @else
                                    @if(session('finalizar')==1 and (session('filiacion')!=null or session('diagnostico')!=null or session('receta')!=null or session('descanso')!=null))

                                        <h1 class="title">Formatos generados</h1>

                                        @if(session('filiacion')!=null)
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 mx-auto">
                                                <a href="{{url('filiacion')}}" id="boton2" class="btn">
                                                    FORMATO DE FILIACIÓN
                                                </a>
                                            </div>
                                        </div>
                                        @endif

                                        @if(session('diagnostico')!=null)
                                        <div class="row justify-content-center">
                                            <div class="col-md-8 mx-auto">
                                                <a href="{{url('atencion')}}" id="boton2" class="btn">
                                                    FORMATO DE REGISTRO DE LA ATENCIÓN
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    
                                        @if(session('receta')!=null)
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 mx-auto">
                                                <a href="{{url('receta')}}" id="boton2" class="btn">
                                                    RECETA MÉDICA
                                                </a>
                                            </div>
                                        </div>
                                        @endif

                                        @if(session('examenes')!=null)
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 mx-auto">
                                                <a href="{{url('examenes')}}" id="boton2" class="btn">
                                                EXAMENES AUXILIARES
                                                </a>
                                            </div>
                                        </div>
                                        @endif

                                        @if(session('descanso')!=null)

                                        <div class="row justify-content-center">
                                            <div class="col-md-6 mx-auto">
                                                <a href="{{url('descanso')}}"  id="boton2" class="btn">
                                                    DESCANSO MÉDICO
                                                </a>
                                            </div>
                                        </div>
                                        @endif

                                    @endif
                                @endif


                       

                                

                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="ModalFirma">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Firma aquí</h5>

                </div>
                <div class="modal-body">
                    <div class="col-md-12 text-center" id="mostrarImg" style="">
                        <img id="theimage" style="display:none;">

                    </div>


                    <div class="col-md-12 text-center" id="divCanvas" style="">

                        <canvas id="canvas">Su navegador no soporta canvas : </canvas>
                        <br>
                        <div id='resultado4'></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="limpiar">Limpiar</button>
                    <button type="button" onclick="cerrarModal()" class="btn  btn-primary">Guardar Firma</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modalCarga" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body py-4 text-center fw-bold" id="modalCuerpo">

                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
<script src="{{ asset('assets/js/loader/loadingoverlay.min.js') }}" type="text/javascript"></script>
<script>
    $("#boton").on('click', function(e){
        location.href="registrar_attention";
        $('#boton').prop('disabled', true);  
    }) 
</script>
<script src="{{ URL::asset('/assets/js/registroAtencion/firma.js') }}?ver=6.4"></script>
@endpush