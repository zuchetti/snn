     
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad.</th>
                                    <th scope="col">Dosis</th>
                                    <th scope="col">Present</th>
                                    <th scope="col">Vía de adm.</th>
                                    <th scope="col">Frec.</th>
                                    <th scope="col">Duración.</th>
                                    <th scope="col">CIE-10.</th>
                                    <th scope="col">Fuente</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($tableMedicament)>0)
                                @php
                                    $key=0;
                                    $arrayCie10 = explode(',', session('paciente')->cie10);
                                    
                                @endphp
                                @foreach(session('tableMedicament') as $index => $item)
                                    @php
                                        $key++;

                                    @endphp
                             
                                <tr>
                                    <td><input type="hidden" name="idmedicamento{{$index}}" id="idmedicamento{{$key}}" value="{{$item->idmedicamento}}"><input type="hidden" name="idbotiquinitem{{$index}}" id="idbotiquinitem{{$key}}" value="{{$index}}">{{$item->idmedicamento}}</td>
                                    <td><input type="hidden" name="cod_producto{{$index}}" id="cod_producto{{$key}}" value="{{$item->cod_producto}}"><input type="hidden" name="producto{{$index}}" id="producto{{$key}}" value="{{$item->producto}}"> {{$item->producto}}</td>
                                    <td><input type="number" value="@if(isset($item->cantidadE)){{$item->cantidadE}}@endif" id="cantidadE{{$key}}" class="form-control form-control-sm" name="cantidadE{{$index}}"  min='1' max="{{$item->cantidad}}"></td>
                                    <td><input type="text" id="dosis{{$key}}" value="@if(isset($item->dosis)){{$item->dosis}}@endif" class="form-control form-control-sm" name="dosis{{$index}}" maxlength="15"></td>
                                    <td><input type="hidden" id="presentacion{{$key}}" name="presentacion{{$index}}" id="presentacion{{$key}}" value="{{$item->presentacion}}">{{$item->presentacion}}</td>
                                    <td><input type="text"  value="@if(isset($item->via_administracion)){{$item->via_administracion}}@endif" id="via_administracion{{$key}}" class="form-control form-control-sm" name="via_administracion{{$index}}" maxlength="15"></td>
                                    <td><input type="text" value="@if(isset($item->frecuencia)){{$item->frecuencia}}@endif" id="frecuencia{{$key}}" class="form-control form-control-sm" name="frecuencia{{$index}}" maxlength="15"></td>
                                    <td><input type="text" value="@if(isset($item->duracion)){{$item->duracion}}@endif" id="duracion{{$key}}"  class="form-control form-control-sm" name="duracion{{$index}}" maxlength="15"></td>
                                    <td>
                                        <select class="form-control form-control-sm cie10_{{$index}}" id="cie10{{$key}}">
                                            <option value=""></option>
                                            @foreach($arrayCie10 as $u)
                                            <option value="{{$u}}" @if(isset($item->cie10))  selected  @endif>{{$u}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm fuente{{$index}}" id="fuente{{$key}}" name="fuente">
                                            <option value=""></option>
                                            <option value="0" @if(isset($item->fuente)) @if($item->fuente==0) selected  @endif @endif>Botica Interna</option>
                                            <option value="1" @if(isset($item->fuente)) @if($item->fuente==1) selected  @endif @endif>Botica Externa</option>
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="cantidad{{$key}}" name="cantidad{{$index}}" value="{{$item->cantidad}}">{{$item->cantidad}}</td>
                                    <td>
                                        <a class="delete" data-id="{{$index}}"><i class="fas fa-minus-circle"></i></a>
                                        <a  class="update" data-idbotiquinitem="{{$index}}" data-id="{{$index}}"><i class="fas fa-redo-alt"></i></a>
                                     
                                    </td>
                                </tr>
                                @endforeach
                            
                            @else
                                <tr>
                                    <td colspan="12" aling="center"></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        
                                                    
                        @if(count($tableMedicament)>0)

                        <div class="row">
                            <div class="col-md-12">
                                <h2 id="text77">Indicaciones</h2>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea id="indicaciones"  minlength="500" class="input  form-control form-control-sm" placeholder="Escribir aqui..." name="indicaciones" rows="5"></textarea>
                        </div>
                        
                        <input type="hidden" value="{{$key}}" id="contarMedicament">
                        <br><br>

                        <div id="alerts"></div>
                        
                        <div class="row justify-content-center">
                            <div class="col-md-4 mx-auto">
                                <button id="boton" class="btn generar">
                                    Generar receta médica  <span class="spinner-border spinner-border-sm" id="spiner3" style="display:none;"></span>
                                </button>
                            </div>

                            
                        </div>

                    @endif
                       