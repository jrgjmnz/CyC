@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('licitaciones.index') }}">Licitaciones</a>
        </li>
        <!-- <li class="breadcrumb-item active">Mantenedor</li> -->
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <form method="post" class="form-horizontal" action="{{ route('licitaciones.save') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="container">
                    <div class="row col-12">
                        <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('nro_licitacion') ? 'has-error' : '' }}">
                            <label>ID Licitación</label>
                            <input type="text" name="nro_licitacion" class="form-control" value="{{ $licitacionData->nro_licitacion ?: '' }}">
                            @if ($errors->has('nro_licitacion'))
                                <span class="help-block text-danger"> 
                                    <strong>{{ $errors->first('nro_licitacion')}}</strong>
                                </span>
                            @endif
                            <br>    
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

@stop    

