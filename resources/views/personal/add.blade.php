@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/personal/add') }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
    Nuevo Personal
</a>
@endpush

@push('css')

<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/datapicker/datepicker3.css') }}">
@endpush

@section('title', 'Agregar Personal')

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
                <form class="form-horizontal" method="post" action="{{ URL::asset('personal/add') }}">
                    {!! csrf_field() !!}














                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10"><input type="text" name="nombre" placeholder="Ejemplo: Jhon Doe" class="form-control" value="{{ old('nombre') }}"> @if ($errors->has('nombre'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('nro_empleado') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nro empleado</label>

                        <div class="col-lg-10"><input type="text" name="nro_empleado" placeholder="Ejemplo: 225" class="form-control" value="{{ old('nro_empleado') }}"> @if ($errors->has('nro_empleado'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nro_empleado') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group"><label class="col-sm-2 control-label">cargo</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="cargo">
                                @foreach($data_cargos as $data_cargo)
                                    <option value="{{$data_cargo->id}}">{{$data_cargo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="departamento">
                                @foreach($data_departamentos as $data_departamento)
                                    <option value="{{$data_departamento->id}}">{{$data_departamento->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group"><label class="col-sm-2 control-label">Ubicación</label>

                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="ubicacion" id="ubicacion" data-rec="">
                        

                            @foreach($data_ubicaciones as $data_ubicacion)
                                    <option value="{{$data_ubicacion->id}}">{{$data_ubicacion->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>












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

