@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            @foreach($conveniosData as $entityId => $entityValue)
                @foreach($razon_socialData as $entityId2 => $entityValue2)
                    @if($entityId2 == $entityValue)
                        <a href="{{ route('convenioPrestaciones.index', $convenio) }}">Prestaciones del convenio con {{$entityValue2}}</a>
                    @endif
                @endforeach
            @endforeach
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
    <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('convenioPrestaciones.index', $convenio) }}">
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
                </div>
                <hr>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('seleccionarPrestaciones.index', $convenio) }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>
                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('convenioPrestaciones.index', $convenio) }}">Limpiar Filtros</a>
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

                <?php $tienePrestaciones=0; ?>
                @foreach($cPrestacionesData as $cPrestacionesItem)
                    @if ($cPrestacionesItem->convenio_id == $convenio->id)
                        <?php $tienePrestaciones=1; ?>
                    @endif
                @endforeach
                @if($tienePrestaciones == 1)
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Valor Seleccionado</th>
                        <th>Factor</th>
                        <th>Precio Total</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    @foreach($cPrestacionesData as $cPrestacionesItem)
                        <tr>
                            <td> {{ $cPrestacionesItem->prestaciones->codigo }}</td>
                            <td> {{ $cPrestacionesItem->prestaciones->nombre }}</td>
                            <td> {{ $cPrestacionesItem->valor_seleccionado ? : '----'}}</td>
                            <td> {{ $cPrestacionesItem->factor ? : '----'}}</td>
                            <td> {{ $cPrestacionesItem->valor_total ? : '----'}}</td>
                            <td>
                                @if(!$cPrestacionesItem->deleted_at) 
                                    <a href="{{ route('convenioPrestaciones.form', [$cPrestacionesItem->id, $convenio, $cPrestacionesItem->prestaciones->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                                    <a href="#" class="btn btn-danger btn-xs" data-target="#deleteModal{{ $cPrestacionesItem->id }}" data-toggle="modal"><i class="far fa-trash-alt"></i> Eliminar</a>

                                    <!-- modal starts -->
                                    <div class="modal fade" id="deleteModal{{ $cPrestacionesItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('convenioPrestaciones.delete', $cPrestacionesItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Borrar {{ $cPrestacionesItem->prestaciones->nombre }} </h4>
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
                                    <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $cPrestacionesItem->id }}" data-toggle="modal"><i class="fas fa-arrow-circle-up"></i> Restaurar</a>
                                    <a href="#" class="btn btn-xs btn-danger" data-target="#forceDeleteModal{{ $cPrestacionesItem->id }}" data-toggle="modal"><i class="fas fa-trash"></i> Eliminar Permanente</a>


                                    <!-- modal starts -->
                                    <div class="modal fade" id="restoreModal{{ $cPrestacionesItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('convenioPrestaciones.restore', $cPrestacionesItem->id) }}" >
                                                {!! csrf_field() !!}

                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Restaurar  {{ $cPrestacionesItem->nombre }} </h4>
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
                                    <div class="modal fade" id="forceDeleteModal{{ $cPrestacionesItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('convenioPrestaciones.force-delete', $cPrestacionesItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Borrar permanentemente {{ $cPrestacionesItem->nombre }} </h4>
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
                @else
                    <b>Este convenio no tiene prestaciones asociadas</b>
                @endif
            </table>
            </div>
        </div>
        
        <div class="card-footer">
            {!! $cPrestacionesData->links() !!}
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