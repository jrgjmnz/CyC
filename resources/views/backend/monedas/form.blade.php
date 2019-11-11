@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('monedas.index') }}">Monedas</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>
    
    <form method="post" action="{{ route('monedas.save') }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}
    <div class="card">

        <div class="card-body row">
            <div class="row col-12">
                <input type="hidden" name="id" value="{{ $moneda->id }}" >
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 offset-pd-4 {{ $errors->has('codigo') ? 'has-error' : '' }}">
                    <label>Código de la moneda *</label>
                    <input type="text" name="codigo" class="form-control" value="{{ $moneda->codigo ?: old('codigo') }}">
                    @if ($errors->has('codigo'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('codigo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('nombre') ? 'has-error' : '' }}">
                    <label>Nombre de la moneda *</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $moneda->nombre ?: old('nombre') }}">
                    @if ($errors->has('nombre'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('factor_conversion') ? 'has-error' : '' }}">
                    <label>Factor conversión de la moneda *</label>
                    <input type="text" name="factor_conversion" class="form-control" value="{{ $moneda->factor_conversion ?: old('factor_conversion') }}">
                    @if ($errors->has('factor_conversion'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('factor_conversion') }}</strong>
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