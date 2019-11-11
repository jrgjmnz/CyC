@extends('layouts.app')

@section('content')
@role('Admin')
<script lang="javascript" src="/assets/frontend/js/xlsx.full.min.js"></script>
<script lang="javascript" src="/assets/frontend/js/FileSaver.js"></script>
<script lang="javascript" src="/assets/frontend/js/xlsx.core.min.js"></script>

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('creportes.index') }}">Contratos</a>
        </li>
        <li class="breadcrumb-item active">Reportes</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('creportes.index') }}">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-3">
                        <label>Filtro por ID Contrato</label>
                        <div>
                            <select name="licitaciones" class="selectpicker selectField" placeholder='Seleccione ID Contrato' data-live-search='true'>
                                <option value=""></option>
                                @foreach($licitacionesData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <label>Filtro por Objeto del Contrato</label>
                        <div>
                            <select name="objetos" class="selectpicker selectField" placeholder='Seleccione Objeto Contrato' data-live-search='true'>
                                <option value=""></option>
                                @foreach($objetosData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <label>Filtro por Razón Social</label>
                        <div>
                            <select name="razonSocial" class="selectpicker selectField" placeholder='Seleccione Razón Social' data-live-search='true'>
                                <option value=""></option>
                                @foreach($razonSocialData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

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
                    
                    
                </div>
                <hr>
                <div class="btn-group float-right ml-3" >
                    <a class="btn btn-success rounded" href="{{route('creportes.export')}}">Exportar</a>
                </div>

                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('creportes.index') }}">Limpiar Filtros</a>
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
                    <th>Razón social</th>
                    <th>ID Contrato</th>
                    <th>Moneda</th>
                    <th>Precio</th>
                    <th>Valor en Pesos Chilenos</th>
                    <th>Cargo</th>
                    <th>Nombre administrador técnico</th>
                    <th>Fecha inicio contrato</th>
                    <th>Fecha termino contrato</th>
                    <th>Fecha último acto administrativo</th>
                    <th>Objeto del contrato</th>
                    <th>N° Boleta Garantía</th>
                    <th>Monto</th>
                    <th>Fecha de Vencimiento</th>
                </tr>
                </thead>
                    @foreach($contratosData as $contratosItem)
                        <tr>
                            <td> {{ $contratosItem->proveedores->rut }}</td>
                            <td> {{ $contratosItem->proveedores->razon_social }} </td>
                            <td> {{ $contratosItem->licitacion }}</td>
                            <td> {{ $contratosItem->monedas->codigo }} </td>
                            <td> {{ $contratosItem->precio }} </td>
                            <td> {{ $contratosItem->precio * $contratosItem->monedas->factor_conversion }} </td>
                            <td> {{ $contratosItem->cargos->nombre }} </td>
                            <td> {{ $contratosItem->nombre_admin_tecnico }} </td>
                            <td> {{ $contratosItem->fecha_inicio ?: '----' }} </td>
                            <td> {{ $contratosItem->fecha_termino ?: '----' }} </td>
                            <td> {{ $contratosItem->fecha_aprobacion ?: '----' }} </td>
                            <td> {{ $contratosItem->objeto_contrato }}</td>
                            <td> {{ $contratosItem->boletas->numero }}</td>
                            <td> {{ $contratosItem->boletas->monto }} </td>
                            <td> {{ $contratosItem->boletas->fecha_vencimiento }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>

        <div class="card-footer">
                {!! $contratosData->links() !!}
        </div>
    </div>


    <!--SCRIPT PARA EXPORTACIÓN A ARCHIVO XLS, REVISAR, NO EXPORTA -->
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
            saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'Reporte Contratos.xlsx');
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