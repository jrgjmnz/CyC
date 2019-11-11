@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('ordenCompra.index') }}">Orden de Compra</a>
        </li>
        <!-- <li class="breadcrumb-item active">Mantenedor</li> -->
    </ol>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="post" class="form-horizontal" action="{{ route('ordenCompra.save') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                        <div class="container">
                                <div class="row col-12">
                                    <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('numeroLicitacion') ? 'has-error' : ''}}">
                                        <label> ID Contrato *</label>
                                        <select class="selectpicker selectField" placeholder='Ingrese Número de Contrato' name="numeroLicitacion" id="numeroLicitacion" >                                        
                                        
                                            @foreach($contratos as $entityId => $entityValue)
                                            @if ($entityId == $ordenCompraData->contrato_id)
                                                <option selected="true" value="{{ $entityId }}" >{{ $entityValue }}</option>
                                            @else
                                                <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                            @endif
                                        @endforeach                                 
                                        </select>                                       
                                        
                                    </div>
                                </div>
                        </div>                        

                        <div class="container">
                            <div class="row col 12">
                                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg4 {{ $errors->has('numeroOrdenCompra') ? 'has-error' : ''}}">
                                    <label>Número Orden de Compra * </label>
    
                                    <input type="text" name="numeroOrdenCompra"  class="form-control" value="{{ $ordenCompraData->numeroOrdenCompra ?: old('numeroOrdenCompra') }}">
                                    @if ($errors->has('numeroOrdenCompra'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('numeroOrdenCompra')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        

                        <div class="container">
                                <div class="row col 12">
                                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg4 {{ $errors->has('fecha_envio') ? 'has-error' : ''}}">
                                            <label>Fecha de Envío * </label>
            
                                            <input type="date" name="fecha_envio" class="form-control" value="{{ $ordenCompraData->fecha_envio ?: old('fecha_envio') }}">
                                            @if ($errors->has('fecha_envio'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('fecha_envio') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                        </div>    
                        
                    
                        <div class="container">
                                <div class="row col-12">
                                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('total') ? 'has-error' : ''}}">
                                            <label>Total *</label>
            
                                            <input type="text" name="total" class="form-control" value="{{ $ordenCompraData->total}}">
                                            
                                            @if (session('total'))
                                                <div class="help-block text-danger">
                                                    {{ session('total') }}
                                                </div>
                                            @endif
                                            
                                            @if ($errors->has('total'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('total') }}</strong>
                                                </span>                        
                                            @endif
                                        </div>
                                    </div>
                        </div>    
                        
                        <div class="container">
                                <div class="row col-12">
                                        <div class="form-group has-feedback col-xsñ-4 col-md-4 col-lg-4 {{ $errors->has('estado') ? 'has-error' : ''}}">
                                            <label>Estado *</label>
                                            <select class="selectpicker selectField" placeholder='Seleccione Estado' name="estado" id="estado">
                                                <option value="Pendiente">Pendiente</option>
                                                <option value="Recepción Conforme">Recepción Conforme</option>               
                                            </select>
                                            @if ($errors->has('estado'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('estado')}}</strong>
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
                </div>
            </form>
        </div>
    </div>            
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
    
    <!-- 
    <script>
        document.getElementById("numeroLicitacion").addEventListener("change", myFunction);
        
        function myFunction() {
            var y = document.getElementById("rutProveedor").value = 'chao';

        }
        </script> 
    -->
@stop