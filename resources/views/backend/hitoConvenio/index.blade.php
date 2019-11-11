@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('hitoConvenio.index', $convenio) }}">Hitos</a>
        </li>
        <li class="breadcrumb-item active">Alerta Convenios</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('hitoConvenio.index', $convenio) }}">
                {!! csrf_field() !!}
                <hr>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('hitoConvenio.new', $convenio) }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('hitoConvenio.mostrarTodos', $convenio) }}" class="btn btn-warning rounded">Mostrar todos</a>
                </div>
                <div class="btn-group float-left">
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
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado Hito</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                        @foreach($hitosData as $hitosItem)
                            <tr>
                                <td> {{ $hitosItem->nombre }} </td>

                                <?php
                                    $fecha_h = new DateTime($hitosItem->fecha_hito);
                                    $fecha_a = new DateTime($hitosItem->fecha_alerta);
                                    $fecha_now = new DateTime("now");
                                    $diff = $fecha_now->diff($fecha_h);
                                ?>

                                @if($fecha_now <= $fecha_h || $diff->days == 0)
                                    @if($fecha_now > $fecha_h)
                                        <td style="color:#e58806"> <b>Alerta: Hito caduca hoy</b></td>
                                    @elseif($fecha_now >= $fecha_a)
                                        <td style="color:#e58806"> <b>Alerta: Hito caduca en {{ $diff->days+1}} días</b></td>
                                    @else
                                        <td style="color:#05a303"><b>Sin alerta</b></td>                              
                                    @endif
                                @else
                                    <td style="color:#ff0000"><b>Hito caducado</b></td>
                                @endif

                                <td>
                                    @if(!$hitosItem->deleted_at) 
                                        @if($hitosItem->estado_alerta == null)
                                            <a href="#" class="btn btn-warning btn-xs" data-target="#vistoModal{{ $hitosItem->id }}" data-toggle="modal"> Visto</a>
                                        @else
                                            <a href="#" class="btn btn-success btn-xs" data-target="#recuperarVistoModal{{ $hitosItem->id }}" data-toggle="modal"> Recuperar</a>
                                        @endif
                                        <a href="{{ route('hitoConvenio.form', [$hitosItem->id, $convenio]) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                                        <a href="#" class="btn btn-danger btn-xs" data-target="#deleteModal{{ $hitosItem->id }}" data-toggle="modal"><i class="far fa-trash-alt"></i> Eliminar</a>

                                        <!-- modal visto starts -->
                                        <div class="modal fade" id="vistoModal{{ $hitosItem->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('hitoConvenio.visto', $hitosItem->id) }}" >
                                                        {!! csrf_field() !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"> Marcar visto {{ $hitosItem->nombre }} ?</h4>
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
                                        <!-- modal visto ends -->

                                        <!-- modal recuperar visto starts -->
                                        <div class="modal fade" id="recuperarVistoModal{{ $hitosItem->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('hitoConvenio.recuperar', $hitosItem->id) }}" >
                                                        {!! csrf_field() !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"> Recuperar {{ $hitosItem->nombre }} ?</h4>
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
                                        <!-- modal recuperar visto ends -->

                                        <!-- modal starts -->
                                        <div class="modal fade" id="deleteModal{{ $hitosItem->id }}">
                                        <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form class="form-horizontal" method="post" action="{{ route('hitoConvenio.force-delete', $hitosItem->id) }}" >
                                                        {!! csrf_field() !!}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"> Borrar permanentemente {{ $hitosItem->nombre }} </h4>
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
                {!! $hitosData->links() !!}
        </div>
    </div>
@endrole
@endsection