@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('prestaciones.index') }}">Prestaciones</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
    <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('prestaciones.index') }}">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-3">
                        <label>Filtrar por código</label>
                        <div>
                            <select name="codigo" class="selectpicker selectField" placeholder='Seleccione código' data-live-search='true'>
                                <option value=""></option>
                                @foreach($codigosData as $entityId => $entityValue)
                                    <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Filtrar por nombre</label>
                        <div>
                        <select name="nombre" class="selectpicker selectField" placeholder='Seleccione nombre' data-live-search='true'>
                                <option value=""></option>
                                @foreach($nombresData as $entityId => $entityValue)
                                    <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-3">
                        <label>Filtrar por fonasa</label>
                        <div>
                            <select name="fonasa" class="selectpicker selectField" placeholder='Seleccione fonasa' data-live-search='true'>
                                <option value=""></option>
                                <option value="0">Sí</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                    </div> -->
                </div>
                <hr>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('prestaciones.new') }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>

                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('prestaciones.index') }}">Limpiar Filtros</a>
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
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Valor Nivel 1</th>
                    <th>Valor Nivel 2</th>
                    <th>Valor Nivel 3</th>
                    <th>Fonasa</th>
                    <th>Acción</th>
                </tr>
                </thead>
                @foreach($prestacionesData as $prestacionesItem)
                    <tr>
                        <td> {{ $prestacionesItem->codigo }}</td>
                        <td> {{ $prestacionesItem->nombre }}</td>
                        <td> {{ $prestacionesItem->valor_1 ?: '----' }}</td>
                        <td> {{ $prestacionesItem->valor_2 ?: '----' }}</td>
                        <td> {{ $prestacionesItem->valor_3 ?: '----' }}</td>
                        @if($prestacionesItem->valor_3 == null && $prestacionesItem->valor_2 == null && $prestacionesItem->valor_1 == null)
                            <td> No</td>
                        @else
                            <td> Sí</td>
                        @endif
                        <td>
                            @if(!$prestacionesItem->deleted_at) 
                                <a href="{{ route('prestaciones.form', $prestacionesItem->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                                <a href="#" class="btn btn-danger btn-xs" data-target="#deleteModal{{ $prestacionesItem->id }}" data-toggle="modal"><i class="far fa-trash-alt"></i> Eliminar</a>

                                <!-- modal starts -->
                                <div class="modal fade" id="deleteModal{{ $prestacionesItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('prestaciones.delete', $prestacionesItem->id) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <h4 class="modal-title"> Borrar {{ $prestacionesItem->nombre }} </h4>
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
                                <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $prestacionesItem->id }}" data-toggle="modal"><i class="fas fa-arrow-circle-up"></i> Restaurar</a>


                                <!-- modal starts -->
                                <div class="modal fade" id="restoreModal{{ $prestacionesItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('prestaciones.restore', $prestacionesItem->id) }}" >
                                            {!! csrf_field() !!}

                                            <div class="modal-header">
                                                <h4 class="modal-title"> Restaurar  {{ $prestacionesItem->nombre }} </h4>
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
                                <div class="modal fade" id="forceDeleteModal{{ $prestacionesItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('prestaciones.force-delete', $prestacionesItem->id) }}" >
                                            {!! csrf_field() !!}
                                            <div class="modal-header">
                                                <h4 class="modal-title"> Borrar permanentemente {{ $prestacionesItem->nombre }} </h4>
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
            {!! $prestacionesData->links() !!}
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