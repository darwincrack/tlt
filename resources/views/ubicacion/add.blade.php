@extends('layouts.template')

@push('boton_accion')
<a href="{{ url('/ubicacion/add') }}" class="btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span>
        Nuevo Ubicación
</a>
@endpush

@section('title', 'Agregar Ubicación')

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
                <form class="form-horizontal" method="post" action="{{ URL::asset('ubicacion/add') }}">
                    {!! csrf_field() !!}



                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Nombre</label>

                        <div class="col-lg-10"><input type="text" name="nombre" placeholder="Ejemplo: Piso 17" class="form-control" value="{{ old('nombre') }}">
                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}"><label class="col-lg-2 control-label">Descripción</label>

                        <div class="col-lg-10"><input type="text" name="descripcion" placeholder="" class="form-control" value="{{ old('descripcion') }}">
                            @if ($errors->has('descripcion'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
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


