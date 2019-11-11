@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a>Contactos</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('contactos.index', $proveedor) }}">
                {!! csrf_field() !!}

                <div class="row">
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
                    <div class="col-3">
                        <label>Filtrar por teléfono</label>
                        <div>
                            <select name="telefono" class="selectpicker selectField" placeholder='Seleccione teléfono' data-live-search='true'>
                                <option value=""></option>
                                @foreach($telefonosData as $entityId => $entityValue)
                                    <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Filtrar por e-mail</label>
                        <div>
                            <select name="email" class="selectpicker selectField" placeholder='Seleccione e-mail' data-live-search='true'>
                                <option value=""></option>
                                @foreach($emailsData as $entityId => $entityValue)
                                    <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Filtrar por dirección postal</label>
                        <div>
                            <select name="direccion_postal" class="selectpicker selectField" placeholder='Seleccione dirección postal' data-live-search='true'>
                                <option value=""></option>
                                @foreach($direccionesData as $entityId => $entityValue)
                                    <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('contactos.new', $proveedor) }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>

                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('contactos.index', $proveedor) }}">Limpiar Filtros</a>
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
                    <?php $tieneContactos=0; ?>
                    @foreach($contactosData as $contactosItem)
                        @if ($contactosItem->proveedor_id == $proveedor->id)
                            <?php $tieneContactos=1; ?>
                        @endif
                    @endforeach
                    @if($tieneContactos == 1)

                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>E-mail</th>
                            <th>Dirección postal</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($contactosData as $contactosItem)
                            <tr>
                                <td> {{ $contactosItem->nombre }}</td>
                                <td> {{ $contactosItem->telefono }}</td>
                                <td> {{ $contactosItem->email }}</td>
                                <td> {{ $contactosItem->direccion_postal }}</td>
                                <td>
                                    @if(!$contactosItem->deleted_at)
                                        <a href="{{ route('contactos.form', [$contactosItem->id, $proveedor]) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                                        <a href="#" class="btn btn-danger btn-xs" data-target="#deleteModal{{ $contactosItem->id }}" data-toggle="modal"><i class="icon-trash"></i> Eliminar</a>

                                        <!-- modal starts -->
                                        <div class="modal fade" id="deleteModal{{ $contactosItem->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('contactos.delete', $contactosItem->id) }}" >
                                                    {!! csrf_field() !!}
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> Borrar {{ $contactosItem->nombre }} </h4>
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
                                        <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $contactosItem->id }}" data-toggle="modal" >Restaurar</a>
                                        <a href="#" class="btn btn-xs btn-danger" data-target="#forceDeleteModal{{ $contactosItem->id }}" data-toggle="modal" >Eliminar Permanente</a>

                                        <!-- modal starts -->
                                        <div class="modal fade" id="restoreModal{{ $contactosItem->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('contactos.restore', $contactosItem->id) }}" >
                                                    {!! csrf_field() !!}

                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> Restaurar  {{ $contactosItem->nombre }} </h4>
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
                                        <div class="modal fade" id="forceDeleteModal{{ $contactosItem->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('contactos.force-delete', $contactosItem->id) }}" >
                                                        {!! csrf_field() !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"> Borrar permanentemente {{ $contactosItem->nombre }} </h4>
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
                        <b>Este proveedor no tiene contactos registrados</b>
                    @endif

                </table>
            </div>
        </div>
        
        <div class="card-footer">
            {!! $contactosData->links() !!}
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