@extends('layouts.app')

@section('content')
@role('Admin')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Convenio</a>
        </li>
        <li class="breadcrumb-item active">Bitacora</li>
    </ol>

    <form method="post" action="{{ route('bitacoraConvenio.save', $convenio) }}" enctype="multipart/form-data" >
    {!! csrf_field() !!}
    <div class="card">

        <div class="card-body row">
            <div class="row col-12">
                <input type="hidden" name="id" value="{{ $bitacora->id }}" >
                <div class="form-group has-feedback col-xs-4 col-md-4 col-lg-4 {{ $errors->has('texto') ? 'has-error' : '' }}">
                    <label>Texto</label>
                    <textarea type="text" name="texto" class="form-control" rows="10" cols="30" ></textarea>
                    @if ($errors->has('texto'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('texto') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer">
        <div class="row">
            <div class="col-sm-8">
            <button type="submit" class="btn-primary btn rounded" ><i class="icon-floppy-disk"></i> Guardar</button>
            </div>
        </div>
        </div>

    </div>
  </form>
@endrole
@stop