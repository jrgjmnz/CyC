@extends('layouts.app')

@section('content')
@role('Admin')
    <script lang="javascript" src="/assets/frontend/js/xlsx.full.min.js"></script>
    <script lang="javascript" src="/assets/frontend/js/FileSaver.js"></script>
    <script lang="javascript" src="/assets/frontend/js/xlsx.core.min.js"></script>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('convenios.index') }}">Convenios</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('convenios.index') }}">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-3">
                        <label>Filtro por RUT Proveedor</label>
                        <div>
                            <select name="proveedores" class="selectpicker selectField" placeholder='Seleccione RUT Proveedor' data-live-search='true'>
                                <option value=""></option>
                                @foreach($proveedoresData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Filtro por Razón Social</label>
                        <div>
                            <select name="razon_social" class="selectpicker selectField" placeholder='Seleccione Razón Social' data-live-search='true'>
                                <option value=""></option>
                                @foreach($razon_socialData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Filtro por ID Contrato</label>
                        <div>
                            <select name="licitaciones" class="selectpicker selectField" placeholder='Seleccione Licitación' data-live-search='true'>
                                <option value=""></option>
                                @foreach($licitacionesData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Filtro Vigencia Convenio</label>
                        <div>
                            <select name="vigencia" class="selectpicker selectField" placeholder='Seleccione Vigencia' data-live-search='true'>
                                <option value=""></option>
                                <option value="si">Vigente</option>
                                <option value="no">No vigente</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="btn-group float-right ml-3">
                    <a href="{{ route('convenios.new') }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                </div>
                <div class="btn-group float-right ml-3" >
                    <a class="btn btn-success rounded" href="{{route('convenios.export')}}">Exportar</a>
                </div>

                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('convenios.index') }}">Limpiar Filtros</a>
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
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Rut Proveedor</th>
                    <th>Razón social Proveedor</th>
                    <th>Ubicación Proveedor</th>
                    <th>ID Contrato</th>
                    <th>Fecha inicio</th>
                    <th>Fecha termino</th>
                    <th>Objeto del contrato</th>
                    <th>N° Boleta</th>
                    <th>Acción</th>
                </tr>
                </thead>
                    @foreach($conveniosData as $conveniosItem)
                        <tr>
                            <td> {{ $conveniosItem->proveedores->rut ?: '----' }}</td>
                            <td> {{ $conveniosItem->proveedores->razon_social ?: '----' }}</td>
                            <td> {{ $conveniosItem->proveedores->ubicacion ?: '----' }}</td>
                            <td> {{ $conveniosItem->licitacion ?: '----' }}</td>
                            <td> {{ $conveniosItem->fecha_inicio ?: '----' }} </td>
                            <td> {{ $conveniosItem->fecha_termino ?: '----' }} </td>
                            <td> {{ $conveniosItem->objeto_contrato ?: '----' }}</td>
                            <td> {{ $conveniosItem->boletas->numero ?: '----' }}</td>

                            <td>
                                <a href="{{ route('convenioPrestaciones.index', $conveniosItem->id) }}" class="btn btn-success btn-xs"> Prestaciones</a>
                                <a href="{{ route('bitacoraConvenio.index', $conveniosItem->id) }}" class="btn btn-info btn-xs"><i class="fas fa-clipboard-list"></i> Bitacora</a>
                                <a href="{{ route('convenios.form', $conveniosItem->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                            </td>
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
    <script>
            var wb = XLSX.utils.table_to_book(document.getElementById('dataTable'), {sheet:"Sheet JS"});
            var wbout = XLSX.write(wb, {bookType:'xlsx', bookSST:true, type: 'binary'});
            function s2ab(s) {
                            var buf = new ArrayBuffer(s.length);
                            var view = new Uint8Array(buf);
                            
                            for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                            return buf;
            }
            $("#btnExport").click(function(){
            saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'Reporte Convenios.xlsx');
            });
    </script>

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