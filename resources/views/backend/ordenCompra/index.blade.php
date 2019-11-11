@extends('layouts.app')

@section('content')

    <script lang="javascript" src="/assets/frontend/js/xlsx.full.min.js"></script>
    <script lang="javascript" src="/assets/frontend/js/FileSaver.js"></script>
    <script lang="javascript" src="/assets/frontend/js/xlsx.core.min.js"></script>
    
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('ordenCompra.index') }}">Orden de Compra</a>
        </li>        
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
            <div class="card-header">
                <form method="get" class="form-horizontal" action="{{ route('ordenCompra.index') }}">
                    {!! csrf_field() !!}

                   

                    <div class="row">
                        <div class="col-3">
                            <label>ID Contrato</label>
                            <div>
                                <select name="numeroLicitacion" class="selectpicker selectField" placeholder='Seleccione ID Contrato' data-live-search='true'>
                                    <option value=""></option>
                                    @foreach($licitacionesData as $entityId => $entityValue)
                                        <option value="{{ $entityId }}" >{{ $entityValue }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-3">
                            <label>N° Orden de Compra</label>
                            <div>
                                <select name="numeroOrden" class="selectpicker selectField" placeholder='Seleccione N° Orden de Compra' data-live-search='true'>
                                    <option value=""></option>
                                    @foreach($numeroOrdenesData as $entityId => $entityValue)
                                        <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>                                 

                    <div class="row">
                        <div class="col-3">
                            <label>Estado</label>
                            <div>
                                <select name="estado" class="selectpicker selectField" placeholder='Seleccione Estado' data-live-search='true'>
                                    <option value=""></option>
                                    @foreach($estadoData as $entityId => $entityValue)
                                        <option value="{{ $entityValue }}" >{{ $entityValue }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--EXPORTAR -->
                    <div class="btn-group float-right ml-3" >
                        <a class="btn btn-success rounded" href="{{route('ordenCompra.export')}}">Exportar</a>
                    </div>           
                   
                    <div class="btn-group float-right">
                        @if(count(Request::input()))
                            <a class="btn btn-default" href="{{ route('ordenCompra.index') }}">Limpiar Filtros</a>
                            <button type="submit" class="btn btn-primary rounded"><i class="fa fa-search"></i> Buscar</button>
                        @else
                            <button type="submit" class="btn btn-primary rounded"><i class="fa fa-search"></i> Buscar</button>
                        @endif
                    </div>                                                           
                </form>
            </div>

              <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status')}}
        </div>
        @endif               
    
    <div class="table-responsive">
            <table class="table table-bordered table-sm w-100" id="dataOrdenCompra" cellspacing="0">
                <thead>
                    <tr>
                        
                        <!-- <th>Id Contrato</th> -->
                        <th>Número Licitación</th>
                        <th>Número Orden de Compra</th>
                        <th>Fecha de Envío</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acción</th>                 
                                         
                    </tr>
                </thead>      
               
                @foreach ($ordenCompraData as $ordenCompraItem)
                    <tr>
                     
                    <td>{{ $ordenCompraItem->Contrato->licitacion->nro_licitacion ?? '' }}</td>
                    <td>{{ $ordenCompraItem->numero_orden_compra ?? '' }}</td>
                    <td>{{ $ordenCompraItem->fecha_envio ?? '' }}</td>
                    <td>{{ $ordenCompraItem->total  ?? '' }}</td>
                    <td>{{ $ordenCompraItem->estado ?? '' }}</td>
                    
                    <td>
                        @if (!$ordenCompraItem->deleted_at)
                        <a href="{{ route('ordenCompra.form', $ordenCompraItem->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Editar</a>
                        <a href="#" class="btn btn-danger btn-xs" data-target="#deleteModal{{$ordenCompraItem->id}}" data-toggle="modal"> <i class="far fa-trash-alt"></i> Eliminar</a>
                        <!-- modal starts-->
                        <div class="modal fade" id="deleteModal{{$ordenCompraItem->id}}" >
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <form class="form-horizontal" method="post" action="{{route('ordenCompra.delete', $ordenCompraItem->id)}}">
                                {!! csrf_field()!!}
                                <div class="modal-header">
                                    <h4 class="modal-tittle"> Borrar {{$ordenCompraItem->numero_orden_compra}} </h4>
                                    <button type="submit" class="btn btn-default">Continuar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>

                                </form>

                                </div>
                            </div>
                        </div>
                        <!-- modal ends -->
                            
                        @else
                        <a href="#" class="btn btn-xs btn-succes" data-target="#restoreModal{{ $ordenCompraItem->id }}" data-toggle="modal"><i class="fas fa-arrow-circle-up"></i> Restaurar</a>
                        <!-- modal starts -->
                    <div class="modal fade" id="restoreModal{{ $ordenCompraItem->id}}">
                        <div class="modal-dialog">
                            <div class="modal-conent">
                            <form class="horm-horizontal" method="post" action="{{ route('ordenCompra.restore', $ordenCompraItem->id) }}">
                            {!! csrf_field() !!}
                            
                            <div class="modal-header">
                                <h4 class="modal-tittle"> Restaurar{{ $ordenCompraItem->numero_orden_compra }}</h4>
                                <button type="buton" class="close" data-dismiss="modal">&times; </button>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"> {{ trans('Restaurar') }} </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                            </div>

                            </form>

                            </div>
                        </div>
                    </div>
                    <!-- modal ends-->
                    
                    <!-- modal starts-->
                    <div class="modal fade" id="forceDeleteModal {{ $ordenCompraItem->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form class="form-horizontal" method="post" action="{{ route('ordenCompra.force_delete', $ordenCompraItem->id)}}">
                                {!! csrf_field() !!}
                                <div class="modal-header">
                                <h4 class="modal-tittle">Borrar Permanentemente {{ $ordenCompraItem->numero_orden_compra}} </h4>
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
                    <!-- modal ends-->
                        @endif
                    </td>      
                    
                    </tr>            
                @endforeach
                </tbody>   
            </table>
    </div>

  
        </div>
    </div>
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



@endsection
