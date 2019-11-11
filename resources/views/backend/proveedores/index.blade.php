@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('proveedores.index') }}">Proveedores</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('proveedores.index') }}">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-3">
                        <label>Filtrar por RUT</label>
                        <div>
                            <select name="rut" class="selectpicker selectField" placeholder='Seleccione RUT' data-live-search='true'>
                                <option value=""></option>
                                @foreach($rutData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Filtrar por razón social</label>
                        <div>
                            <select name="razon_social" class="selectpicker selectField" placeholder='Seleccione razón social' data-live-search='true'>
                                <option value=""></option>
                                @foreach($nombresData as $entityId => $entityValue)
                                    <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Filtrar por ubicación</label>
                        <div>
                            <select name="ubicacion" class="selectpicker selectField" placeholder='Seleccione ubicación' data-live-search='true'>
                                <option value=""></option>
                                @foreach($ubicacionesData as $entityId => $entityValue)
                                    <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('proveedores.new') }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>

                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('proveedores.index') }}">Limpiar Filtros</a>
                        <button type="submit" class="btn btn-primary rounded"><i class="fa fa-search"></i> Buscar</button>
                    @else
                        <button type="submit" class="btn btn-primary rounded"><i class="fa fa-search"></i> Buscar</button>
                    @endif
                </div>

                <div>
                    <i class="fas fa-table"> Registros</i>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Rut</th>
                            <th>Razón social</th>
                            <th>Ubicación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($proveedoresData as $proveedoresItem)
                            <tr>
                                <td> {{ $proveedoresItem->rut }}</td>
                                <td> {{ $proveedoresItem->razon_social }}</td>
                                <td> {{ $proveedoresItem->ubicacion }}</td>
                                <td>
                                    @if(!$proveedoresItem->deleted_at)
                                        <a href="{{ route('proveedores.form', $proveedoresItem->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                                        <a href="{{ route('contactos.index', $proveedoresItem->id) }}" class="btn btn-primary rounded btn-xs"><i class="fa fa-address-book"></i> Contactos</a>
                                        <a href="#" class="btn btn-danger btn-xs" data-target="#deleteModal{{ $proveedoresItem->id }}" data-toggle="modal"><i class="far fa-trash-alt"></i> Eliminar</a>

                                        <!-- modal starts -->
                                        <div class="modal fade" id="deleteModal{{ $proveedoresItem->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('proveedores.delete', $proveedoresItem->id) }}" >
                                                    {!! csrf_field() !!}
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> Borrar {{ $proveedoresItem->nombre }} </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-default">Continuar</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> 
                                        <!-- modal ends -->
                                    @else
                                        <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $proveedoresItem->id }}" data-toggle="modal"><i class="fas fa-arrow-circle-up"></i> Restaurar</a>

                                        <!-- modal starts -->
                                        <div class="modal fade" id="restoreModal{{ $proveedoresItem->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('proveedores.restore', $proveedoresItem->id) }}" >
                                                    {!! csrf_field() !!}

                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> Restaurar  {{ $proveedoresItem->nombre }} </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                        
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">{{ trans('Restaurar') }}</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> 
                                        <!-- modal ends -->

                                        <!-- modal starts -->
                                        <div class="modal fade" id="forceDeleteModal{{ $proveedoresItem->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('proveedores.force-delete', $proveedoresItem->id) }}" >
                                                        {!! csrf_field() !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"> Borrar permanentemente {{ $proveedoresItem->nombre }} </h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                        
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Eliminar</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> 
                                        <!-- modal ends -->
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer">
            {!! $proveedoresData->links() !!}
        </div>
    </div>

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

        $('.selectMulti').selectize({
            maxItems: 3
        });
	</script>
@endrole
@endsection