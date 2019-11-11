@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('cargos.index') }}">Cargos</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('cargos.index') }}">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-3">
                        <label>Filtro por nombre</label>
                        <div>
                            <select name="tipo" class="selectpicker selectField" placeholder='Seleccione cargo' data-live-search='true'>
                                <option value=""></option>
                                @foreach($tiposData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('cargos.new') }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>

                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('cargos.index') }}">Limpiar Filtros</a>
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
            <div class="table-responsive table-sm -md -lg -x">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cargosData as $cargosItem)
                        <tr>
                            <td> {{ $cargosItem->nombre }}</td>
                            <td>
                                @if(!$cargosItem->deleted_at) 
                                    <a href="{{ route('cargos.form', $cargosItem->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                                    <a href="#" class="btn btn-danger btn-xs" data-target="#deleteModal{{ $cargosItem->id }}" data-toggle="modal"><i class="far fa-trash-alt"></i> Eliminar</a>

                                    <!-- modal starts -->
                                    <div class="modal fade" id="deleteModal{{ $cargosItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('cargos.delete', $cargosItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Borrar {{ $cargosItem->nombre }} </h4>
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
                                    <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $cargosItem->id }}" data-toggle="modal"><i class="fas fa-arrow-circle-up"></i> Restaurar</a>
    

                                    <!-- modal starts -->
                                    <div class="modal fade" id="restoreModal{{ $cargosItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('cargos.restore', $cargosItem->id) }}" >
                                                {!! csrf_field() !!}

                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Restaurar  {{ $cargosItem->nombre }} </h4>
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
                                    <div class="modal fade" id="forceDeleteModal{{ $cargosItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('cargos.force-delete', $cargosItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Borrar permanentemente {{ $cargosItem->nombre }} </h4>
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
            {!! $cargosData->links() !!}
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