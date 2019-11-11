@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('alertaConvenio.index') }}">Convenios</a>
        </li>
        <li class="breadcrumb-item active">Alertas</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('alertaConvenio.index') }}">
                {!! csrf_field() !!}
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('alertaConvenio.mostrarTodos') }}" class="btn btn-warning rounded">Mostrar todos</a>
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
                        <th>Rut Proveedor</th>
                        <th>Razón social Proveedor</th>
                        <th>Alerta término contrato</th>
                        <th>Contrato</th>
                        <th>Alerta boleta de garantía</th>
                        <th>Boleta</th>
                        <th>Ver</th>
                    </tr>
                    </thead>
                        @foreach($conveniosData as $conveniosItem)
                            <tr>
                                <td> {{ $conveniosItem->proveedores->rut }} </td>
                                <td> {{ $conveniosItem->proveedores->razon_social }} </td>

                                <!-- cálculo de termino de convenio -->
                                <?php
                                    $fecha_termino_convenio = new DateTime($conveniosItem->fecha_termino);
                                    $fecha_alerta_convenio = new DateTime($conveniosItem->alerta_vencimiento);
                                    $fecha_now = new DateTime("now");
                                    $diff = $fecha_now->diff($fecha_termino_convenio);
                                ?>
                                @if($conveniosItem->alerta_vencimiento == null)
                                    <td style="color:#05a303"><b>Sin alerta</b></td>
                                @elseif($conveniosItem->estado_alerta == 'resuelto')
                                    <td style="color:#05a303"><b>Resuelto</b></td>
                                @else
                                    @if($fecha_now <= $fecha_termino_convenio || $diff->days == 0)
                                        @if($fecha_now > $fecha_termino_convenio)
                                            <td style="color:#e58806"> <b>Convenio caduca hoy</b></td>
                                        @elseif($fecha_now >= $fecha_alerta_convenio)
                                            <td style="color:#e58806"> <b>Convenio caduca en {{ $diff->days+1}} días</b></td>
                                        @else
                                            <td style="color:#05a303"><b>No se ha alcanzado la fecha de alerta</b></td>                         
                                        @endif
                                    @else
                                        <td style="color:#ff0000"><b>Convenio caducado</b></td>
                                    @endif
                                @endif

                                <td>
                                    @if($conveniosItem->estado_alerta == 'visto')
                                        <a href="#" class="btn btn-success btn-xs" data-target="#recuperarVistoConvenioModal{{ $conveniosItem->id }}" data-toggle="modal"> Recuperar</a>
                                    @else
                                        <a href="#" class="btn btn-warning btn-xs" data-target="#resolverConvenioModal{{ $conveniosItem->id }}" data-toggle="modal"> Resolver</a>
                                    @endif
                                </td>
                                <!-- cálculo de vencimiento de boleta -->
                                <?php
                                    $fecha_vencimiento = new DateTime($conveniosItem->boletas->fecha_vencimiento);
                                    $fecha_alerta_boleta = new DateTime($conveniosItem->boletas->alerta_vencimiento);
                                    $diff = $fecha_now->diff($fecha_vencimiento);
                                ?>
                                @if($conveniosItem->boletas->alerta_vencimiento == null && $conveniosItem->boletas->estado_alerta != 'resuelto')
                                    <td style="color:#05a303"><b>Sin alerta</b></td>
                                @elseif($conveniosItem->boletas->estado_alerta == 'resuelto')
                                    <td style="color:#05a303"><b>Resuelto</b></td>
                                @else
                                    @if($fecha_now <= $fecha_vencimiento || $diff->days == 0)
                                        @if($fecha_now > $fecha_vencimiento)
                                            <td style="color:#e58806"> <b>Boleta vence hoy</b></td>
                                        @elseif($fecha_now >= $fecha_alerta_boleta)
                                            <td style="color:#e58806"><b> Boleta vence en {{ $diff->days+1}} días</b></td>
                                        @else
                                            <td style="color:#05a303"><b>No se ha alcanzado la fecha de alerta</b></td>                              
                                        @endif
                                    @else
                                        <td style="color:#ff0000"><b>Boleta vencida</b></td>
                                    @endif
                                @endif
                                
                                <td>
                                    @if($conveniosItem->boletas->estado_alerta == 'visto')
                                        <a href="#" class="btn btn-success btn-xs" data-target="#recuperarVistoBoletaModal{{ $conveniosItem->id }}" data-toggle="modal"> Recuperar</a>
                                    @else
                                        <a href="#" class="btn btn-warning btn-xs" data-target="#resolverBoletaModal{{ $conveniosItem->id }}" data-toggle="modal"> Resolver</a>
                                    @endif
                                </td>

                                <td>    
                                    <a href="{{ route('hitoConvenio.index', $conveniosItem->id) }}" class="btn btn-warning btn-xs"> Hitos</a>
                                </td>

                                <!-- modal resolver visto starts -->
                                <div class="modal fade" id="resolverConvenioModal{{ $conveniosItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('alertaConvenio.resolverConvenio', $conveniosItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Resolver convenio ?</h4>
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
                                <!-- modal resolver visto ends -->

                                <!-- modal recuperar visto starts -->
                                <div class="modal fade" id="recuperarVistoConvenioModal{{ $conveniosItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('alertaConvenio.recuperarConvenio', $conveniosItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Recuperar convenio ?</h4>
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

                                <!-- modal resolver boleta visto starts -->
                                <div class="modal fade" id="resolverBoletaModal{{ $conveniosItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('alertaConvenio.resolverBoletaConvenio', $conveniosItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Resolver boleta ?</h4>
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
                                <!-- modal resolver boleta visto ends -->

                                <!-- modal recuperar visto starts -->
                                <div class="modal fade" id="recuperarVistoBoletaModal{{ $conveniosItem->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form class="form-horizontal" method="post" action="{{ route('alertaConvenio.recuperarBoletaConvenio', $conveniosItem->id) }}" >
                                                {!! csrf_field() !!}
                                                <div class="modal-header">
                                                    <h4 class="modal-title"> Recuperar boleta ?</h4>
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
        
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
                {!! $conveniosData->links() !!}
        </div>
    </div>
@endrole
@endsection