@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('bitacoraConvenio.index', $convenio) }}">Convenio</a>
        </li>
        <li class="breadcrumb-item active">Bitacora</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('bitacoraConvenio.index', $convenio) }}">
                {!! csrf_field() !!}

                
                <hr>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('bitacoraConvenio.new', $convenio) }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>

                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('bitacoraConvenio.index', $convenio) }}">Limpiar Filtros</a>
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
                    <?php $tieneBitacoras=0; ?>
                        @foreach($bitacorasData as $bitacorasItem)
                            @if ($bitacorasItem->convenio_id == $convenio->id)
                                <?php $tieneBitacoras=1; ?>
                            @endif
                        @endforeach
                        @if($tieneBitacoras == 1)    
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Texto</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach($bitacorasData as $bitacorasItem)
                            <tr>
                                <td> {{ $bitacorasItem->fecha }}</td>
                                <td> {{ $bitacorasItem->texto }}</td>
                                <td> {{ $bitacorasItem->usuarios->nombre }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    @else
                        <b>Este convenio no tiene bitácoras asociadas</b>
                    @endif
                </table>
            </div>           
        </div>
        
        <div class="card-footer">
            {!! $bitacorasData->links() !!}
        </div>
    </div>
@endrole
@endsection