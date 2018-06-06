@extends('layouts.template')


    @push('boton_accion')
    <a href="{{ url('/tiposjustificacion/add') }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span>
               Nuevo tipo de Justificaci&oacute;n

    </a>
    @endpush


@section('title', 'Editar Tipo de Justificaci&oacute;n')

@section('content')



    <div class="col-lg-12">


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
                <form class="form-horizontal" method="post" action="{{ URL::asset('tiposjustificacion/editar') }}">
                    {!! csrf_field() !!}

                    <input name="id_justificacion" type="hidden" value="{{$id_justificacion}}">


                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10"><input type="text" name="nombre" placeholder="Ejemplo: Cita Medica" class="form-control" value="{{$data_justificaciones->Classname}}">
                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                            @endif
                        </div>
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
    </div>
@stop