@extends('layouts.app')

@section('content')
@role('Admin')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('convenios.index') }}">Convenios</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <form method="post" action="{{ route('convenios.save') }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}
    <div class="card">

        <div class="card-body row">
            <div class="row col-12">
                <input type="hidden" name="id" value="{{ $convenio->id }}" >

                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('proveedor_id') ? 'has-error' : '' }}">
                    <label>Proveedor *</label>

                    <select name='proveedor_id' class ='form-control selectpicker selectField' placeholder='Seleccione proveedor' data-live-search='true' id ='proveedor_id' >
                        <option value="" ></option>
                        @foreach($proveedoresData as $entityId => $entityValue)
                            @if ($entityId == $convenio->proveedor_id)
                                <option selected="true" value="{{ $entityId }}" >{{ $entityValue }}</option>
                            @else
                                <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('proveedor_id'))
                        <span class="help-block text-danger">
                        <strong>{{ $errors->first('proveedor_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('licitacion') ? 'has-error' : '' }}">
                    <label>Licitación *</label>
                    <input type="text" name="licitacion" class="form-control" value="{{ $convenio->licitacion ?: old('licitacion') }}">
                    @if ($errors->has('licitacion'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('licitacion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('fecha_inicio') ? 'has-error' : '' }}">
                    <label>Fecha de inicio *</label>
                    
                    <input type="date" name="fecha_inicio" class="form-control" value="{{ $convenio->fecha_inicio ?: old('fecha_inicio') }}">
                    @if ($errors->has('fecha_inicio'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('fecha_inicio') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('fecha_termino') ? 'has-error' : '' }}">
                    <label>Fecha de termino *</label>
                    
                    <input type="date" name="fecha_termino" class="form-control" value="{{ $convenio->fecha_termino ?: old('fecha_termino') }}">
                    @if ($errors->has('fecha_termino'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('fecha_termino') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('objeto_contrato') ? 'has-error' : '' }}">
                    <label>Objeto del contrato *</label>
                    
                    <input type="text" name="objeto_contrato" class="form-control" value="{{ $convenio->objeto_contrato ?: old('objeto_contrato') }}">
                    @if ($errors->has('objeto_contrato'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('objeto_contrato') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('alerta_vencimiento') ? 'has-error' : '' }}">
                    <label>Alerta de vencimiento de convenio</label>
                    
                    <input type="date" name="alerta_vencimiento" class="form-control" value="{{ $convenio->alerta_vencimiento ?: old('alerta_vencimiento') }}">
                    @if ($errors->has('alerta_vencimiento'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('alerta_vencimiento') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

                <div class="row col-12" name="Agregar">
                    <div class="row col-12">
                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('numero') ? 'has-error' : '' }}">
                            <label>N° de boleta *</label>
                            <input type="text" name="numero" class="form-control" value="{{ $convenio->boletas ? $convenio->boletas->numero : old('numero') }}">
                            @if ($errors->has('numero'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('numero') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('monto') ? 'has-error' : '' }}">
                            <label>Monto *</label>
                            <input type="number" name="monto" class="form-control" value="{{ $convenio->boletas ? $convenio->boletas->monto : old('monto') }}">
                            @if ($errors->has('monto'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('monto') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('fecha_vencimiento') ? 'has-error' : '' }}">
                            <label>Fecha de vencimiento de boleta *</label>
                            
                            <input type="date" name="fecha_vencimiento" class="form-control" value="{{ $convenio->boletas ? $convenio->boletas->fecha_vencimiento : old('fecha_vencimiento') }}">
                            @if ($errors->has('fecha_vencimiento'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('fecha_vencimiento') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('alerta_boleta') ? 'has-error' : '' }}">
                            <label>Alerta de vencimiento de boleta</label>
                            
                            <input type="date" name="alerta_boleta" class="form-control" value="{{ $convenio->boletas ? $convenio->boletas->fecha_alerta : old('alerta_boleta') }}">
                            @if ($errors->has('alerta_boleta'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('alerta_boleta') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="boleta_id" class="form-control" value="{{ $convenio->boleta_id }}">
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