@extends('layouts.app')

@section('content')


    <script lang="javascript" src="/assets/frontend/js/xlsx.full.min.js"></script>
    <script lang="javascript" src="/assets/frontend/js/FileSaver.js"></script>
    <script lang="javascript" src="/assets/frontend/js/xlsx.core.min.js"></script>

       <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('licitaciones.index') }}">Licitaciones</a>
        </li>        
    </ol>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <form method="get" class="form-horizontal" action="{{ route('licitaciones.index') }}">
                {!! csrf_field() !!} 
                
                <div class="row"> 
                    <div class="col-3">
                        <label>ID Licitacion</label>
                        <div>
                            <select name="nroLicitacion" class="selectpicker selectField" placeholder="Seleccione ID Licitación" data-live-search='true'>
                                <option value=""></option>
                                @foreach ($nro_licitacionData as $entityId => $entityValue)
                                    <option value="{{ $entityId }}"> {{ $entityValue }}</option>                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="btn-group float-right ml-3">
                    <a href="{{ route('licitaciones.form') }}" class="btn btn-primary rounded"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Nueva</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status')}}
                    </div>
                    @endif  
       
                </div>
                
        </div>       
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-sm w-25" id="dataLicitaciones" cellspacing="0">
            <thead>
                <tr>
                    <th>ID Licitación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($licitacionData as $licitacionItem)
                    <tr>
                        <td> {{ $licitacionItem->nro_licitacion ?: ''}} </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
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
    
