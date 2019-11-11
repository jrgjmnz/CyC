@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('proveedores.index') }}">proveedores</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <form method="post" action="{{ route('proveedores.save') }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}
    <div class="card">

        <div class="card-body row">
            <input type="hidden" name="id" value="{{ $proveedor->id }}" >
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('rut') ? 'has-error' : '' }}">
                <label>RUT del proveedor *</label>
                <input type="text" name="rut" class="form-control" value="{{ $proveedor->rut ?: old('rut') }}">
                @if ($errors->has('rut'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('rut') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('razon_social') ? 'has-error' : '' }}">
                <label>Razón Social del proveedor *</label>
                <input type="text" name="razon_social" class="form-control" value="{{ $proveedor->razon_social ?: old('razon_social') }}">
                @if ($errors->has('razon_social'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('razon_social') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('ubicacion') ? 'has-error' : '' }}">
                <label>Ubicación *</label>
                <input type="text" name="ubicacion" class="form-control" value="{{ $proveedor->ubicacion ?: old('ubicacion') }}">
                @if ($errors->has('ubicacion'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('ubicacion') }}</strong>
                    </span>
                @endif
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