@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/articulos/add') }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Nuevo Artículo
</a>
@endpush

@push('css')

<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/datapicker/datepicker3.css') }}">
@endpush

@section('title', 'editar  Artículo ' )

@section('content')





    {{--    @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif--}}


        <div class="ibox float-e-margins animated fadeInDown">

            <div class="ibox-content">
                <form class="form-horizontal" method="post" action="{{ URL::asset('articulos/add') }}">
                    {!! csrf_field() !!}







                    <div class="form-group"><label class="col-sm-2 control-label">Ubicación</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="ubicacion" id="ubicacion">
                        

                            @foreach($data_ubicaciones as $data_ubicacion)
                                    <option value="{{$data_ubicacion->id}}">{{$data_ubicacion->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


    <div class="form-group"><label class="col-sm-2 control-label">Estado del Artículo</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="estados" id="estados">
                        

                            @foreach($data_estados as $data_estado)
                                    <option value="{{$data_estado->id}}">{{$data_estado->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>




                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10"><input type="text" name="nombre" placeholder="Ejemplo: Router" class="form-control" value="{{ old('nombre') }}"> @if ($errors->has('nombre'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('modelo') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">modelo</label>

                        <div class="col-lg-10"><input type="text" name="modelo" placeholder="Ejemplo: X98" class="form-control" value="{{ old('modelo') }}"> @if ($errors->has('modelo'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('modelo') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('serial') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">serial</label>

                        <div class="col-lg-10"><input type="text" name="serial" placeholder="Ejemplo: ZJ59EWYZA12" class="form-control" value="{{ old('serial') }}"> @if ($errors->has('serial'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('serial') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group{{ $errors->has('marca') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">marca</label>

                        <div class="col-lg-10"><input type="text" name="marca" placeholder="Ejemplo: HP" class="form-control" value="{{ old('marca') }}"> @if ($errors->has('marca'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('marca') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('codigo_barra') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Código de Barra</label>

                        <div class="col-lg-10"><input type="text" name="codigo_barra" placeholder="Ejemplo: 445822214782" class="form-control" value="{{ old('codigo_barra') }}"> @if ($errors->has('codigo_barra'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('codigo_barra') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Descripción</label>

                        <div class="col-lg-10"><input type="text" name="descripcion" placeholder="" class="form-control" value="{{ old('descripcion') }}"> @if ($errors->has('descripcion'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('observacion') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Observación</label>

                        <div class="col-lg-10"><input type="text" name="observacion" placeholder="" class="form-control" value="{{ old('observacion') }}"> @if ($errors->has('observacion'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('observacion') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


    @role(['admin']) 


                    <div class="form-group{{ $errors->has('costo_bs') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Costo Bs</label>

                        <div class="col-lg-10"><input type="text" name="costo_bs" placeholder="Ejemplo: 1500" class="form-control" value="{{ old('costo_bs') }}"> @if ($errors->has('costo_bs'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('costo_bs') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('costo_dolar') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Costo $</label>

                        <div class="col-lg-10"><input type="text" name="costo_dolar" placeholder="Ejemplo: 1500" class="form-control" value="{{ old('costo_dolar') }}"> @if ($errors->has('costo_dolar'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('costo_dolar') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('inicio_asignacion') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Fecha de Adquisición</label>

                        <div class="col-lg-10">
                            <div  id="data_1">

                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="fecha_adquisicion" id="fecha_adquisicion" class="form-control" value="{{ old('fecha_adquisicion') }}">
                                    @if ($errors->has('fecha_adquisicion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fecha_adquisicion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>








                    <div class="form-group"><label class="col-lg-2 control-label">Calidad de prestamo?</label>

                        <div class="col-lg-10">
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"    class="onoffswitch-checkbox" id="calidad_prestamo" name="calidad_prestamo" value="1"  >
                                    <label class="onoffswitch-label" for="calidad_prestamo">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="form-group"><label class="col-lg-2 control-label">Donado?</label>

                        <div class="col-lg-10">
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"    class="onoffswitch-checkbox" id="donado" name="donado" value="1"  >
                                    <label class="onoffswitch-label" for="donado">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>









 



                    <div class="form-group{{ $errors->has('nro_factura') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nro de factura </label>

                        <div class="col-lg-10"><input type="text" name="nro_factura" placeholder="" class="form-control" value="{{ old('nro_factura') }}"> @if ($errors->has('nro_factura'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nro_factura') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group{{ $errors->has('costo_actual_bs') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Costo Actual Bs </label>

                        <div class="col-lg-10"><input type="text" name="costo_actual_bs" placeholder="" class="form-control" value="{{ old('costo_actual_bs') }}"> @if ($errors->has('costo_actual_bs'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('costo_actual_bs') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>




                    <div class="form-group{{ $errors->has('costo_actual_dolar') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Costo Actual $ </label>

                        <div class="col-lg-10"><input type="text" name="costo_actual_dolar" placeholder="" class="form-control" value="{{ old('costo_actual_dolar') }}"> @if ($errors->has('costo_actual_dolar'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('costo_actual_dolar') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



 @endrole


































                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-5">
                            <button class="btn btn-block btn-primary" type="submit" title="Enviar datos para guardar">Guardar</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

@stop

@push('scripts')
{{--rutas js y script--}}

<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.es.js') }}"></script>

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endpush

