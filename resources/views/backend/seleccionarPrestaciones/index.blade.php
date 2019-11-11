@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('seleccionarPrestaciones.index', $convenio) }}">Prestaciones</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
    <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('seleccionarPrestaciones.index', $convenio) }}">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-3">
                        <label>Filtrar</label>
                        <div>
                            <input type="text" name="codigo" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
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
                                <a href="{{ route('convenioPrestaciones.new', [$convenio, $prestacionesItem]) }}" class="btn btn-success btn-xs"> Seleccionar</a>
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
@endrole
@endsection