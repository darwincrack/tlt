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

@section('title', 'Editar Personal' )

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
                <form class="form-horizontal" method="post" action="{{ URL::asset('personal/editar') }}">
                    {!! csrf_field() !!}


                    <input name="id_personal" type="hidden" value="{{$id_personal}}">
                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10"><input type="text" name="nombre" placeholder="Ejemplo: Router" class="form-control" value="{{ $data_personal->nombre }}"> @if ($errors->has('nombre'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('nro_empleado') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">nro_empleado</label>

                        <div class="col-lg-10"><input type="text" name="nro_empleado" placeholder="Ejemplo: 3338421" class="form-control" value="{{ $data_personal->nro_empleado }}"> @if ($errors->has('nro_empleado'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nro_empleado') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Cargo</label>
                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="cargo" id="cargo" >
                                @foreach($data_cargos as $data_cargo)

                                    <option value="{{$data_cargo->id}}"  {{($data_cargo->id==$data_personal->id_cargo)?"selected":""}}>
                                        {{$data_cargo->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Departamento</label>
                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="departamento" id="departamento" >
                                 @foreach($data_departamentos as $data_departamento)
                                    <option value="{{$data_departamento->id}}"  {{($data_departamento->id==$data_personal->id_departamento)?"selected":""}}>
                                        {{$data_departamento->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                <div class="form-group"><label class="col-sm-2 control-label">Ubicación</label>
                        <div class="col-sm-10">
                            <select class="form-control" class="form-control m-b" name="ubicacion" id="ubicacion" >
                                    @foreach($data_ubicaciones as $data_ubicacion)
                                    <option value="{{$data_ubicacion->id}}"  {{($data_ubicacion->id==$data_personal->id_ubicacion)?"selected":""}}>
                                        {{$data_ubicacion->nombre}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>
                </div>

<br>
    <div class="col-lg-12"><h3>Foto</h3><hr></div>
    <div class="form-group">
        <div class="col-sm-2 "></div>
        <div class="col-sm-4 ">

            <div id="my_camera" style="width:320px; height:240px;"></div>
            <br>


            <div id="pre_take_buttons">
                    <input type=button class="btn btn-danger" value="Nueva Foto" onClick="preview_snapshot()">
            </div>

            <div id="post_take_buttons" style="display:none">
                <input type=button class="btn" value="&lt; Hacer Otra" onClick="cancel_preview()">
                <input type=button class="btn btn-primary" value="Guardar Foto &gt;" onClick="save_photo()" style="font-weight:bold;">
            </div>
        </div>

        <div class="col-sm-1 "></div>
        <div class="col-sm-4 ">
        <div id="results">
            @if ($data_personal->picture=="")
                <span class="text-center">No tiene foto </span>
            @else
                <img src="{{ URL::asset('assets/img/personal/') }}/{{$data_personal->picture}}"
                <span class="text-center">Tu foto Actual</span>

            @endif 
        </div>
    </div>
</div>




    <input type="hidden" id="namafoto"  name="namafoto" value="">




                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-5">
                            <button class="btn btn-block btn-primary" type="submit" title="Enviar datos para guardar">Guardar</button>

                        </div>
                    </div>
                    <input type="hidden" name="fotoactual" value="{{$data_personal->picture}}" >
                </form>
            </div>
        </div>

@stop

@push('scripts')
{{--rutas js y script--}}

<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.es.js') }}"></script>

<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins/webcamjs/webcam.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/camara.js') }}"></script>





@endpush

