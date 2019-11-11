@extends('layouts.app')

@section('content')
    <script lang="javascript" src="/assets/frontend/js/xlsx.full.min.js"></script>
    <script lang="javascript" src="/assets/frontend/js/FileSaver.js"></script>
    <script lang="javascript" src="/assets/frontend/js/xlsx.core.min.js"></script>
    
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('contratos.index') }}">Contratos</a>
        </li>
        <li class="breadcrumb-item active">Mantenedor</li>
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('contratos.index') }}">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="col-3">
                        <label>RUT Proveedor</label>
                        <div>
                            <select name="proveedores" class="selectpicker selectField"  placeholder='Seleccione RUT Proveedor' data-live-search='true'>
                                <option value=""></option>
                                @foreach($proveedoresData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Razón Social</label>
                        <div>
                            <select name="proveedoresNombre" class="selectpicker selectField" placeholder='Seleccione Razón Social' data-live-search='true'>
                                <option value=""></option>
                                @foreach($proveedoresNombreData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Contrato</label>
                        <div>
                            <select name="licitaciones" class="selectpicker selectField" placeholder='Seleccione Contrato' data-live-search='true'>
                                <option value=""></option>
                                @foreach($licitacion as $entityId => $entityValue)                                    
                                    <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label>Cargo Admin. Técnico</label>
                        <div>
                            <select name="cargos" class="selectpicker selectField" placeholder='Seleccione Cargo' data-live-search='true'>
                                <option value=""></option>
                                @foreach($cargosData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <label>Vigencia Contrato</label>
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
                @role('Admin')
                <!--    <div class="btn-group float-right ml-3">
                        <a href="{ route('contratos.new') }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nuevo</a>
                    </div> -->
                @endrole
                <div class="btn-group float-right ml-3" >
                    <a class="btn btn-success rounded" href="{{route('contratos.export')}}">Exportar</a>
                </div>
                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('contratos.index') }}">Limpiar Filtros</a>
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
            <!--FILTRAR GRILLA SEGÚN CARGO DE USUARIO. -->
            <div class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Rut Proveedor</th>
                    <th>Razón Social Proveedor</th>
                    <th>ID Contrato</th>
                    <th>Licitación</th>
                    <th>Moneda</th>
                    <th>Precio</th>
                    <th>Valor en Pesos Chilenos</th>
                    <th>Cargo</th>
                    
                    <th>Fecha inicio contrato</th>
                    <th>Fecha termino contrato</th>
                    <th>Fecha último acto administrativo</th>
                    <th>Objeto del contrato</th>
                    <th>N° Boleta Garantía</th>
                    <th>Monto</th>
                    <th>Fecha de Vencimiento</th>
                    @role('Admin')
                        <th>Acción</th>
                    @endrole
                </tr>
                </thead>
                    @foreach($contratosData as $contratosItem)
                        <tr>
                            <td> {{ $contratosItem->proveedores->rut }}</td>
                            <td> {{ $contratosItem->proveedores->razon_social }}</td>
                            <td> {{ $contratosItem->selectContrato ? "TD-" : "LC-"}}{{ $contratosItem->id }} </td>
                            <td> {{ $contratosItem->licitacion->nro_licitacion ?: '----' }}</td>
                            <td> {{ $contratosItem->monedas->codigo }} </td>
                            <td> {{ $contratosItem->precio }} </td>
                            <td> {{ $contratosItem->precio * $contratosItem->monedas->factor_conversion }} </td>
                            <td> {{ $contratosItem->cargos->nombre }} </td>
                            
                            <td> {{ $contratosItem->fecha_inicio ?: '----' }} </td>
                            <td> {{ $contratosItem->fecha_termino ?: '----' }} </td>
                            <td> {{ $contratosItem->fecha_aprobacion ?: '----' }} </td>
                            <td> {{ $contratosItem->objeto_contrato }}</td>
                            <td> {{ $contratosItem->boletas->numero }}</td>
                            <td> {{ $contratosItem->boletas->monto }} </td>
                            <td> {{ $contratosItem->boletas->fecha_vencimiento }}</td>
                            @role('Admin')
                            <td>
                                <a href="{{ route('contratos.form', $contratosItem->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                                
                                <a href="{{ route('bitacoraContrato.index', $contratosItem->id) }}" class="btn btn-info btn-xs"><i class="fas fa-clipboard-list"></i> Bitacora</a>                                                               
                                
                            </td>
                            @endrole
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
	</script>
@endsection