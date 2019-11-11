@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}">Usuarios</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <form method="post" action="{{ route('users.save') }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}
    <div class="card">
        <div class="card-body row">
            <input type="hidden" name="id" value="{{ $users->id }}" >
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('nombre') ? 'has-error' : '' }}">
                <label>Nombre *</label>
                <input type="text" name="nombre" class="form-control" value="{{ $users->nombre ?: old('nombre') }}">
                @if ($errors->has('nombre'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('apellidos') ? 'has-error' : '' }}">
                <label>Apellidos *</label>
                <input type="text" name="apellidos" class="form-control" value="{{ $users->apellidos ?: old('apellidos') }}">
                @if ($errors->has('apellidos'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('apellidos') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('email') ? 'has-error' : '' }}">
                <label>E-mail *</label>
                <input type="text" name="email" class="form-control" value="{{ $users->email ?: old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('rol') ? 'has-error' : '' }}">
                <label>Rol *</label>
                <select name="rol" class="selectpicker selectField" placeholder='Seleccione rol' data-live-search='true'>
                    <option value=""></option>
                    @foreach($rolesData as $entityId => $entityValue)
                        @if ($entityValue == substr($users->getRoleNames(),2,strlen($users->getRoleNames())-4))
                            <option selected="true" value="{{ $entityId }}" >{{ $entityValue }}</option>
                        @else
                            <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('rol'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('rol') }}</strong>
                    </span>
                @endif
            </div>

            <!--***CARGO*** -->
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('cargo_id') ? 'has-error' : '' }}">
                <label>Cargo *</label>

                <select name='cargo_id' class ='selectpicker selectField' placeholder='Seleccione Cargo' data-live-search='true' id ='cargo_id'>
                    <option value="" ></option>
                    @foreach($cargosData as $entityId => $entityValue)
                        @if ($entityId == $users->cargo_id)
                            <option selected="true" value="{{ $entityId }}" >{{ $entityValue }}</option>
                        @else
                            <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('cargo_id'))
                    <span class="help-block text-danger">
                    <strong>{{ $errors->first('cargo_id') }}</strong>
                    </span>
                @endif
            </div>


            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('password') ? 'has-error' : '' }}">
                <label>Contraseña *</label>
                <input type="password" name="password" class="form-control">
                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('password') ? 'has-error' : '' }}">
                <label>Confirmar contraseña *</label>
                <input type="password" name="password2" class="form-control">
                @if ($errors->has('password2'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('password2') }}</strong>
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
<script src="/assets/frontend/js/jquery-3.3.1.js"></script>
    <script src="/assets/frontend/js/selectize.js"></script>
    <script>
        $('.selectField').selectize({
            create: false,
            sortField: {
                field: 'text',
                direction: 'asc'
            },
            dropdownParent: 'body'
        });
	</script>

@stop