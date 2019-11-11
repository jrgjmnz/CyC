@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('boletas.index') }}">Boletas</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <form method="post" action="{{ route('boletas.save') }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}
    <div class="card">

        <div class="card-body row">
            <div class="row col-12">
                <input type="hidden" name="id" value="{{ $boleta->id }}">
                
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('numero') ? 'has-error' : '' }}">
                    @if ($boleta->numero)
                        <h5>Numero del boleta: {{ $boleta->numero }}</h5>
                        <input type="hidden" name="numero" id='numero' value="{{ $boleta->numero}}">
                    @else
                        <label>Numero del boleta</label>
                        <input type="text" name="numero" class="form-control" value="{{ $boleta->numero ?: old('numero') }}">
                    @endif

                    @if ($errors->has('numero'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('numero') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('monto') ? 'has-error' : '' }}">
                    <label>Monto</label>
                    
                    <input type="text" name="monto" class="form-control" value="{{ $boleta->monto ?: old('monto') }}">
                    @if ($errors->has('monto'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('monto') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('fecha_vencimiento') ? 'has-error' : '' }}">
                    <label>Fecha de vencimiento</label>
                    
                    <input type="date" name="fecha_vencimiento" class="form-control" value="{{ $boleta->fecha_vencimiento ?: old('fecha_vencimiento') }}">
                    @if ($errors->has('fecha_vencimiento'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('fecha_vencimiento') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('alerta_vencimiento') ? 'has-error' : '' }}">
                    <label>Alerta de Vencimiento</label>
                    
                    <input type="number" min="0" name="alerta_vencimiento" class="form-control" value="{{ $boleta->alerta_vencimiento ?: old('alerta_vencimiento') }}">
                    @if ($errors->has('alerta_vencimiento'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('alerta_vencimiento') }}</strong>
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