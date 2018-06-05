@extends('layouts.template')


    @push('boton_accion')
    <a href="{{ url('/tipo-procedencia/add') }}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus"></span>
        Nueva Departamento
    </a>
    @endpush


@section('title', 'Editar Departamento')

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
                <form class="form-horizontal" method="post" action="{{ URL::asset('departamento/editar') }}">
                    {!! csrf_field() !!}

                    <input name="id_departamento" type="hidden" value="{{$id_departamento}}">


                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10"><input type="text" name="nombre" placeholder="Ejemplo: Piso 17" class="form-control" value="{{$data_departamento->nombre}}">
                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Descripción</label>

                        <div class="col-lg-10"><input type="text" name="descripcion" placeholder="Ejemplo: Piso 17" class="form-control" value="{{$data_departamento->descripcion}}">
                            @if ($errors->has('descripcion'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group"><label class="col-lg-2 control-label">Activo</label>

                        <div class="col-lg-10">
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"    class="onoffswitch-checkbox" id="activo" name="activo" value="1" {{($data_departamento->activo==1)?"checked=":'null'}}  >
                                    <label class="onoffswitch-label" for="activo">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>

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