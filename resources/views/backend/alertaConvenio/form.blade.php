@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('alertaContrato.index') }}">Contratos</a>
        </li>
        <li class="breadcrumb-item active">Alertas</li>
    </ol>

    <form method="post" action="{{ route('alertaContrato.save', $alertas) }}" enctype="multipart/form-data" >
        {!! csrf_field() !!}
        <div class="card">
            <div class="card-body row">
                <div class="row col-12">
                    <input type="hidden" name="id" value="{{ $alertas->id }}">
                    <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('nombre') ? 'has-error' : '' }}">
                        <label>Nombre *</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $alertas->nombre ?: old('nombre') }}">
                        @if ($errors->has('nombre'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row col-12">
                    <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('alerta_vencimiento') ? 'has-error' : '' }}">
                        <label>Alerta de vencimiento *</label>
                        
                        <input type="number" name="alerta" class="form-control" value="{{ $alertas->alerta ?: old('alerta') }}">
                        @if ($errors->has('alerta'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('alerta') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row col-12">
                    <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('contrato_id') ? 'has-error' : '' }}">
                        <label>Licitación *</label>

                        <select name='contrato_id' class ='form-control selectpicker selectField' placeholder='Seleccione licitación' data-live-search='true' id ='contrato_id' >
                            <option value="{{ $alertas->contrato_id ?: old('contrato_id') }}" ></option>
                            @foreach($proveedoresData as $entityId => $entityValue)
                                @if ($entityId == $alertas->contrato_id)
                                    <option selected="true" value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @else
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('contrato_id'))
                            <span class="help-block text-danger">
                            <strong>{{ $errors->first('contrato_id') }}</strong>
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