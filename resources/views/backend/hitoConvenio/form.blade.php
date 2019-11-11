@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Hitos</a>
        </li>
        <li class="breadcrumb-item active">Alerta Convenios</li>
    </ol>

    <form method="post" action="{{ route('hitoConvenio.save',$convenio) }}" enctype="multipart/form-data" >
        {!! csrf_field() !!}
        <div class="card">
            <div class="card-body row">
                <div class="row col-12">
                    <input type="hidden" name="id" value="{{ $hitos->id }}">
                    <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('nombre') ? 'has-error' : '' }}">
                        <label>Nombre *</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $hitos->nombre ?: old('nombre') }}">
                        @if ($errors->has('nombre'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row col-12">
                    <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('fecha_alerta') ? 'has-error' : '' }}">
                        <label>Fecha de alerta *</label>         
                        <input type="date" name="fecha_alerta" class="form-control" value="{{ $hitos->fecha_alerta ?: old('fecha_alerta') }}">
                        @if ($errors->has('fecha_alerta'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('fecha_alerta') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row col-12">
                    <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('fecha_hito') ? 'has-error' : '' }}">
                        <label>Fecha del Hito *</label>
                        <input type="date" name="fecha_hito" class="form-control" value="{{ $hitos->fecha_hito ?: old('fecha_hito') }}">
                        @if ($errors->has('fecha_hito'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('fecha_hito') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-8">
                    <button type="submit" class="btn-primary btn rounded" ><i class="icon-floppy-disk"></i> Guardar</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endrole
@stop