@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}">Usuarios</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('users.index') }}">
                {!! csrf_field() !!}
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('users.new') }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>

                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('users.index') }}">Limpiar Filtros</a>
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
                            <th>Nombre</th>
                            <th>E-mail</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($usersData as $usersItem)
                        <tr>
                            <td> {{ $usersItem->nombre.' '.$usersItem->apellidos }} </td>
                            <td> {{ $usersItem->email }} </td>
                            <td>
                                @if(!$usersItem->deleted_at) 
                                    <a href="{{ route('users.form', $usersItem->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                                    <a href="#" class="btn btn-danger btn-xs" data-target="#deleteModal{{ $usersItem->id }}" data-toggle="modal"><i class="far fa-trash-alt"></i> Eliminar</a>

                                    <!-- modal starts -->
                                    <div class="modal fade" id="deleteModal{{ $usersItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('users.delete', $usersItem->id) }}" >
                                                {!! csrf_field() !!}
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> Borrar {{ $usersItem->nombre }} </h4>
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
                                    <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $usersItem->id }}" data-toggle="modal"><i class="fas fa-arrow-circle-up"></i> Restaurar</a>
    
                                    <!-- modal starts -->
                                    <div class="modal fade" id="restoreModal{{ $usersItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('users.restore', $usersItem->id) }}" >
                                                {!! csrf_field() !!}

                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Restaurar  {{ $usersItem->nombre }} </h4>
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
                                    <div class="modal fade" id="forceDeleteModal{{ $usersItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form class="form-horizontal" method="post" action="{{ route('users.force-delete', $usersItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Borrar permanentemente {{ $usersItem->nombre }} </h4>
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
            {!! $usersData->links() !!}
        </div>
    </div>
@endrole
@endsection