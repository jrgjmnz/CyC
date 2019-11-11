@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('contratos.index') }}">Contratos</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <form method="post" action="{{ route('contratos.save') }}" >
    {!! csrf_field() !!}
    <div class="card">

        <div class="card-body row">
            <div class="row col-12">
                <input type="hidden" name="id" value="{{ $contrato->id }}" >

                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('proveedor_id') ? 'has-error' : '' }}">
                    <label>Proveedor *</label>

                    <select class="selectpicker selectField" name='proveedor_id'  class ='form-control selectpicker selectField' placeholder='Seleccione Proveedor' data-live-search='true' id ='proveedor_id' >
                        <option value="" ></option>
                        @foreach($proveedoresData as $entityId => $entityValue)
                            @if ($entityId == $contrato->proveedor_id)
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
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4">   
                    <label>Tipo Contrato</label>   
                    <select class="form-group has-feedback col-xsñ-4 col-md-4 col-lg-4" id="selectContrato" name='selectContrato'>
                        <option value="0">Licitación</option>
                        <option value="1">Trato Directo</option>
                    </select>
                    @if ($errors->has('selectContrato'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('selectContrato') }}</strong>
                        </span>
                    @endif

                </div>    
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('cargo_id') ? 'has-error' : '' }}" id="licitacion" >
                    <label>Licitacion *</label>
                    <select name='licitacion' class ='selectpicker selectField' placeholder='Seleccione Licitacion' data-live-search='true' id ='licitacion_id'>
                        <option value="" ></option>
                        @foreach($licitacionData as $entityId => $entityValue)
                            @if ($entityId == $contrato->licitacion_id)
                                <option selected="true" value="{{ $entityId }}" >{{ $entityValue }}</option>
                            @else
                                <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('cargo_id'))
                        <span class="help-block text-danger">
                        <strong>{{ $errors->first('licitacion_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>            
  


            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('moneda_id') ? 'has-error' : '' }}" >
                    <label>Moneda *</label>

                    <select name='moneda_id' class ='selectpicker selectField' placeholder='Seleccione Moneda' data-live-search='true' id ='moneda_id' >
                        <option value="" ></option>
                        @foreach($monedasData as $entityId => $entityValue)
                            @if ($entityId == $contrato->moneda_id)
                                <option selected="true" value="{{ $entityId }}" >{{ $entityValue }}</option>
                            @else
                                <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('moneda_id'))
                        <span class="help-block text-danger">
                        <strong>{{ $errors->first('moneda_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('precio') ? 'has-error' : '' }}">
                    <label>Precio *</label>
                    <input type="text" name="precio" class="form-control" value="{{ $contrato->precio ?: old('precio') }}" >
                    @if ($errors->has('precio'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('precio') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('cargo_id') ? 'has-error' : '' }}">
                    <label>Cargo *</label>

                    <select name='cargo_id' class ='selectpicker selectField' placeholder='Seleccione Cargo' data-live-search='true' id ='cargo_id'>
                        <option value="" ></option>
                        @foreach($cargosData as $entityId => $entityValue)
                            @if ($entityId == $contrato->cargo_id)
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
            </div>

                       
            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('fecha_inicio') ? 'has-error' : '' }}">
                    <label>Fecha de inicio *</label>
                    
                    <input type="date" name="fecha_inicio" class="form-control" value="{{ $contrato->fecha_inicio ?: old('fecha_inicio') }}">
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
                    
                    <input type="date" name="fecha_termino" class="form-control" value="{{ $contrato->fecha_termino ?: old('fecha_termino') }}">
                    @if ($errors->has('fecha_termino'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('fecha_termino') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('fecha_aprobacion') ? 'has-error' : '' }}">
                    <label>Fecha de aprobación *</label>
                    
                    <input type="date" name="fecha_aprobacion" class="form-control" value="{{ $contrato->fecha_aprobacion ?: old('fecha_aprobacion') }}">
                    @if ($errors->has('fecha_aprobacion'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('fecha_aprobacion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('alerta_vencimiento') ? 'has-error' : '' }}">
                    <label>Alerta de vencimiento</label>
                    
                    <input type="date" name="alerta_vencimiento" class="form-control" value="{{ $contrato->alerta_vencimiento ?: old('alerta_vencimiento') }}">
                    @if ($errors->has('alerta_vencimiento'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('alerta_vencimiento') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="row col-12">
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('objeto_contrato') ? 'has-error' : '' }}">
                    <label>Objeto del contrato *</label>
                    
                    <input type="text" name="objeto_contrato" class="form-control" value="{{ $contrato->objeto_contrato ?: old('objeto_contrato') }}" >
                    @if ($errors->has('objeto_contrato'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('objeto_contrato') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
                <div class="row col-12" name="Agregar">
                    <div class="row col-12">
                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('numero') ? 'has-error' : '' }}">
                            <label>N° de boleta *</label>
                            <input type="text" name="numero" class="form-control" value="{{ $contrato->boletas ? $contrato->boletas->numero : old('numero') }}" >
                            @if ($errors->has('numero'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('numero') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('monto') ? 'has-error' : '' }}">
                            <label>Monto *</label> <!--Sección que guarda el monto del contrato   -->
                            <input type="number" name="monto" class="form-control" value="{{ $contrato->boletas ? $contrato->boletas->monto : old('monto') }}">
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
                            
                            <input type="date" name="fecha_vencimiento" class="form-control" value="{{ $contrato->boletas ? $contrato->boletas->fecha_vencimiento : old('fecha_vencimiento') }}">
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
                            
                            <input type="date" name="alerta_boleta" class="form-control" value="{{ $contrato->boletas ? $contrato->boletas->fecha_alerta : old('alerta_boleta') }}">
                            @if ($errors->has('alerta_boleta'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('alerta_boleta') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <input type="hidden" name="boleta_id" class="form-control" value="{{ $contrato->boleta_id }}">

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
<script src="/assets/frontend/js/jquery-3.3.1.js">
</script>


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

<script>
    $(function() {
    $('#licitacion').show(); 
    $('#selectContrato').change(function(){
        if($('#selectContrato').val() == '0') {
            $('#licitacion').show(); 
        } else {
            $('#licitacion').hide(); 
        } 
    });
});
</script> 



@stop