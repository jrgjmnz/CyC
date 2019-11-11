@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Contactos</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <form method="post" action="{{ route('contactos.save', $proveedor) }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}
    <div class="card">

        <div class="card-body row">
            <div class="row col-12">
                <input type="hidden" name="id" value="{{ $contacto->id }}" >
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('nombre') ? 'has-error' : '' }}">
                    <label>Nombre *</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $contacto->nombre ?: old('nombre') }}">
                    @if ($errors->has('nombre'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('telefono') ? 'has-error' : '' }}">
                    <label>Teléfono *</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $contacto->telefono ?: old('telefono') }}">
                    @if ($errors->has('telefono'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label>E-mail *</label>
                    <input type="text" name="email" class="form-control" value="{{ $contacto->email ?: old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('direccion_postal') ? 'has-error' : '' }}">
                    <label>Dirección postal *</label>
                    <input type="text" name="direccion_postal" class="form-control" value="{{ $contacto->direccion_postal ?: old('direccion_postal') }}">
                    @if ($errors->has('direccion_postal'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('direccion_postal') }}</strong>
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